<?php include '../admin/db_connect.php' ?>

<?php
if(isset($_GET['id'])){
  $qry = $conn->query("SELECT attendees.*, 
  CONCAT(attendees.lastname, ', ', attendees.firstname, ' ', attendees.middlename) AS name, 
  events.event, 
  event_sub.eventsubName AS sub_event 
FROM attendees 
INNER JOIN events ON attendees.event_id = events.id 
LEFT JOIN event_sub ON attendees.subevent_id = event_sub.eventID  
WHERE attendees.id = ".$_GET['id'])->fetch_array();
  foreach($qry as $k => $v){
      $$k = $v;
  }
}


?>
<div class="container-fluid">
	<div class="card card-widget widget-user shadow">
      <div class="widget-user-header bg-dark">
        <h3 class="widget-user-username"><?php echo ucwords($name) ?></h3>
        <h5 class="widget-user-desc"><?php echo $email ?></h5>
      </div>
      <div class="widget-user-image">
      	<span class="brand-image img-circle elevation-2 d-flex justify-content-center align-items-center bg-primary text-white font-weight-500" style="width: 90px;height:90px"><h4><?php echo strtoupper(substr($firstname, 0,1).substr($lastname, 0,1)) ?></h4></span>
      </div>
      <div class="card-footer">
        <div class="container-fluid">
        	<dl>
            <dt>Attendee of</dt>
            <dd><?php echo ucwords($event) ?></dd>
            <?php if($sub_event): ?>
                        <dt>Registerd Event</dt>
                        <dd><?php echo $sub_event ?></dd>
                    <?php endif; ?>
            <dt>Gender</dt>
            <dd><?php echo $gender ?></dd>
            <dt>Contact No.</dt>
            <dd><?php echo $contact ?></dd>
        		<dt>Address</dt>
        		<dd><?php echo $address ?></dd>
        	</dl>
        </div>
    </div>
	</div>
</div>
<div class="modal-footer display p-0 m-0">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
<style>
	#uni_modal .modal-footer{
		display: none
	}
	#uni_modal .modal-footer.display{
		display: flex
	}
</style>