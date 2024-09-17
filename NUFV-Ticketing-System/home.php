<?php
include('db_connect.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashstyle.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <?php if ($_SESSION['login_type'] == 1) : ?>
       
        <div class="main">
            <div class="card-header">
                <div class="card-tools">
                    <a href="index.php?page=customer_list" class="btn btn-sm btn-primary mr-2">User List</a>
                    <a href="index.php?page=staff_list" class="btn btn-sm btn-primary mr-2">Staff List</a>
                    <a href="index.php?page=department_list" class="btn btn-sm btn-primary mr-2">Department List</a>
                    <a href="index.php?page=homes"><button type="button" class="btn btn-secondary mr-3"><i class="bi bi-arrow-left-short"></i> Return</button></a>
                </div>
            </div>
            <div class="cards">
                <a href="index.php?page=customer_list" class="card">
                    <div class="icon-box">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="info-box">
                        <span class="number"><?php echo $conn->query("SELECT * FROM customers")->num_rows; ?></span>
                        <span class="card-name">Total Users</span>
                    </div>
                </a>
                <a href="index.php?page=staff_list" class="card">
                    <div class="icon-box">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="info-box">
                        <span class="number"><?php echo $conn->query("SELECT * FROM staff")->num_rows; ?></span>
                        <span class="card-name">Total Staff</span>
                    </div>
                </a>
                <a href="index.php?page=department_list" class="card">
                    <div class="icon-box">
                        <i class="fas fa-columns"></i>
                    </div>
                    <div class="info-box">
                        <span class="number"><?php echo $conn->query("SELECT * FROM departments")->num_rows; ?></span>
                        <span class="card-name">Total Departments</span>
                    </div>
                </a>
                <a href="index.php?page=ticket_list" class="card">
                    <div class="icon-box">
                        <i class="fa-solid fa-envelope-open"></i>
                    </div>
                    <div class="info-box">
                        <?php
                        $result = $conn->query("SELECT COUNT(*) AS total_pending_tickets FROM tickets WHERE status = 0 AND archived_date IS NULL");
                        $row = $result->fetch_assoc();
                        $totalPendingTickets = $row['total_pending_tickets'];
                        ?>
                        <span class="number"><?php echo $totalPendingTickets; ?></span>
                        <span class="card-name">Total Open Tickets</span>
                    </div>
                </a>
                <a href="index.php?page=history" class="card">
                    <div class="icon-box">
                        <i class="fa-solid fa-square-check"></i>
                    </div>
                    <div class="info-box">
                        <?php
                        $result = $conn->query("SELECT COUNT(*) AS total_Closed_tickets FROM tickets WHERE status = 2");
                        $row = $result->fetch_assoc();
                        $totalClosedTickets = $row['total_Closed_tickets'];
                        ?>
                        <span class="number"><?php echo $totalClosedTickets; ?></span>
                        <span class="card-name">Total Resolved Tickets</span>
                    </div>
                </a>
                
              <div class="card">
                    <div class="icon-box">
                        <i class="fas fa-ticket-alt"></i>
                    </div>
                    <div class="info-box">
                        <?php
                        $result = $conn->query("SELECT COUNT(*) AS total_tickets FROM tickets WHERE archived_date IS NULL");
                        $row = $result->fetch_assoc();
                        $totalTickets = $row['total_tickets'];
                        ?>
                        <span class="number"><?php echo $totalTickets; ?></span>
                        <span class="card-name">Total Tickets</span>
                    </div>
                </div>
            </div>
            
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <div class="charts">
                <div class="chart">
                    <h2>Total Number of Tickets</h2>
                    <canvas id="doughnut"></canvas>
                    <script src="chart2.js"></script>
                </div>
            </div>
        </div>
    <?php elseif ($_SESSION['login_type'] == 2) : ?>
       <?php
        
        $department_id = $_SESSION['login_department_id'];

       
        $totalUsersResult = $conn->query("SELECT COUNT(*) AS total_users FROM customers");
        $totalUsersRow = $totalUsersResult->fetch_assoc();
        $totalUsers = $totalUsersRow['total_users'];

      
        $totalOpenTicketsResult = $conn->query("SELECT COUNT(*) AS total_open_tickets FROM tickets WHERE department_id = $department_id AND status = 0 AND archived_date IS NULL");
        $totalOpenTicketsRow = $totalOpenTicketsResult->fetch_assoc();
        $totalOpenTickets = $totalOpenTicketsRow['total_open_tickets'];

    
        $totalResolvedTicketsResult = $conn->query("SELECT COUNT(*) AS total_resolved_tickets FROM tickets WHERE department_id = $department_id AND status = 2 AND archived_date IS NULL");
        $totalResolvedTicketsRow = $totalResolvedTicketsResult->fetch_assoc();
        $totalResolvedTickets = $totalResolvedTicketsRow['total_resolved_tickets'];

     
        $totalTicketsResult = $conn->query("SELECT COUNT(*) AS total_tickets FROM tickets WHERE department_id = $department_id AND archived_date IS NULL");
        $totalTicketsRow = $totalTicketsResult->fetch_assoc();
        $totalTickets = $totalTicketsRow['total_tickets'];
        ?>

        <div class="main">
            <div class="card-header">
                <div class="card-tools">
                    <a href="index.php?page=homes"><button type="button" class="btn btn-secondary mr-3"><i class="bi bi-arrow-left-short"></i> Return</button></a>
                </div>
            </div>
            <div class="cards">
        <a href="index.php?page=customer_list" class="card">
            <div class="icon-box">
                <i class="fas fa-users"></i>
            </div>
            <div class="info-box">
                <span class="number"><?php echo $totalUsers; ?></span>
                <span class="card-name">Total Users</span>
            </div>
        </a>
        <a href="index.php?page=ticket_list" class="card">
            <div class="icon-box">
                <i class="fa-solid fa-envelope-open"></i>
            </div>
            <div class="info-box">
                <span class="number"><?php echo $totalOpenTickets; ?></span>
                <span class="card-name">Total Open Tickets</span>
            </div>
        </a>
                <a href="index.php?page=history" class="card">
        <div class="icon-box">
            <i class="fa-solid fa-square-check"></i>
        </div>
        <div class="info-box">
            <?php
            $result = $conn->query("SELECT COUNT(*) AS total_Closed_tickets FROM tickets WHERE status = 2");
            $row = $result->fetch_assoc();
            $totalClosedTickets = $row['total_Closed_tickets'];
            ?>
            <span class="number"><?php echo $totalClosedTickets; ?></span>
            <span class="card-name">Total Resolved Tickets</span>
        </div>
</a>
                <div class="card">
                    <div class="icon-box">
                        <i class="fas fa-ticket-alt"></i>
                    </div>
                    <div class="info-box">
                        <span class="number"><?php echo $totalTickets; ?></span>
                        <span class="card-name">Total Tickets</span>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</body>

</html>
