<?php
session_start();
include('config.php'); 
$pageTitle = 'Enrollment Form';
include('header.php');

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
        
        <!-- Box 1 -->
        <div class="userdashboard-box" style="flex:1; min-width:300px;">
            <h2 style="text-align:center;">Box 1</h2>
            <p>Content for box 1</p>
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
</section>

</body>
<?php include('footer.php'); ?>
</html>