<?php
session_start();
include('config.php'); 
$pageTitle = 'Enrollment Form';
include('header.php');
// Handle search query
$searchQuery = '';
if (isset($_GET['search'])) {
    $searchQuery = trim($_GET['search']);
}
// Handle review submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_review'])) {
    $reviewName = trim($_POST['review_name']);
    $reviewMessage = trim($_POST['review_message']);

    if (!empty($reviewName) && !empty($reviewMessage)) {
        try {
            $stmt = $dbh->prepare("INSERT INTO reviews (name, message) VALUES (:name, :message)");
            $stmt->execute([':name' => $reviewName, ':message' => $reviewMessage]);
            $successMsg = "Review submitted successfully!";
        } catch (PDOException $e) {
            $errorMsg = "Error submitting review: " . $e->getMessage();
        }
    } else {
        $errorMsg = "Please fill in both name and message.";
    }
}
?>
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
</head>
<body>
<section id="userdashboard" class="hero">
    <div class="overlay"></div>
    <div class="userdashboard-container" style="display:flex; gap:2%; justify-content:center; margin-top:50px;">
        
<!-- Top Row: Resources + Gym Schedule -->
        <div class="userdashboard-row" style="display:flex; gap:2%; justify-content:center;">

            <!-- Resources Box -->
            <div class="userdashboard-box">
                <form method="GET" class="search-form">
                    <h1>Resources</h1>
                    <input type="text" name="search" placeholder="Search by name" value="<?php echo htmlspecialchars($searchQuery); ?>">
                    <button type="submit">Search</button>
                </form>
                <ul>
                    <?php
                    try {
                        if (!empty($searchQuery)) {
                            $stmt = $dbh->prepare("SELECT * FROM resources WHERE resource_name LIKE :name ORDER BY resource_id DESC");
                            $stmt->execute([':name' => "%$searchQuery%"]);
                        } else {
                            $stmt = $dbh->query("SELECT * FROM resources ORDER BY resource_id DESC");
                        }

                        $resources = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        if ($resources) {
                            foreach ($resources as $res) {
                                echo '<li>';
                                echo htmlspecialchars($res['resource_name']) . ' - ';
                                echo '<a href="' . htmlspecialchars($res['resource_path']) . '" class="view-btn" target="_blank">View</a>';
                                echo '</li>';
                            }
                        } else {
                            echo '<li>No resources found.</li>';
                        }
                    } catch (PDOException $e) {
                        echo '<li>Error loading resources: ' . $e->getMessage() . '</li>';
                    }
                    ?>
                </ul>
            </div>

        <!-- Gym Class Schedule Box -->
                <div class="userdashboard-box" style="flex:2; min-width:500px;">
                <h2 style="text-align:center; margin-bottom:1rem;">Gym Class Schedule</h2>
                <div style="overflow-x:auto;">
                    <table style="width:100%; border-collapse: collapse; text-align:center;">
            <thead>
                <tr>
                    <th>Day</th>
                    <th>Sarah Johnson</th>
                    <th>Mike De Periz</th>
                    <th>Ama Jayasingha</th>
                    <th>David Silva</th>
                    <th>Emily Carter</th>
                    <th>James Lee</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Monday</td>
                    <td>Strength Training 9-10am</td>
                    <td>Personal Training 10-11am</td>
                    <td>Yoga 11-12pm</td>
                    <td>CrossFit 12-1pm</td>
                    <td>Zumba 1-2pm</td>
                    <td>Martial Arts 2-3pm</td>
                </tr>
                <tr>
                    <td>Tuesday</td>
                    <td>Conditioning 9-10am</td>
                    <td>Nutrition Advice 10-11am</td>
                    <td>Pilates 11-12pm</td>
                    <td>CrossFit 12-1pm</td>
                    <td>Dance 1-2pm</td>
                    <td>Martial Arts 2-3pm</td>
                </tr>
                <tr>
                    <td>Wednesday</td>
                    <td>Strength Training 9-10am</td>
                    <td>Personal Training 10-11am</td>
                    <td>Yoga 11-12pm</td>
                    <td>CrossFit 12-1pm</td>
                    <td>Zumba 1-2pm</td>
                    <td>Martial Arts 2-3pm</td>
                </tr>
                <tr>
                    <td>Thursday</td>
                    <td>Conditioning 9-10am</td>
                    <td>Nutrition Advice 10-11am</td>
                    <td>Pilates 11-12pm</td>
                    <td>CrossFit 12-1pm</td>
                    <td>Dance 1-2pm</td>
                    <td>Martial Arts 2-3pm</td>
                </tr>
                <tr>
                    <td>Friday</td>
                    <td>Strength Training 9-10am</td>
                    <td>Personal Training 10-11am</td>
                    <td>Yoga 11-12pm</td>
                    <td>CrossFit 12-1pm</td>
                    <td>Zumba 1-2pm</td>
                    <td>Martial Arts 2-3pm</td>
                </tr>
                <tr>
                    <td>Saturday</td>
                    <td>Conditioning 9-10am</td>
                    <td>Nutrition Advice 10-11am</td>
                    <td>Pilates 11-12pm</td>
                    <td>CrossFit 12-1pm</td>
                    <td>Dance 1-2pm</td>
                    <td>Martial Arts 2-3pm</td>
                </tr>
                <tr>
                    <td>Sunday</td>
                    <td>Strength Training 9-10am</td>
                    <td>Personal Training 10-11am</td>
                    <td>Yoga 11-12pm</td>
                    <td>CrossFit 12-1pm</td>
                    <td>Zumba 1-2pm</td>
                    <td>Martial Arts 2-3pm</td>
                </tr>
            </tbody>
        </table>
            </div>
        </div>

    </div>
      <div class="userdashboard-box" style="margin-top:20px; flex:1;">
            <h2 style="text-align:center; margin-bottom:1rem;">Customer Reviews</h2>

            <!-- Display success/error messages -->
            <?php
            if (!empty($successMsg)) {
                echo '<p style="color:green; text-align:center;">' . $successMsg . '</p>';
            }
            if (!empty($errorMsg)) {
                echo '<p style="color:red; text-align:center;">' . $errorMsg . '</p>';
            }
            ?>

            <!-- Review submission form -->
            <form method="POST" style="text-align:center; margin-bottom:1rem;">
                <input type="text" name="review_name" placeholder="Your Name" required style="margin-bottom:0.5rem; padding:0.5rem; width:250px;">
                <br>
                <textarea name="review_message" placeholder="Your Review" required style="margin-bottom:0.5rem; padding:0.5rem; width:250px; height:80px;"></textarea>
                <br>
                <button type="submit" name="submit_review" style="padding:0.5rem 1rem; border:none; border-radius:5px; background-color:#4CAF50; color:white; cursor:pointer;">Submit</button>
            </form>
        </div>
</section>

</body>
<?php include('footer.php'); ?>
</html>