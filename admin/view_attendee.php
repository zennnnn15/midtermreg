<?php include 'db_connect.php' ?>
<?php
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT a.*,concat(a.lastname,', ',a.firstname,' ',a.middlename) as name,e.event FROM attendees a inner join events e on e.id = a.event_id where a.id = ".$_GET['id'])->fetch_array();
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