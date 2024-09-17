<?php include 'db_connect.php' ?>
<div class="col-lg-12">
    <div class="card card-outline">
        <div class="card-header">
            <div class="card-tools">
                <a href="index.php?page=new_customer" class="btn btn-sm btn-success mr-2"><i class="fa fa-plus"></i> New User</a>
                <button type="button" class="btn btn-secondary mr-4" onclick="window.history.back();"><i class="bi bi-arrow-left-short"></i> Return</button>
            </div>
        </div>
        <div class="card	">
            <div class="card-body">
                <table class="table tabe-hover table-bordered" id="list">
                    <thead>
                        <tr>
                            <th style="background-color: #34418E;    color: white;">#</th>
                            <th style="background-color: #34418E;    color: white;">Name</th>
                            <th style="background-color: #34418E;    color: white;">Contact #</th>
                            <th style="background-color: #34418E;    color: white;">Address</th>
                            <th style="background-color: #34418E;    color: white;">Email</th>
                            <th style="background-color: #34418E;    color: white;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $qry = $conn->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as name FROM customers order by concat(lastname,', ',firstname,' ',middlename) asc");
                        while ($row = $qry->fetch_assoc()):
                        ?>
                            <tr>
                                <th class="text-center"><?php echo $i++ ?></th>
                                <td><b><?php echo ucwords($row['name']) ?></b></td>
                                <td><b><?php echo $row['contact'] ?></b></td>
                                <td><b><?php echo $row['address'] ?></b></td>
                                <td><b><?php echo $row['email'] ?></b></td>
                                <td class="text-center">
                                
<a href="./index.php?page=history&id=<?php echo $row['id']; ?>" class="btn btn-info btn-xs" role="button">
    History
</a>
    <a href="./index.php?page=edit_customer&id=<?php echo $row['id'] ?>" class="btn btn-warning btn-xs update" role="button">
        Edit
    </a>
    <a href="javascript:void(0)" class="btn btn-danger btn-xs delete_customer" data-id="<?php echo $row['id'] ?>" role="button">
        Delete
    </a>
</td>

                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<script>
	$(document).ready(function(){
		$('#list').dataTable({
			"columnDefs": [
				{ "orderable": false, "targets": 5 }
			]
		});

		$('.delete_customer').click(function(){
			_conf("Are you sure to delete this user?", "delete_customer", [$(this).attr('data-id')]);
		});
	});

	function delete_customer($id){
		start_load();
		$.ajax({
			url:'ajax.php?action=delete_customer',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted", 'success');
					setTimeout(function(){
						location.reload();
					},1500);
				}
			}
		});
	}
</script>

