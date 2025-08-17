<?php
session_start();
include('config.php'); 
$pageTitle = 'Enrollment Form';
include('header.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['name']);
    $email   = trim($_POST['email']);
    $contact = trim($_POST['contact']);
    $message = trim($_POST['message']);

    $uploadDir = 'attachment/';
    $uploadedFilePath = null;

    if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['attachment']['tmp_name'];
        $fileName    = $_FILES['attachment']['name'];
        $fileSize    = $_FILES['attachment']['size'];
        $fileType    = $_FILES['attachment']['type'];

        $allowedExtensions = ['jpg', 'jpeg', 'pdf'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (in_array($fileExtension, $allowedExtensions) && $fileSize <= 5 * 1024 * 1024) {
            $newFileName = uniqid() . '.' . $fileExtension;
            $destPath = $uploadDir . $newFileName;

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            if (move_uploaded_file($fileTmpPath, $destPath)) {
                $uploadedFilePath = $destPath;
            } else {
                $_SESSION['error'] = "❌ Failed to move uploaded file.";
            }
        } else {
            $_SESSION['error'] = "⚠️ Only JPG and PDF files under 5MB are allowed.";
        }
    }

    if (!empty($name) && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) && empty($_SESSION['error'])) {
        try {
            $stmt = $dbh->prepare(
                "INSERT INTO joinforms (name, email, contact, message, attachment) VALUES (?, ?, ?, ?, ?)"
            );
            if ($stmt->execute([$name, $email, $contact, $message, $uploadedFilePath])) {
                $_SESSION['success'] = "✅ Thank you for signing up! We Will Review Your Form And Enroll You To FitZone Gym.";
            } else {
                $_SESSION['error'] = "❌ Database error: Could not save your data.";
            }
        } catch (PDOException $e) {
            $_SESSION['error'] = "❌ Database error: " . $e->getMessage();
        }
    } else {
        $_SESSION['error'] = "⚠️ Please enter a valid name and email.";
    }

    header("Location: enroll.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
</head>
<body>

<section class="hero">
        <div class="container info-box">
        <h2>FitZone Gym Enrollment</h2>
                <div class="mini-info-box">
        <h3>To obtain a FitZone Gym subscription, kindly transfer your payment to the bank.Fill out the enrollment form, attach the receipt, and submit it after the transaction.Below are the bank's information!</h3>
        <p style="color: rgba(148, 226, 236, 1);">Gym membership prices are , 2500Rs/month (For Adult), 1000Rs/month (For Students)</p>
        </div>
        <div class="list-container">
        <ul>
            <p style="color: rgb(73, 190, 211, 1);"><b>Commercial Bank Kurunegala</b></p>
            <li>Name- Fitzone Gym</li>
            <li>Account Number- 2985684952</li>
        </ul>
        <ul>
            <p style="color: rgba(255, 255, 255, 1);"><b>Peoples Bank Kurunegala</b></p>
            <li>Name- Fitzone Gym</li>
            <li>Account Number- 100569825689</li>
        </ul>
    </div>
    <div class="container join">
        <h2>Join Now</h2>
        <div class="contact-form">
        <div class="form-group">
        <input type="text" name="name" placeholder="Your Name" required>
    </div>
    <div class="form-group">
        <input type="email" name="email" placeholder="Your Email" required>
    </div>
    <div class="form-group">
        <input type="tel" name="contact" placeholder="Your Contact">
    </div>
    <div class="form-group">
        <textarea name="message" rows="5" placeholder="Your Message"></textarea>
    </div>
    <div class="form-group">
        <label for="file">Attach a file (JPG or PDF):</label>
        <input type="file" name="attachment" accept=".jpg,.jpeg,.pdf">
    </div>
    <button type="submit" class="btn-primary">Sign Up</button>
</form>
        </div>
    </div>
</section>

<!-- Display JS popup if session message exists -->
<?php if (!empty($_SESSION['success'])): ?>
<script>
    alert("<?php echo addslashes($_SESSION['success']); ?>");
</script>
<?php unset($_SESSION['success']); endif; ?>

<?php if (!empty($_SESSION['error'])): ?>
<script>
    alert("<?php echo addslashes($_SESSION['error']); ?>");
</script>
<?php unset($_SESSION['error']); endif; ?>

<?php include('footer.php'); ?>
</body>
</html>
