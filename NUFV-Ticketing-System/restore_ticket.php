
<?php
include('db_connect.php');

if (isset($_GET['ticket_id'])) {
    $ticket_id = $_GET['ticket_id'];

    
    $restore_query = $conn->query("UPDATE tickets SET archived_date = NULL WHERE id = $ticket_id");

    if ($restore_query) {
        header("Location: index.php?page=ticket_list");
        exit();
    } else {
        echo "Failed to restore ticket. ";
    }
}


echo "<div class='card'>";
echo "<div class='card-body'>";
echo "<table class='table table-hover table-bordered' id='archivedList'>";
echo "<colgroup>";
echo "<col width='5%'>";
echo "<col width='15%'>";
echo "<col width='15%'>";
echo "<col width='15%'>";
echo "<col width='20%'>";
echo "<col width='5%'>";
echo "<col width='5%'>";
echo "</colgroup>";
echo "<thead>";
echo "<tr>";
echo "<th style='background-color: #34418E; color: white;'>#</th>";
echo "<th style='background-color: #34418E; color: white;'>Date Created and Time</th>";
echo "<th style='background-color: #34418E; color: white;'>Ticket</th>";
echo "<th style='background-color: #34418E; color: white;'>Subject</th>";
echo "<th style='background-color: #34418E; color: white;'>Description</th>";
echo "<th style='background-color: #34418E; color: white;'>Status</th>";
echo "<th style='background-color: #34418E; color: white;'></th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";

$i = 1;
$archived_qry = $conn->query("SELECT t.*, concat(c.lastname,', ',c.firstname,' ',c.middlename) as cname FROM tickets t inner join customers c on c.id= t.customer_id WHERE t.archived_date IS NOT NULL order by unix_timestamp(t.date_created) ASC");

while ($archived_row = $archived_qry->fetch_assoc()) {
    $trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
    unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
    $desc = strtr(html_entity_decode($archived_row['description']), $trans);
    $desc = str_replace(array("<li>", "</li>"), array("", ", "), $desc);

    echo "<tr>";
    echo "<th class='text-center'>$i</th>";
    echo "<td><b>" . date("n-j-Y h:i:s A", strtotime($archived_row['date_created'])) . "</b></td>";
    echo "<td><b>" . ucwords($archived_row['cname']) . "</b></td>";
    echo "<td><b>" . $archived_row['subject'] . "</b></td>";
    echo "<td><b class='truncate'>" . strip_tags($desc) . "</b></td>";
    echo "<td>";
    if ($archived_row['status'] == 0) {
        echo "<span class='badge badge-primary'>Open</span>";
    } elseif ($archived_row['status'] == 1) {
        echo "<span class='badge badge-Info'>Processing</span>";
    } elseif ($archived_row['status'] == 2) {
        echo "<span class='badge badge-success'>Done</span>";
    }
    echo "</td>";
    echo "<td class='text-center'>";
    echo "<button type='button' class='btn btn-warning btn-xs update' onclick=\"window.location.href='./restore_ticket.php?ticket_id={$archived_row['id']}'\">Restore</button>";
    echo "</td>";
    echo "</tr>";

    $i++;
}

echo "</tbody>";
echo "</table>";
echo "</div>";
echo "</div>";


$conn->close();
?>
