<?php
if (!isset($conn)) {
    include 'db_connect.php';
}
?>
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <form action="" id="manage_ticket">
                <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">

                <div class="col-md-6">
                    
                    <div class="form-group">
                        <?php if ($_SESSION['login_type'] == 3) : ?>
                            <label for="" class="control-label">Subject</label>                     
                            <input type="text" name="subject" id="subject" class="form-control form-control-sm" required value="<?php echo isset($subject) ? $subject : '' ?>">
                        <?php endif; ?>
                    </div>

                    
                    <div class="form-group">
                        <label for="" class="control-label">Department</label>
                        <select name="department_id" id="department_id" class="custom-select custom-select-sm select2" required>
                            <option value=""></option>
                            <?php
                            if ($_SESSION['login_type'] == 1 || $_SESSION['login_type'] == 2) {
                                $departments = $conn->query("SELECT * FROM departments ORDER BY name ASC");
                            } elseif ($_SESSION['login_type'] == 3) {
                                $departments = $conn->query("SELECT * FROM departments WHERE id = 14 ORDER BY name ASC");
                            }

                            while ($row = $departments->fetch_assoc()) :
                            ?>
                                <option value="<?php echo $row['id'] ?>" <?php echo isset($department_id) && $department_id == $row['id'] ? "selected" : '' ?>>
                                    <?php echo ucwords($row['name']) ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    
                    <?php if ($_SESSION['login_type'] == 3) : ?>
                        <div class="form-group">
                            <label for="" class="control-label">Category</label>
                            <select name="category_id" id="category_id" class="custom-select custom-select-sm select2" required>
                                <option value=""></option>
                                <?php
                                $category_query = $conn->query("SELECT * FROM categories ORDER BY id ASC");
                                while ($row = $category_query->fetch_assoc()) :
                                ?>
                                    <option value="<?php echo $row['id'] ?>" <?php echo isset($category_id) && $category_id == $row['id'] ? "selected" : '' ?>>
                                        <?php echo ucwords($row['name']) ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        
                        <div class="form-group">
                            <label class="control-label">Room</label>
                            <input type="text" name="room" id="room" class="form-control form-control-sm" value="<?php echo isset($room) ? $room : '' ?>" required>
                        </div>

                        
                        <div class="form-group">
                            <label class="control-label">Description</label>
                            <textarea name="description" id="description" cols="30" rows="10" class="form-control summernote" required><?php echo isset($description) ? $description : '' ?></textarea>
                        </div>
                    <?php endif; ?>
                </div>

                <hr>
                <div class="col-lg-12 text-right justify-content-center d-flex">
                <button class="btn btn-success mr-2" id="save_ticket">Save</button>
                <button class="btn btn-secondary" type="button" onclick="window.history.back();">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('#manage_ticket').submit(function (e) {
        e.preventDefault();
        
        var subject = $('#subject').val().trim();
        var department = $('#department_id').val().trim();
        var category = $('#category_id').val().trim();
        var room = $('#room').val().trim();
        var description = $('#description').val().trim();

        if (subject === "" || department === "" || category === "" || room === "" || description === "") {
            alert("Please fill out all fields properly.");
            return false;
        }

        start_load();
        $.ajax({
            url: 'ajax.php?action=save_ticket',
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            success: function (resp) {
                if (resp == 1) {
                    alert_toast('Data successfully saved.', "success");
                    setTimeout(function () {
                        location.replace('index.php?page=ticket_list');
                    }, 750);
                } else {
                    alert_toast('Error saving data.', "danger");
                }
            }
        });
    });
</script>
