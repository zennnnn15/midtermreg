<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php 
  date_default_timezone_set("Asia/Manila");
  ob_start();
  $title = isset($_GET['page']) ? ucwords(str_replace("_", ' ', $_GET['page'])) : "Home";
  ?>
  <title><?php echo $title ?> | Event Registration and Attendance System</title>
  <?php ob_end_flush() ?>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="assets/">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="assets//plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- DataTables -->
  <link rel="stylesheet" href="assets//plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets//plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="assets//plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
   <!-- Select2 -->
  <link rel="stylesheet" href="assets//plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="assets//plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
   <!-- SweetAlert2 -->
  <link rel="stylesheet" href="assets//plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="assets//plugins/toastr/toastr.min.css">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="assets//plugins/dropzone/min/dropzone.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="assets//plugins/icheck-bootstrap/icheck-bootstrap.min.css">
   <!-- Switch Toggle -->
  <link rel="stylesheet" href="assets//plugins/bootstrap4-toggle/css/bootstrap4-toggle.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets//dist/css/adminlte.min.css">
  <link rel="stylesheet" href="assets//dist/css/styles.css">
	<script src="assets//plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="assets//plugins/jquery-ui/jquery-ui.min.js"></script>
 <!-- summernote -->
  <link rel="stylesheet" href="assets//plugins/summernote/summernote-bs4.min.css">

  <!-- SweetAlert2 -->
<script src="assets//plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Switch Toggle -->
<script src="assets//plugins/bootstrap4-toggle/js/bootstrap4-toggle.min.js"></script>
</head>

<?php
if(!isset($conn))
include 'admin/db_connect.php';
$eventname = $_GET['event'];

?>
 <div class="content-header">
      <div class="container-md">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?php echo ucwords($eventname)." Event" ?></h1>
          </div><!-- /.col -->

        </div><!-- /.row -->
            <hr class="border-primary">
      </div><!-- /.container-fluid -->
    </div>
<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
        <div class="widget-user-header bg-info">
      </div>
      <div class="card-footer">
			<form action="" id="manage_attendee">
				<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
				<div class="row">
					<div class="col-md-6 border-right">
						<div class="form-group">
							<label for="" class="control-label">Event</label>
							<select name="event_id" id="" class="custom-select custom-select-sm">
								<option></option>
								<?php 
								 $eventname = $_GET['event'];
                                 $event = $conn->query("SELECT * FROM events WHERE event = '$eventname' AND status = 1 ORDER BY event ASC");

								while($row = $event->fetch_assoc()):
								?>
								<option value="<?php echo $row['id'] ?>" <?php echo isset($event_id) && $event_id == $row['id'] ? "selected" : ""  ?>><?php echo ucwords($row['event']) ?></option>
								<?php endwhile; ?>
							</select>
						</div>
						<div class="form-group" id="event_dropdown">
							
						</div>

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
  <label for="email" class="control-label">Email</label>
  <input type="email" name="email" id="email" class="form-control form-control-sm" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" value="<?php echo isset($email) ? $email : '' ?>">
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
                <input type="submit" value="Submit" class="btn btn-primary">


			</form>
		</div>
	</div>
</div>
<style>
	img#cimg{
		max-height: 15vh;
		/*max-width: 6vw;*/
	}

    .card-body {
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1.25rem;
    margin-top: 3em;
}
</style>
<script>
	$('select[name="event_id"]').on('change', function() {
    var event_id = $(this).val();
    if (event_id) {
        // Fetch events for selected event_id
        $.ajax({
            url: 'admin/ajax.php?action=get_events',
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
    e.preventDefault();
    start_load();
    var form = $(this);
    var formData = new FormData(form[0]);
    var emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    var contactRegex = /^\d{11}$/;

    // Check if required fields are empty
    var emptyFields = form.find('[required]').filter(function(){
        return this.value == '';
    });

    if(emptyFields.length){
        emptyFields.first().focus();
        alert_toast('Please fill up all required fields.', 'warning');
        end_load();
        return false;
    }

    // Check email format
    if(formData.get('email') && !emailRegex.test(formData.get('email'))){
        form.find('[name=email]').focus();
        alert_toast('Invalid email format.', 'warning');
        end_load();
        return false;
    }

    // Check contact number format
    if(formData.get('contact') && !contactRegex.test(formData.get('contact'))){
        form.find('[name=contact]').focus();
        alert_toast('Contact number should consist of 11 digits only.', 'warning');
        end_load();
        return false;
    }

    // Check if email already exists
    $.ajax({
        url:'admin/ajax.php?action=check_email_exist',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        type: 'POST',
        success:function(resp){
            if(resp == 1){
                alert_toast('Email already exists for this event.', 'warning');
                end_load();
            } else {
                // Submit the form to save attendee data
                $.ajax({
                    url:'admin/ajax.php?action=save_attendee',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    method: 'POST',
                    type: 'POST',
                    success:function(resp){
                        if(resp == 1){
                            alert_toast('Data successfully saved.', 'success');
                            setTimeout(function(){
                                location.replace('index.php');
                            },750);
                        }
                    }
                });
            }
        }
    });
});


$(document).ready(function(){
    <?php if(isset($_GET['id'])): ?>
        // Set the value of the event dropdown to the event ID associated with the attendee being edited
        var event_id = "<?php echo $event_id ?>";
        $('#event_id').val(event_id);

        // Trigger the change event of the first dropdown to show the second dropdown in advance
        $('#event_type').val(event_id).trigger('change');
    <?php endif; ?>

    // Show the event dropdown when the user selects an event in the first dropdown
    $('#event_type').change(function(){
        var event_type = $(this).val();
        if(event_type != '') {
            $('#event_dropdown').show();
        } else {
            $('#event_dropdown').hide();
        }
    });
});


</script>
