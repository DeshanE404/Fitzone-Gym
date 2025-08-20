<?php
session_start();

// Check admin login
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

include('config.php'); // $dbh is PDO

// Handle member registration
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $name            = trim($_POST['name']);
    $email           = trim($_POST['email']);
    $dob             = trim($_POST['dob']);
    $gender          = trim($_POST['gender']);
    $contact         = trim($_POST['contact']);
    $address         = trim($_POST['address']);
    $membership_type = trim($_POST['membership_type']);
    $password        = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);

    if (!empty($name) && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) &&
        !empty($dob) && !empty($gender) && !empty($contact) && !empty($address) && !empty($membership_type)) {

        try {
            $checkStmt = $dbh->prepare("SELECT COUNT(*) FROM members WHERE email = ?");
            $checkStmt->execute([$email]);
            if ($checkStmt->fetchColumn() > 0) {
                $_SESSION['error'] = "⚠️ Email already registered!";
            } else {
                $stmt = $dbh->prepare(
                    "INSERT INTO members (name, email, dob, gender, contact, address, membership_type, password)
                     VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
                );
                if ($stmt->execute([$name, $email, $dob, $gender, $contact, $address, $membership_type, $password])) {
                    $_SESSION['success'] = "✅ Member registered successfully!";
                } else {
                    $errorInfo = $stmt->errorInfo();
                    $_SESSION['error'] = "❌ Database error: " . $errorInfo[2];
                }
            }
        } catch (PDOException $e) {
            $_SESSION['error'] = "❌ Database error: " . $e->getMessage();
        }
    } else {
        $_SESSION['error'] = "⚠️ Please fill in all fields correctly.";
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Handle deletion of enrollment form
if (isset($_GET['delete_id'])) {
    $delete_id = (int)$_GET['delete_id'];
    try {
        $stmt = $dbh->prepare("DELETE FROM joinforms WHERE id = ?");
        if ($stmt->execute([$delete_id])) {
            $_SESSION['success'] = "✅ Record deleted successfully!";
        } else {
            $_SESSION['error'] = "❌ Failed to delete record.";
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "❌ Database error: " . $e->getMessage();
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Handle deletion of registered member
if (isset($_GET['delete_member_id'])) {
    $delete_gym_id = $_GET['delete_member_id'];
    try {
        $stmt = $dbh->prepare("DELETE FROM members WHERE gym_id = ?");
        if ($stmt->execute([$delete_gym_id])) {
            $_SESSION['success'] = "✅ Member deleted successfully!";
        } else {
            $_SESSION['error'] = "❌ Failed to delete member.";
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "❌ Database error: " . $e->getMessage();
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

$uploadDir = 'uploads/resources/';
// Create uploads folder if not exists
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

// Handle file upload
if (isset($_POST['upload_resource'])) {
    $name = filter_var(trim($_POST['resource_name']), FILTER_SANITIZE_STRING);
    if (!empty($name) && isset($_FILES['resource_file']) && $_FILES['resource_file']['error'] === UPLOAD_ERR_OK) {
        $allowedExt = ['pdf', 'jpg', 'jpeg'];
        $fileTmpPath = $_FILES['resource_file']['tmp_name'];
        $fileName = basename($_FILES['resource_file']['name']);
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        
        if (in_array($fileExt, $allowedExt)) {
            $newFileName = uniqid() . '.' . $fileExt;
            $destPath = $uploadDir . $newFileName;
            
            if (move_uploaded_file($fileTmpPath, $destPath)) {
                // Updated INSERT query
                $stmt = $dbh->prepare("INSERT INTO resources (resource_name, resource_path) VALUES (:resource_name, :resource_path)");
                $stmt->execute([
                    ':resource_name' => $name,
                    ':resource_path' => $destPath
                ]);
                echo "<script>alert('File uploaded successfully'); window.location.href = window.location.href.split('?')[0];</script>";
                exit();
            } else {
                echo "<script>alert('Error moving uploaded file.');</script>";
            }
        } else {
            echo "<script>alert('Only PDF and JPG files are allowed.');</script>";
        }
    } else {
        echo "<script>alert('Please fill the name and select a valid file.');</script>";
    }
}

// Handle file deletion
if (isset($_GET['delete_resource_id'])) {
    $deleteId = intval($_GET['delete_resource_id']);
    
    // Get file path to delete physical file
    $stmt = $dbh->prepare("SELECT resource_path FROM resources WHERE resource_id = :id LIMIT 1");
    $stmt->execute([':id' => $deleteId]);
    $file = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($file) {
        if (file_exists($file['resource_path'])) {
            unlink($file['resource_path']);
        }
        $stmtDel = $dbh->prepare("DELETE FROM resources WHERE resource_id = :id");
        $stmtDel->execute([':id' => $deleteId]);
        echo "<script>alert('File deleted successfully'); window.location.href = window.location.href.split('?')[0];</script>";
        exit();
    } else {
        echo "<script>alert('File not found in database.');</script>";
    }
}

include('header.php');
?>

<section id="dashboard" class="hero">
    <div class="admin-boxes-container">

        <!-- Admin Title Box -->
        <div class="admintitle-box">
            <h1>Fitzone Admin Dashboard</h1>
        </div>

        <!-- Row of 3 Main Boxes -->
        <div class="admin-boxes-row">

            <!-- Delete User Box -->
            <div class="deleteuser-box">
                <h1>Delete User</h1>
                <div class="admin-content">
                    <?php
                    try {
                        $stmt = $dbh->query("SELECT gym_id, name, email, contact FROM members ORDER BY gym_id DESC");
                        $members = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if ($members) {
                            echo '<ul style="list-style:none; padding:0; margin:0;">';
                            foreach ($members as $member) {
                                echo '<li style="margin-bottom:0.8rem; border-bottom:1px solid rgba(255,255,255,0.2); padding-bottom:0.5rem;">';
                                echo '<strong>Gym ID:</strong> ' . htmlspecialchars($member['gym_id']) . '<br>';
                                echo '<strong>Name:</strong> ' . htmlspecialchars($member['name']) . '<br>';
                                echo '<strong>Email:</strong> ' . htmlspecialchars($member['email']) . '<br>';
                                echo '<strong>Contact:</strong> ' . htmlspecialchars($member['contact']) . '<br>';
                                echo '<a href="?delete_member_id=' . $member['gym_id'] . '" onclick="return confirm(\'Are you sure you want to delete this user?\');" style="color:red;">🗑 Delete</a>';
                                echo '</li>';
                            }
                            echo '</ul>';
                        } else {
                            echo '<p>No registered users yet.</p>';
                        }
                    } catch (PDOException $e) {
                        echo '<p>Error loading users: ' . $e->getMessage() . '</p>';
                    }
                    ?>
                </div>
            </div>

            <!-- Register User Box -->
            <div class="userregister-box">
                <h1>Register a New User</h1>

                <?php
                if (isset($_SESSION['success'])) {
                    echo '<p style="color:green;">' . $_SESSION['success'] . '</p>';
                    unset($_SESSION['success']);
                }
                if (isset($_SESSION['error'])) {
                    echo '<p style="color:red;">' . $_SESSION['error'] . '</p>';
                    unset($_SESSION['error']);
                }
                ?>

                <form method="POST" action="" class="register-form">
                    <label for="name">Full Name</label>
                    <input type="text" name="name" id="name" required>

                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required>

                    <label for="dob">Date of Birth</label>
                    <input type="date" name="dob" id="dob" required>

                    <label for="gender">Gender</label>
                    <select name="gender" id="gender" required>
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>

                    <label for="contact">Contact</label>
                    <input type="text" name="contact" id="contact" required>

                    <label for="address">Address</label>
                    <textarea name="address" id="address" required></textarea>

                    <label for="membership_type">Membership Type</label>
                    <select name="membership_type" id="membership_type" required>
                        <option value="">Select Membership Type</option>
                        <option value="Adult">Adult</option>
                        <option value="Student">Student</option>
                    </select>

                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>

                    <button type="submit" name="register">Register</button>
                </form>
            </div>

            <!-- Enrollment Forms Box -->
            <div class="admin-box">
                <h1>Enrollment Forms</h1>
                <div class="admin-content">
                    <?php
                    try {
                        $stmt = $dbh->query("SELECT * FROM joinforms ORDER BY id DESC");
                        $forms = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if ($forms) {
                            echo '<ul style="list-style:none; padding:0; margin:0;">';
                            foreach ($forms as $form) {
                                echo '<li style="margin-bottom:1rem; border-bottom:1px solid rgba(255,255,255,0.2); padding-bottom:0.5rem;">';
                                echo '<strong>Name:</strong> ' . htmlspecialchars($form['name']) . '<br>';
                                echo '<strong>Email:</strong> ' . htmlspecialchars($form['email']) . '<br>';
                                echo '<strong>Contact:</strong> ' . htmlspecialchars($form['contact']) . '<br>';
                                echo '<strong>Message:</strong> ' . htmlspecialchars($form['message']) . '<br>';

                                if (!empty($form['attachment'])) {
                                    echo '<strong>Attachment:</strong> <a href="' . htmlspecialchars($form['attachment']) . '" target="_blank">View</a><br>';
                                }

                                echo '<a href="?delete_id=' . $form['id'] . '" onclick="return confirm(\'Are you sure you want to delete this record?\');" style="color:red;">🗑 Delete</a>';
                                echo '</li>';
                            }
                            echo '</ul>';
                        } else {
                            echo '<p>No submissions yet.</p>';
                        }
                    } catch (PDOException $e) {
                        echo '<p>Error loading data: ' . $e->getMessage() . '</p>';
                    }
                    ?>
                </div>
            </div>
        </div>

        <!-- Small Scrollable Box -->
        <div class="admin-small-box">
            <h1>Manage Resources</h1>
            <form method="POST" enctype="multipart/form-data">
                <label for="resource_name">Name:</label>
                <input type="text" name="resource_name" id="resource_name" required>

                <label for="resource_file">Select PDF or JPG file:</label>
                <input type="file" name="resource_file" id="resource_file" accept=".pdf,.jpg,.jpeg" required>

                <button type="submit" name="upload_resource">Upload</button>
            </form>

            <h3>Uploaded Files</h3>
            <ul>
            <?php
                $stmt = $dbh->query("SELECT * FROM resources ORDER BY resource_id DESC");
                $resources = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if ($resources) {
                    foreach ($resources as $res) {
                        echo '<li>' . htmlspecialchars($res['resource_name']) . ' - ';
                        echo '<a href="' . htmlspecialchars($res['resource_path']) . '" target="_blank">View</a> | ';
                        echo '<a href="?delete_resource_id=' . $res['resource_id'] . '" onclick="return confirm(\'Delete this file?\');" style="color:red;">Delete</a></li>';
                    }
                } else {
                    echo '<li>No files uploaded yet.</li>';
                }
            ?>
            </ul>
        </div>
    </div>

    <a href="logout.php" class="logout-btn">Logout</a>
</section>


<?php include('footer.php'); ?>
