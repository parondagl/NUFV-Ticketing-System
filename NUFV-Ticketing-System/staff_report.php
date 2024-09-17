<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>.</title> 
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

<body onload="print()"> 
    
    <img src="NUFV Watermark.png" class="Logo">

    
    <div class="container"> 
        
        <div class="head"> 
            <h1><strong>Team Report Data</strong></h1><br>
            <p>AY 2023-2024</p>
            <p>1st Semester</p><br>
            <h2>Staff List Data Sheet</h2>
        </div> 

        
        <hr> 

        
        <table> 
            
            <thead> 
                <tr> 
                    <th>ID</th> 
                    <th>Name</th> 
                    <th>Contact #</th> 
                    <th>Address</th> 
                    <th>Email</th>
                </tr> 
            </thead> 
            
            <tbody> 
                <?php 
                
                include 'dbcon.php'; 

                
                $get_alldata_list = mysqli_query($connection, "SELECT t.id, t.date_created, s.lastname, s.firstname, s.middlename, s.contact, s.address, s.email
                                                FROM tickets t
                                                JOIN staff s ON t.customer_id = s.id");


                
                while($row = mysqli_fetch_array($get_alldata_list)){ 
                ?> 
                    <tr> 
                        <td><?php echo $row['id']; ?></td> 
                        <td><?php echo $row['lastname'] . ', ' . $row['firstname'] . ' ' . $row['middlename']; ?></td>  
                        <td><?php echo $row['contact']; ?></td> 
                        <td><?php echo $row['address']; ?></td> 
                        <td><?php echo $row['email']; ?></td> 
                    </tr> 
                <?php } ?> 
            </tbody> 
        </table> 
    </div> 
</body> 
</html> 

