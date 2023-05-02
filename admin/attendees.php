<?php include'db_connect.php' ?>
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-header">
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="./index.php?page=new_attendee"><i class="fa fa-plus"></i> Add New</a>
			</div>
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-bordered" id="list">
				<colgroup>
					<col width="5%">
					<col width="20%">
					<col width="25%">
					<col width="20%">
					<col width="15%">
					<col width="15%">
				</colgroup>
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>Event</th>
						<th>Attendee's Name</th>
						<th>Email</th>
						<th>Gender</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$qry = $conn->query("SELECT a.*,concat(a.lastname,', ',a.firstname,' ',a.middlename) as name,e.event FROM attendees a inner join events e on e.id = a.event_id order by unix_timestamp(e.date_created) desc ");
					while($row= $qry->fetch_assoc()):
					?>
					<tr>
						<th class="text-center"><?php echo $i++ ?></th>
						<td><b><?php echo ucwords($row['event']) ?></b></td>
						<td><b><?php echo ucwords($row['name']) ?></b></td>
						<td><b><?php echo $row['email'] ?></b></td>
						<td><b><?php echo ucwords($row['gender']) ?></b></td>
						<td class="text-center">
		                    <div class="btn-group">
		                        <a href="./index.php?page=edit_attendee&id=<?php echo $row['id'] ?>" class="btn btn-primary btn-flat">
		                          <i class="fas fa-edit"></i>
		                        </a>
		                         <button href="button" class="btn btn-info btn-flat view_attendee" data-id="<?php echo $row['id'] ?>">
		                          <i class="fas fa-eye"></i>
		                        </button>
		                        <button type="button" class="btn btn-danger btn-flat delete_attendee" data-id="<?php echo $row['id'] ?>">
		                          <i class="fas fa-trash"></i>
		                        </button>
	                      </div>
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
		$('#list').dataTable()
	$('.delete_attendee').click(function(){
	_conf("Are you sure to delete this attendee?","delete_attendee",[$(this).attr('data-id')])
	})
	$('.view_attendee').click(function(){
	uni_modal("Attendee Details","view_attendee.php?id="+$(this).attr('data-id'))
	})

	$('.status_chk').change(function(){
		var status = $(this).prop('checked') == true ? 1 : 2;
		if($(this).attr('data-state-stats') !== undefined && $('this').attr('data-state-stats') == 'error'){
			$(this).removeAttr('data-state-stats')
			return false;
		}
		var _this = $(this)
		// return false;
		var id = $(this).attr('data-id');
		start_load()
		$.ajax({
			url:'ajax.php?action=update_event_stats',
			method:'POST',
			data:{id:id,status:status},
			error:function(err){
				console.log(err)
				alert_toast("Something went wrong while updating the attendee's status.",'error')
					_this.attr('data-state-stats','error').bootstrapToggle('toggle')
					end_load()
			},
			success:function(resp){
				if(resp == 1){
					alert_toast("attendee status successfully updated.",'success')
					end_load()
				}else{
					alert_toast("Something went wrong while updating the attendee's status.",'error')
					_this.attr('data-state-stats','error').bootstrapToggle('toggle')
					end_load()
				}
			}
		})
	})
	})
	function delete_attendee($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_attendee',
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