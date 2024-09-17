<?php include 'db_connect.php'; ?>

<?php
if (isset($_GET['id'])) {
    $ticket_id = $_GET['id'];
    
    $qry = $conn->query("SELECT t.*, 
                                CONCAT(c.lastname, ', ', c.firstname, ' ', c.middlename) AS cname, 
                                d.name AS dname, 
                                cat.name AS category_name 
                         FROM tickets t 
                         INNER JOIN customers c ON c.id = t.customer_id 
                         INNER JOIN departments d ON d.id = t.department_id  
                         LEFT JOIN categories cat ON cat.id = t.category_id 
                         WHERE t.id = $ticket_id");

    if ($qry && $qry->num_rows > 0) {
        $row = $qry->fetch_array();
        foreach ($row as $k => $v) {
            $$k = $v;  
        }
    } else {
        echo "Ticket not found.";
        exit;
    }
} else {
    echo "Ticket ID not provided.";
    exit;
}
?>

<style>
    .d-list { display: list-item; }
    .ticket-header { 
        display: flex; 
        justify-content: space-between; 
        align-items: center;
    }
    .ticket-id {
        font-weight: bold;
        font-size: 1.2rem;
    }
    .return-button {
        margin-left: auto;
    }
</style>

<div class="col-lg-12">
    <div class="row">
        <div class="col-md-7 mx-auto">
            <div class="card card-outline">
                <div class="card-header ticket-header">
                    <span class="ticket-id">Ticket ID: #<?php echo isset($ticket_id) ? $ticket_id : 'N/A'; ?></span>
                    <div class="return-button">
                        <a href="index.php?page=homes">
                            <button type="button" class="btn btn-secondary">
                                <i class="bi bi-arrow-left-short"></i> Return
                            </button>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="control-label border-bottom border-grey">Subject</label>
                                <p class="ml-2 d-list"><b><?php echo isset($subject) ? $subject : 'N/A'; ?></b></p>

                                <label class="control-label border-bottom border-grey">Category</label>
                                <p class="ml-2 d-list"><b><?php echo isset($category_name) ? $category_name : 'N/A'; ?></b></p>

                                <label class="control-label border-bottom border-grey">Customer</label>
                                <p class="ml-2 d-list"><b><?php echo isset($cname) ? $cname : 'N/A'; ?></b></p>
                            </div>

                            <div class="col-md-6">
                                <label class="control-label border-bottom border-grey">Status</label>
                                <p class="ml-2 d-list">
                                    <?php if ($status == 0): ?>
                                        <span class="badge badge-primary">Open</span>
                                    <?php elseif ($status == 1): ?>
                                        <span class="badge badge-info">Pending</span>
                                    <?php elseif ($status == 2): ?>
                                        <span class="badge badge-success">Resolved</span>
                                    <?php endif; ?>

                                    <?php if ($_SESSION['login_type'] != 3 && $status != 2 && $status != 3): ?>
                                        <span class="badge btn-outline-primary btn update_status" data-id="<?php echo $id; ?>">Update Status</span>
                                    <?php endif; ?>
                                </p>

                                <label class="control-label border-bottom border-grey">Need Support From</label>
                                <p class="ml-2 d-list"><b><?php echo isset($dname) ? $dname : 'N/A'; ?></b></p>

                                <label class="control-label border-bottom border-grey">Room</label>
                                <p class="ml-2 d-list"><b><?php echo isset($room) ? $room : 'N/A'; ?></b></p>
                            </div>
                        </div>
                        <hr class="border-grey">
                        <label class="control-label border-bottom border-grey">Description</label>
                        <div>
                            <b><?php echo isset($description) ? html_entity_decode($description) : 'No description available'; ?></b>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 mx-auto">
            <div class="card card-outline card-dark">
                <div class="card-header">
                    <h3 class="card-title">Comment/s</h3>
                </div>
                <div class="card-body p-0 py-2">
                    <div class="container-fluid">
                        <?php 
                        $comments = $conn->query("SELECT * FROM comments WHERE ticket_id = '$id' ORDER BY unix_timestamp(date_created) ASC");
                        while ($row = $comments->fetch_assoc()):
                            if ($row['user_type'] == 1) {
                                $uname = $conn->query("SELECT CONCAT(lastname, ', ', firstname, ' ', middlename) AS name FROM users WHERE id = {$row['user_id']}")->fetch_array()['name'];
                            } elseif ($row['user_type'] == 2) {
                                $uname = $conn->query("SELECT CONCAT(lastname, ', ', firstname, ' ', middlename) AS name FROM staff WHERE id = {$row['user_id']}")->fetch_array()['name'];
                            } elseif ($row['user_type'] == 3) {
                                $uname = $conn->query("SELECT CONCAT(lastname, ', ', firstname, ' ', middlename) AS name FROM customers WHERE id = {$row['user_id']}")->fetch_array()['name'];
                            }
                        ?>
                        <div class="card card-outline card-dark">
                            <div class="card-header">
                                <h5 class="card-title"><?php echo ucwords($uname); ?></h5>
                                <div class="card-tools">
                                    <span class="text-muted"><?php echo date("n-j-Y h:i:s A", strtotime($row['date_created'])); ?></span>
                                    <?php if ($row['user_type'] == $_SESSION['login_type'] && $row['user_id'] == $_SESSION['login_id'] && $status != 2 && $status != 3): ?>
                                        <span class="dropleft">
                                            <a class="fa fa-ellipsis-v text-muted" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item edit_comment" href="javascript:void(0)" data-id="<?php echo $row['id']; ?>">Edit</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item delete_comment" href="javascript:void(0)" data-id="<?php echo $row['id']; ?>">Delete</a>
                                            </div>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="card-body">
                                <div>
                                    <?php echo html_entity_decode($row['comment']); ?>
                                </div>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </div>

                    <?php if ($status != 2 && $status != 3): ?>
                    <div class="px-2">
                        <form action="" id="manage-comment">
                            <div class="form-group">
                                <input type="hidden" name="ticket_id" value="<?php echo $id; ?>">
                                <label class="control-label">New Comment</label>
                                <textarea name="comment" id="comment_textarea" cols="30" rows="" class="form-control summernote2"></textarea>
                            </div>
                            <a href="index.php?page=ticket_list" class="btn btn-secondary btn-sm float-right mr-1">Cancel</a>
                            <button class="btn btn-success btn-sm float-right mr-1" id="save_comment_btn">Save</button>
                        </form>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        $('.summernote2').summernote({
            height: 150,
            toolbar: [ ['font', ['bold', 'fontsize', 'undo', 'redo']] ]
        });
    });

    $('.edit_comment').click(function(){
        uni_modal("Edit Comment", "manage_comment.php?id=" + $(this).attr('data-id'));
    });

    $('.update_status').click(function(){
        uni_modal("Update Ticket's Status", "manage_ticket.php?id=" + $(this).attr('data-id'));
    });

    $('#manage-comment').submit(function(e){
        e.preventDefault();
        var comment = $('#comment_textarea').val().trim();
        if(comment == '') {
            alert('Comment cannot be empty or just whitespace.');
            return false;
        }
        start_load();
        $.ajax({
            url: 'ajax.php?action=save_comment',
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            success: function(resp){
                if (resp == 1) {
                    alert_toast('Comment successfully saved.', "success");
                    setTimeout(function(){ location.reload(); }, 1500);
                }
            }
        });
    });

    $('.delete_comment').click(function(){
        _conf("Are you sure to delete this comment?", "delete_comment", [$(this).attr('data-id')]);
    });

    function delete_comment(id){
        start_load();
        $.ajax({
            url: 'ajax.php?action=delete_comment',
            method: 'POST',
            data: {id: id},
            success: function(resp){
                if (resp == 1) {
                    alert_toast("Data successfully deleted", 'success');
                    setTimeout(function(){ location.reload(); }, 1500);
                }
            }
        });
    }
</script>
