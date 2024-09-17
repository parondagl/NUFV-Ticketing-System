<?php 
include 'db_connect.php';
$expirytime = date('Y-m-d H:i:s', strtotime('-168 hours'));
$moveToTrashQuery = "UPDATE tickets SET archived_date = NOW() WHERE status = 0 AND date_created <= '$expirytime'";
$conn->query($moveToTrashQuery);
?>

<div class="col-lg-12">
    <div class="text-right">
        <?php if ($_SESSION['login_type'] == 1 || $_SESSION['login_type'] == 2): // Check if the user is a super admin (1) or admin (2) ?>
         
            <a href="restore_ticket.php" class="btn btn-danger mr-1">
    <i class="fas fa-trash"></i> Trash </a>
        <?php endif; ?>

        <?php if ($_SESSION['login_type'] == 3): // Check if the user is a user (3) ?>
            <a href="index.php?page=new_ticket"><button class="btn btn-primary mr-2">New Ticket</button></a>
        <?php endif; ?>
        <a href="index.php?page=homes"><button type="button" class="btn btn-secondary mr-4"><i class="bi bi-arrow-left-short"></i> Return</button></a>                  
    </div>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-hover table-bordered" id="list">
            <colgroup>
                <col width="5%">
                <col width="15%">
                <col width="15%">
                <col width="15%">
                <col width="20%">
                <col width="5%">
                <col width="10%">
            </colgroup>
            <thead>
                <tr>
                    <th style="background-color: #34418E; color: white;">#</th>
                    <th style="background-color: #34418E; color: white;">Date Created</th>
                    <th style="background-color: #34418E; color: white;">Name</th>
                    <th style="background-color: #34418E; color: white;">Subject</th>
                    <th style="background-color: #34418E; color: white;">Description</th>
                    <th style="background-color: #34418E; color: white;">Status</th>
                    <th style="background-color: #34418E; color: white;"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                $where = '';
                if ($_SESSION['login_type'] == 2)
                    $where .= " where t.department_id = {$_SESSION['login_department_id']} ";
                if ($_SESSION['login_type'] == 3)
                    $where .= " where t.customer_id = {$_SESSION['login_id']} ";
                    $qry = $conn->query("SELECT t.*, concat(c.lastname,', ',c.firstname,' ',c.middlename) as cname 
                    FROM tickets t 
                    INNER JOIN customers c ON c.id = t.customer_id 
                    $where 
                    AND t.archived_date IS NULL 
                    AND t.status != 2
                    AND (t.status = 0 OR (t.status = 1 AND t.date_created >= '$expirytime'))
                    ORDER BY CASE WHEN t.status = 0 THEN unix_timestamp(t.date_created) ELSE unix_timestamp(t.date_created) END ASC");

                while ($row = $qry->fetch_assoc()) :
                    $trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
                    unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
                    $desc = strtr(html_entity_decode($row['description']), $trans);
                    $desc = str_replace(array("<li>", "</li>"), array("", ", "), $desc);
                ?>
                    <tr>
                        <th class="text-center"><?php echo $i++ ?></th>
                        <td><b><?php echo date("n-j-Y h:i:s A", strtotime($row['date_created'])) ?></b></td>
                        <td><b><?php echo ucwords($row['cname']) ?></b></td>
                        <td><b><?php echo $row['subject'] ?></b></td>
                        <td><b class="truncate"><?php echo strip_tags($desc) ?></b></td>
                        <td>
                            <?php if ($row['status'] == 0) : ?>
                                <span class="badge badge-primary">Open</span>
                            <?php elseif ($row['status'] == 1) : ?>
                                <span class="badge badge-Info">Processing</span>
                            <?php elseif ($row['status'] == 2) : ?>
                                <span class="badge badge-success">Done</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-success btn-xs update" onclick="window.location.href='./index.php?page=view_ticket&id=<?php echo $row['id'] ?>'"><i class="fas fa-eye"></i>
                               View
                            </button>
                            <?php if ($_SESSION['login_type'] == 1 || $_SESSION['login_type'] == 2): ?>
                            <button type="button" class="btn btn-warning btn-xs update" onclick="window.location.href='./index.php?page=edit_ticket&id=<?php echo $row['id'] ?>'"> <i class="fas fa-edit"></i> 
                                    Edit
                                </button>
                    
                                <button type="button" class="btn btn-danger btn-xs update" onclick="window.location.href='./archive_ticket.php?ticket_id=<?php echo $row['id'] ?>'"> <i class="fas fa-trash"></i>
                                Delete                               
                                </button>

                    
                            <?php endif; ?>
                            <?php if ($_SESSION['login_type'] == 3) : ?>
                                <button type="button" class="btn btn-warning btn-xs update" onclick="window.location.href='./index.php?page=edit_ticket&id=<?php echo $row['id'] ?>'"><i class="fas fa-edit"></i>
                                    Edit
                                </button>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>


</div>
<script>
    $(document).ready(function () {
        $('#list').dataTable({
            "columnDefs": [
                { "orderable": false, "targets": 6 }
            ]
        });

        $('.delete_ticket').click(function () {
            _conf("Are you sure to delete this ticket?", "delete_ticket", [$(this).attr('data-id')])
        });
    });

    function delete_ticket($id) {
        start_load();
        $.ajax({
            url: 'ajax.php?action=delete_ticket',
            method: 'POST',
            data: { id: $id },
            success: function (resp) {
                if (resp == 1) {
                    alert_toast("Data successfully deleted", 'success');
                    setTimeout(function () {
                        location.reload();
                    }, 1500);
                }
            }
        });
    }
</script>
