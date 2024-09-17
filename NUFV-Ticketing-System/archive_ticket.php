<?php
include('db_connect.php');

// Assuming that you have the ticket_id in the URL parameter
if(isset($_GET['ticket_id'])){
    $ticket_id = $_GET['ticket_id'];

    // Perform the archiving operation and update the archived_date in the tickets table
    $archive_query = $conn->query("UPDATE tickets SET archived_date = NOW() WHERE id = $ticket_id");

    if ($archive_query) {
        echo "Ticket archived successfully. ";
        
        // Redirect to ticket list page
        header("Location: index.php?page=ticket_list");
        exit();
    } else {
        echo "Error archiving ticket: " . $conn->error;
    }
} else {
    echo "Ticket ID not provided.";
}

// Close the connection after all operations
$conn->close();
?>
