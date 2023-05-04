<?php
include 'db_connect.php';
$qry = $conn->query("SELECT * FROM events where id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
    $$k = $v;
}

// retrieve subevents from the database
$subevents = array();
$subevents_qry = $conn->query("SELECT * FROM event_sub WHERE idEvent = ".$_GET['id']);
while($row = $subevents_qry->fetch_assoc()){
    $subevents[] = $row['eventsubName'];
}

include 'new_event.php';
?>

</div>
