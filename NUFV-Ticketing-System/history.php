<?php include 'db_connect.php' ?>

<style>
    .nowrap-date {
        white-space: nowrap;
    }
</style>

<div class="col-lg-12">
    <div class="text-right">
        <?php if ($_SESSION['login_type'] == 1 || $_SESSION['login_type'] == 2):?>
            <a href="ticket_export.php"><button class="btn btn-success" data-toggle="modal" data-target="#exampleModal">EXPORT CSV FILE</button></a>
            <a href="ticket_report.php"><button class="btn btn-danger mr-0" data-toggle="modal" data-target="#exampleModal">Download PDF</button></a>
        <?php endif; ?>
        <button type="button" class="btn btn-secondary mr-4" onclick="window.history.back();"><i class="bi bi-arrow-left-short"></i> Return</button>
    </div>
</div>
	<div class="card">
		<div class="card-body">
			<table class="table table-hover table-bordered" id="list">
				<colgroup>
					<col width="5%">
					<col width="15%">
					<col width="20%">
					<col width="15%">
					<col width="25%">
					<col width="10%">
					<col width="10%">
				</colgroup>
				<thead>
					<tr>
					<th style="background-color: #34418E;    color: white;">#</th>
					<th style="background-color: #34418E;    color: white;">Date Created</th>
					<th style="background-color: #34418E;    color: white;">Ticket</th>
					<th style="background-color: #34418E;    color: white;">Subject</th>
					<th style="background-color: #34418E;    color: white;">Description</th>
					<th style="background-color: #34418E;    color: white;">Status</th>
					<th style="background-color: #34418E;    color: white;"></th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$where = '';
					if($_SESSION['login_type'] == 2)
						$where .= " where t.department_id = {$_SESSION['login_department_id']} ";
					if($_SESSION['login_type'] == 3)
						$where .= " where t.customer_id = {$_SESSION['login_id']} ";
					$qry = $conn->query("SELECT t.*, concat(c.lastname,', ',c.firstname,' ',c.middlename) as cname FROM tickets t INNER JOIN customers c ON c.id = t.customer_id $where AND t.status = 2 ORDER BY UNIX_TIMESTAMP(t.date_created) ASC");
					while($row= $qry->fetch_assoc()):
						$trans = get_html_translation_table(HTML_ENTITIES,ENT_QUOTES);
						unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
						$desc = strtr(html_entity_decode($row['description']),$trans);
						$desc=str_replace(array("<li>","</li>"), array("",", "), $desc);
					?>
					<tr>
					<th class="text-center"><?php echo $i++ ?></th>
                    <td class="nowrap-date"><b><?php echo date("n/j/Y h:i:s A", strtotime($row['date_created'])); ?></b></td>
                    <td><b><?php echo ucwords($row['cname']) ?></b></td>
                    <td><b><?php echo $row['subject'] ?></b></td>
                    <td><b class="truncate"><?php echo strip_tags($desc) ?></b></td>



						<td>
							<?php if($row['status'] == 0): ?>
								<span class="badge badge-primary">Open</span>
							<?php elseif($row['status'] == 1): ?>
								<span class="badge badge-Info">Processing</span>
							<?php elseif($row['status'] == 2): ?>
								<span class="badge badge-success">Done</span>
							<?php endif; ?>
						</td>
						<td class="text-center">

                            <button type="button" class="btn btn-success btn-xs update" onclick="window.location.href='./index.php?page=view_ticket&id=<?php echo $row['id'] ?>'"><i class="fas fa-eye"></i>
                            View
                            </button>

                            <?php if ($_SESSION['login_type'] == 1 || $_SESSION['login_type'] == 2): ?>
        
                            <button type="button" class="btn btn-danger btn-xs update" onclick="window.location.href='./archive_ticket.php?ticket_id=<?php echo $row['id'] ?>'"> <i class="fas fa-trash"></i>
                            Delete                               
                            </button>

                    
                            <?php endif; ?>
                        </td>
					</tr>	
				<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>


	<style>
        .card {	
            margin-top: 25px;
        }

        @media only screen 
        and (min-device-width: 375px) 
        and (max-device-width: 812px)
        and (-webkit-device-pixel-ratio: 3) {
            .card {
                height: 150px;
                margin-top: 10px;
            }
        }
    </style>

</div>
<script>
    $(document).ready(function(){
        $('#list').dataTable({
            "columnDefs": [
                { "orderable": false, "targets": -1 }
            ]
        });
        
        $('.delete_ticket').click(function(){
            _conf("Are you sure to delete this ticket?","delete_ticket",[$(this).attr('data-id')])
        });
    });

    function delete_ticket($id){
        start_load();
        $.ajax({
            url:'ajax.php?action=delete_ticket',
            method:'POST',
            data:{id:$id},
            success:function(resp){
                if(resp==1){
                    alert_toast("Data successfully deleted",'success');
                    setTimeout(function(){
                        location.reload();
                    },1500);
                }
            }
        });
    }
</script>