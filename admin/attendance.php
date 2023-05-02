<?php 
include 'db_connect.php';
$eid = isset($_GET['eid']) ? $_GET['eid'] : '';
if(!empty($eid)){
	$event = $conn->query("SELECT * FROM events where id = $eid")->fetch_array();
	foreach($event as $k => $v){
		$$k = $v;
	}
}
?>
<div class="col-lg-12">
	<div class="card card-outline card-info">
		<div class="card-header">
			<b>Attendance</b>
			<div class="card-tools">
				<button class="btn btn-success btn-flat" type="button" id="print_record">
				<i class="fa fa-print"></i> Print</button>
			</div>
			
		</div>
		<div class="card-body">
		<div class="row justify-content-center">
			<label for="" class="mt-2">Event</label>
			<div class="col-sm-4">
	            <select name="eid" id="eid" class="custom-select select2">
	                <option value=""></option>
	                <?php
	                $events = $conn->query("SELECT * FROM events order by event asc");
	                while($row=$events->fetch_assoc()):
	                ?>
	                <option value="<?php echo $row['id'] ?>" data-cid="<?php echo $row['id'] ?>" <?php echo $eid == $row['id'] ? 'selected' : '' ?>><?php echo ucwords($row['event']) ?></option>
	                <?php endwhile; ?>
	            </select>
			</div>
		</div>
		<hr>
		<?php if(empty($eid)): ?>
			<center> Please select event First.</center>
		<?php else: ?>
			<table class="table table-condensed table-bordered table-hover" id="att-records">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th class="">Name</th>
						<th class="">Gender</th>
						<th class="">Email</th>
						<th class="">Contact #</th>
						<th class="">Status</th>
					</tr>
				</thead>
				<tbody>
					<?php 
	                $i = 1;
					$attendees = $conn->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as name FROM attendees where event_id= $eid order by concat(lastname,', ',firstname,' ',middlename) asc ");
					if($attendees->num_rows > 0):
	                while($row=$attendees->fetch_assoc()):
	                    if($row['status'] == 1)
	                        $stats = "Present";
	                    else
	                        $stats = "Absent";
					?>
					<tr>
						<td class="text-center"><?php echo $i++ ?></td>
						<td class=""><?php echo ucwords($row['name']) ?></td>
						<td class=""><?php echo ucwords($row['gender']) ?></td>
						<td class=""><?php echo $row['email'] ?></td>
						<td class=""><?php echo $row['contact'] ?></td>
						<td class=""><?php echo $stats ?></td>
					</tr>
					<?php endwhile; ?>
					<?php else: ?>
					<tr>
						<th colspan="6"><center>No Records.</center></th>
					</tr>
					<?php endif; ?>
				</tbody>
			</table>
		<?php endif; ?>

		</div>
	</div>
</div>
<noscript>
	<style>
		table#att-records{
			width:100%;
			border-collapse:collapse
		}
		table#att-records td,table#att-records th{
			border:1px solid
		}
		.text-center{
			text-align:center
		}
	</style>
	<div>
		<p><b>Event: <?php echo isset($event) ? ucwords($event) : '' ?></b></p>
		<p><b>Venue: <?php echo isset($venue) ? ucwords($venue) : '' ?></b></p>
	</div>
</noscript>
<script>
	$(document).ready(function(){
		$('#eid').change(function(){
			location.href = 'index.php?page=attendance&eid='+$(this).val()
		})	

		$('#print_record').click(function(){
		var _c = $('#att-records').clone();
		var ns = $('noscript').clone();
			ns.append(_c)
		var nw = window.open('','_blank','width=900,height=600')
		nw.document.write(ns.html())
		nw.document.close()
		nw.print()
		setTimeout(() => {
			nw.close()
		}, 500);
	})
	})
	
</script>