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
    <div id="subevents-container">
      <?php
      if(isset($subevents)){
        foreach(json_decode($subevents) as $subevent){
          echo '<input type="text" class="form-control form-control-sm mb-2" name="subevents[]" value="'.$subevent.'">';
        }
      }
      ?>
    </div>
    <button type="button" class="btn btn-sm btn-primary mt-2" id="add-subevent">Add Subevent</button>
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

    var subevents = []
    $('input[name="subevents[]"]').each(function() {
        subevents.push($(this).val())
    })

    var formData = new FormData($(this)[0])
    formData.append('subevents', JSON.stringify(subevents))

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

$(document).ready(function(){
    var subeventTemplate = '<input type="text" class="form-control form-control-sm mb-2" name="subevents[]">';
    $('#add-subevent').click(function(){
        $('#subevents-container').append(subeventTemplate);
    });
});

</script>

