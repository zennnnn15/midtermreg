<?php
if(!isset($conn))
include 'db_connect.php';
?>
<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<form action="" id="manage_attendee">
				<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
				<div class="row">
					<div class="col-md-6 border-right">
						<div class="form-group">
							<label for="" class="control-label">Event</label>
							<select name="event_id" id="" class="custom-select custom-select-sm">
								<option></option>
								<?php 
								$event = $conn->query("SELECT * FROM events order by event asc");
								while($row = $event->fetch_assoc()):
								?>
								<option value="<?php echo $row['id'] ?>" <?php echo isset($event_id) && $event_id == $row['id'] ? "selected" : ""  ?>><?php echo ucwords($row['event']) ?></option>
								<?php endwhile; ?>
							</select>
						</div>
						<div class="form-group" id="event_dropdown"></div>

						<div class="form-group">
							<label for="" class="control-label">First Name</label>
							<input type="text" name="firstname" class="form-control form-control-sm" required value="<?php echo isset($firstname) ? $firstname : '' ?>">
						</div>
						<div class="form-group">
							<label for="" class="control-label">Middle Name</label>
							<input type="text" name="middlename" class="form-control form-control-sm"  value="<?php echo isset($middlename) ? $middlename : '' ?>">
						</div>
						<div class="form-group">
							<label for="" class="control-label">Last Name</label>
							<input type="text" name="lastname" class="form-control form-control-sm" required value="<?php echo isset($lastname) ? $lastname : '' ?>">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="" class="control-label">Gender</label>
							<select name="gender" id="" class="custom-select custom-select-sm">
								<option <?php echo isset($gender) && $gender == "Male" ? "selected" : '' ?>>Male</option>
								<option <?php echo isset($gender) && $gender == "Female" ? "selected" : '' ?>>Female</option>
							</select>
						</div>
						<div class="form-group">
							<label for="" class="control-label">Email</label>
							<input type="email" name="email" class="form-control form-control-sm" required value="<?php echo isset($email) ? $email : '' ?>">
						</div>
						<div class="form-group">
							<label for="" class="control-label">Contact No.</label>
							<input type="text" name="contact" class="form-control form-control-sm" required value="<?php echo isset($contact) ? $contact : '' ?>">
						</div>
						<div class="form-group">
							<label class="control-label">Address</label>
							<textarea name="address" id="" cols="30" rows="4" class="form-control" required><?php echo isset($address) ? $address : '' ?></textarea>
						</div>
					</div>
				</div>
				<hr>
				<div class="col-lg-12 text-right justify-content-center d-flex">
					<button class="btn btn-primary mr-2">Save</button>
					<button class="btn btn-secondary" type="button" onclick="location.href = 'index.php?page=attendees'">Cancel</button>
				</div>
			</form>
		</div>
	</div>
</div>
<style>
	img#cimg{
		max-height: 15vh;
		/*max-width: 6vw;*/
	}
</style>
<script>
	$('select[name="event_id"]').on('change', function() {
    var event_id = $(this).val();
    if (event_id) {
        // Fetch events for selected event_id
        $.ajax({
            url: 'ajax.php?action=get_events',
            data: {event_id: event_id},
            success: function(resp) {
                // Replace event dropdown with new options
                $('#event_dropdown').html(resp);
            }
        });
    } else {
        // Clear event dropdown if no event selected
        $('#event_dropdown').html('');
    }
});

	$('#manage_attendee').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_attendee',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp == 1){
					alert_toast('Data successfully saved.',"success");
					setTimeout(function(){
						location.replace('index.php?page=attendees')
					},750)
				}
			}
		})
	})
</script>