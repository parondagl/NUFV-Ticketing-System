<?php 
include 'init.php'; 
include('inc/header.php');
$user = $users->getUserInfo();
?>

<!DOCTYPE html>
<html lang="en">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/boxes.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="css/style.css" />
    <title>Document</title>
 

<?php include('menus.php'); ?>
<body>
    <div class="section">
    <a href="ticket.php" class="button">
        <div class="services">
            <div class="card">
                <div class="icon">
                    <i class="fa-solid fa-chart-line"></i>                   
                </div>
                <h2>Ticket List</h2>
                </a>
            </div>
            <a href="index.php" class="button">
            <div class="card">
                <div class="icon">
                    <i class="fa-solid fa-ticket"></i>                      
                </div>
                <h2>Ticket History</h2>
                </a>
            </div>
        </div>
    </div>
</body>
</html>



































<script src="js/script.js"></script>
</body>
</html>