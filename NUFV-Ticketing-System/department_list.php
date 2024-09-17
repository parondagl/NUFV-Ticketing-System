<?php include 'db_connect.php' ?>
<div class="col-lg-12">
	<div class="card card-outline">
		<div class="card-header">
			<div class="card-tools">
			<a href="#" class="btn btn-sm btn-success mr-2" id="new_department"><i class="fa fa-plus"></i> New Department</a>
			<button type="button" class="btn btn-secondary mr-4" onclick="window.history.back();"><i class="bi bi-arrow-left-short"></i> Return</button>
			</div>
			
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-bordered" id="list">
				<thead>
					<tr>
					<th style="background-color: #34418E;    color: white;">#</th>
					<th style="background-color: #34418E;    color: white;">Name</th>
					<th style="background-color: #34418E;    color: white;">Description</th>
					<th style="background-color: #34418E;    color: white;"></th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$qry = $conn->query("SELECT * FROM departments order by  name asc");
					while($row= $qry->fetch_assoc()):
					?>
					<tr>
						<th class="text-center"><?php echo $i++ ?></th>
						<td><b><?php echo ucwords($row['name']) ?></b></td>
						<td><b><?php echo $row['description'] ?></b></td>
						<td class="text-center">
    <button type="button" class="btn btn-warning btn-xs edit_department" data-id="<?php echo $row['id'] ?>">
        Edit
    </button>
    <button type="button" class="btn btn-danger btn-xs delete_department" data-id="<?php echo $row['id'] ?>">
        Delete
    </button>
</td>

					</tr>	
				<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('#list').dataTable({
			"columnDefs": [
				{ "orderable": false, "targets": 3 } // Disable sorting for the 6th column (Action)
			]
		});
	$('#new_department').click(function(){
		uni_modal("New Department","manage_department.php")
	})
	$('.edit_department').click(function(){
		uni_modal("Edit Department","manage_department.php?id="+$(this).attr('data-id'))
	})
	$('.delete_department').click(function(){
	_conf("Are you sure to delete this department?","delete_department",[$(this).attr('data-id')])
	})
	
	})
	function delete_department($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_department',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>


