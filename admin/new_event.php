<?php if(!isset($conn)){ include 'db_connect.php'; } ?>

<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-body">
			<form action="" id="manage-event">

        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="" class="control-label">Event</label>
							<input type="text" class="form-control form-control-sm" name="event" value="<?php echo isset($event) ? $event : '' ?>">
						</div>
					</div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="" class="control-label">Event Schedule</label>
              <input type="text" class="form-control form-control-sm datetimepicker" autocomplete="off" name="event_datetime" value="<?php echo isset($event_datetime) ? date("Y/m/d H:i",strtotime($event_datetime)) : '' ?>">
            </div>
			

          </div>
				</div>
        
        <div class="row">
           <div class="col-md-6">
            <div class="form-group">
              <label for="" class="control-label">Venue</label>
              <input type="text" class="form-control form-control-sm" name="venue" value="<?php echo isset($venue) ? $venue : '' ?>">
            </div>
          </div>
		  
          <div class="col-md-6">
  <div class="form-group">
    <label for="" class="control-label">Subevents</label>
    <button type="button" class="btn btn-sm btn-primary float-right mt-2" id="add-subevent">Add Subevent</button>
    <div id="subevents-container">
      <?php if(isset($subevents) && !empty($subevents)): ?>
        <?php foreach($subevents as $index => $subevent): ?>
          <br>
          <hr>
          <div class="subevent">
            <div class="form-group d-flex align-items-center">
              <label for="">Subevent Name</label>
              <input type="text" class="form-control form-control-sm mb-2 mr-2" name="subevents[<?php echo $index + 1 ?>][name]" value="<?php echo $subevent ?>">
              <button type="button" class="btn btn-sm btn-danger delete-subevent">Delete</button>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</div>




        </div>
				<div class="row">
					<div class="col-md-10">
						<div class="form-group">
							<label for="" class="control-label">Description</label>
							<textarea name="description" id="" cols="30" rows="10" class="summernote form-control">
								<?php echo isset($description) ? $description : '' ?>
							</textarea>
						</div>
					</div>
				</div>
        </form>
    	</div>
    	<div class="card-footer border-top border-info">
    		<div class="d-flex w-100 justify-content-center align-items-center">
    			<button class="btn btn-flat  bg-gradient-primary mx-2" form="manage-event">Save</button>
    			<button class="btn btn-flat bg-gradient-secondary mx-2" type="button" onclick="location.href='index.php?page=event_list'">Cancel</button>
    		</div>
    	</div>
	</div>
</div>
<script>
$('#manage-event').submit(function(e){
    e.preventDefault()
    start_load()


    var formData = new FormData($(this)[0]);
var subevents = [];

$('input[name^="subevents"]').each(function() {
  subevents.push($(this).val());
});

formData.append('subevents', JSON.stringify(subevents));


    $.ajax({
        url:'ajax.php?action=save_event',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        type: 'POST',
        success:function(resp){
            if(resp == 1){
                alert_toast('Data successfully saved',"success");
                setTimeout(function(){
                    location.href = 'index.php?page=event_list'
                },2000)
            }
        }
    })
})

$(document).ready(function() {
  var subeventIndex = 0;

  // Add subevent
  $("#add-subevent").click(function() {
    subeventIndex++;

    var html = `
<div class="subevent">
    <h5>Subevent ${subeventIndex}</h5>
   <div class="form-group">
  <label for="">Subevent Name</label>
  <input type="text" class="form-control form-control-sm mb-2" name="subevents[${subeventIndex}][name]">
</div>

    <button type="button" class="btn btn-sm btn-danger delete-subevent">Delete</button>
</div>
`;



    $("#subevents-container").append(html);

    // initialize datepicker
    $('.datetimepicker').datetimepicker({
      format: 'Y/m/d H:i'
    });
  });

  // Delete subevent
  $(document).on("click", ".delete-subevent", function() {
    $(this).closest(".subevent").remove();
  });
});





</script>

