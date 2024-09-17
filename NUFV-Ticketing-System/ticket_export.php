<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>.</title> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.1/xlsx.full.min.js"></script>
    <style>
        
        body {
            margin: 0;
            padding: 0;
        }

        .container {
            margin: 20px auto;
            max-width: 800px;
            font-family: Arial, Helvetica, sans-serif;
        }

        .head {
            text-align: center;
            margin-bottom: 20px;
        }

        .head h1,
        .head h2,
        .head p {
            margin: 0;
        }

        .Logo {
            width: 180px;
            margin-right: 50px;
            margin-top: 20px;
        }

        .title2 {
            font-size: 24px;
            font-weight: bold;
        }

        hr {
            margin-bottom: 20px;
            border: none;
            border-top: 1px solid #ddd;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }

        td,
        th {
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #34418E;
            font-weight: bold;
            color: black;
        }

        td {
            color: black;
        }
    </style>
</head> 

<body> 
    
    <img src="NUFV Watermark.png" class="Logo">

    
    <div class="container"> 
        
        <div class="head"> 
            <h1><strong>Team Report Data</strong></h1><br>
            <p>AY 2023-2024</p>
            <p>1st Semester</p><br>
            <h2>Resolved Ticket List Data Sheet</h2>
        </div> 

        
        <hr> 

        
        <label for="reportType">Select Report Type:</label>
        <select id="reportType" onchange="updateReport()">
            <option value="weekly">Weekly</option>
            <option value="monthly">Monthly</option>
            <option value="yearly">Yearly</option>
        </select>
        <button onclick="exportToExcel()">Export to Excel</button>

        
        <table id="dataTable"> 
            
            <thead> 
                <tr> 
                    <th>ID</th> 
                    <th>Date Created</th> 
                    <th>Tickets</th> 
                    <th>Subject</th> 
                    <th>Description</th>
                    <th>Status</th>
                </tr> 
            </thead> 
            
            <tbody> 
                <?php 
                
                include 'dbcon.php'; 

                
                $get_closed_tickets = mysqli_query($connection, "SELECT t.id, t.date_created, s.lastname, s.firstname, s.middlename, t.subject, t.description, t.status
                FROM tickets t
                JOIN customers s ON t.customer_id = s.id
                WHERE t.status = 2");

                
                while($row = mysqli_fetch_array($get_closed_tickets)){ 
                ?> 
                    
                    <tr> 
                        <td><?php echo $row['id']; ?></td> 
                        <td><?php echo $row['date_created']; ?></td> 
                        <td><?php echo $row['lastname'] . ', ' . $row['firstname'] . ' ' . $row['middlename']; ?></td>  
                        <td><?php echo $row['subject']; ?></td> 
                        <td><?php echo htmlspecialchars_decode($row['description']); ?></td>
                        <td><?php echo getStatusLabel($row['status']); ?></td> 
                    </tr> 
                <?php } ?> 
            </tbody> 
        </table> 
    </div> 
    <script>
        function updateReport() {
            var reportType = document.getElementById('reportType').value;

            
            switch (reportType) {
                case 'weekly':
                    
                    break;
                case 'monthly':
                    
                    break;
                case 'yearly':
                    
                    break;
                default:
                    
                    break;
            }

            
        }

        function exportToExcel() {
            var table = document.querySelector('#dataTable');
            var ws = XLSX.utils.table_to_sheet(table);
            var wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');
            XLSX.writeFile(wb, 'Closed_Tickets_Report.xlsx');
        }
    </script>
</body> 
</html> 

<?php

function getStatusLabel($status) {
    switch ($status) {
        case 0:
            return 'Open';
        case 1:
            return 'On Process';
        case 2:
            return 'Closed';
        default:
            return 'Unknown Status';
    }
}
?>
