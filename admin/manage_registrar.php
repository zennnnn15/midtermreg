<?php include 'db_connect.php' ?>
<?php 
// echo "SELECT * FROM assigned_registrar where event_id = {$_GET['id']}";
$qry = $conn->query("SELECT * FROM assigned_registrar where event_id = {$_GET['id']}");
$users = array();
while($row = $qry->fetch_assoc()){
	$users[] = $row['user_id'];
}
?>
<div class="container-fluid">
	<form action="" id="ar-frm">
		<input type="hidden" name="event_id" value="<?php echo $_GET['id'] ?>">
		<div class="form-group">
			<label for="">Registrars</label>
			<select name="user_id[]" id="user_id" multiple="multiple" class="custom-select custom-select-sm select2" >
				<option value=""></option>
				<?php 
				$uqry = $conn->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as name FROM users where type = 2 order by concat(lastname,', ',firstname,' ',middlename) asc");
				while($row = $uqry->fetch_assoc()):
				?>
				<option value="<?php echo $row['id'] ?>" <?php echo count($users) > 0 && in_array($row['id'],$users) ? "selected" : '' ?>><?php echo ucwords($row['name']) ?></option>
				<?php endwhile; ?>
			</select>
		</div>
	</form>
</div>

<script>
	$(document).ready(function(){
	$('.select2').select2({
		placeholder:"Please select here.",
		width:"100%"
	})
	
	$('#ar-frm').submit(function(e){
		e.preventDefault();
		start_load()
		$.ajax({
			url:'ajax.php?action=assign_registrar',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp ==1){
					alert_toast("Data successfully saved",'success')
					setTimeout(function(){
						location.reload()
					},1500)
				}
			}
		})
	})
	})

</script>