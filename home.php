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


<?php include('admin/db_connect.php') ?>
<div class="col-lg-12">
  <div class="row">
    <div class="col-md-12 mb-4">

      <div class="input-group">
          <input type="search" id="filter" class="form-control form-control-lg" placeholder="Type your keywords here">
          <div class="input-group-append">
              <button type="button" id="search" class="btn btn-lg btn-default">
                  <i class="fa fa-search"></i>
              </button>
          </div>
      </div>
      <div class="col-md-12 py-2">
      <div class="row">
  <?php
  $events = $conn->query("SELECT * FROM events WHERE status = 1 ");

  $colors = array('bg-info', 'bg-success', 'bg-warning', 'bg-danger');
  $color_counter = 0;


    while($row = $events->fetch_assoc()):
      $trans = get_html_translation_table(HTML_ENTITIES,ENT_QUOTES);
        unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
        $desc = strtr(html_entity_decode($row['description']),$trans);
        $desc=str_replace(array("<li>","</li>"), array("",", "), $desc);
  ?>
 <a class="event-item text-dark" href="./index.php?page=manage_attendee&event=<?php echo urlencode($row['event']) ?>" data-id = '<?php echo $row['id'] ?>'>
    <div class="card card-widget widget-user mx-1 my-1" style="width: 15rem;">
      <!-- Add the bg color to the header using any of the bg-* classes -->
  <div class="widget-user-header <?php echo $colors[$color_counter]; ?>">


        <h3 class="widget-user-username"><?php echo ucwords($row['event']) ?></h3>
        <h5 class="widget-user-desc"><?php echo ucwords($row['venue']) ?></h5>
        <p class="truncate">
    <?php
        $datetime = new DateTime($row['event_datetime']);
        echo $datetime->format('l, F j, Y');
    ?>
</p>
      </div>
      <div class="card-footer">
        <div class="d-block py-1 px-1 w-100">
          <p class="truncate"><?php echo strip_tags($desc) ?></p>
        </div>
        <div class="d-block py-1 px-1 w-100">

        </div>
        <?php if($row['status'] != 2): ?>
          <span class="badge badge-success">Open</span>
        <?php else: ?>
          <span class="badge badge-secondary">Close</span>
        <?php endif; ?>
      </div>
    </div>
    <?php
   $color_counter++;
   if($color_counter >= count($colors)){
     $color_counter = 0;
   }
 ?>
  </a>
  <?php endwhile; ?>
</div>

      </div>
    </div>
  </div>
</div>
<style>
  .item-img{
    height: 13rem;
    overflow:hidden;
  }

</style>
<script>
  $('.event-item').hover(function(){
    $(this).find('.card').addClass('border border-info')
  })
  $('.event-item').mouseleave(function(){
    $(this).find('.card').removeClass('border border-info')
  })
  function _search(){
    var _f = $('#filter').val()
        _f = _f.toLowerCase();
    $('.event-item').each(function(){
        var txt = $(this).text().toLowerCase()
        if(txt.includes(_f) == true){
              $(this).toggle(true)

        }else{
            $(this).toggle(false)

        }
    })
  }
  $('#search').click(function(){
    _search()
  })
  $('#filter').on('keypress',function(e){
    if(e.which ==13){
    _search()
     return false; 
    }
  })
  $('#filter').on('search', function () {
      _search()
  });
</script>


<!-- Toastr -->
<script src="assets/plugins/toastr/toastr.min.js"></script>
<!-- Select2 -->
<script src="assets/plugins/select2/js/select2.full.min.js"></script>
<!-- Summernote -->
<script src="assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- dropzonejs -->
<script src="assets/plugins/dropzone/min/dropzone.min.js"></script>
<script src="assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script>
	$(document).ready(function(){
	  $('.select2').select2({
	    placeholder:"Please select here",
	    width: "100%"
	  });
  })
	 window.start_load = function(){
	    $('body').prepend('<div id="preloader2"></div>')
	  }
	  window.end_load = function(){
	    $('#preloader2').fadeOut('fast', function() {
	        $(this).remove();
	      })
	  }
	 window.viewer_modal = function($src = ''){
	    start_load()
	    var t = $src.split('.')
	    t = t[1]
	    if(t =='mp4'){
	      var view = $("<video src='"+$src+"' controls autoplay></video>")
	    }else{
	      var view = $("<img src='"+$src+"' />")
	    }
	    $('#viewer_modal .modal-content video,#viewer_modal .modal-content img').remove()
	    $('#viewer_modal .modal-content').append(view)
	    $('#viewer_modal').modal({
	            show:true,
	            backdrop:'static',
	            keyboard:false,
	            focus:true
	          })
	          end_load()  

	}
	  window.uni_modal = function($title = '' , $url='',$size=""){
	      start_load()
	      $.ajax({
	          url:$url,
	          error:err=>{
	              console.log()
	              alert("An error occured")
	          },
	          success:function(resp){
	              if(resp){
	                  $('#uni_modal .modal-title').html($title)
	                  $('#uni_modal .modal-body').html(resp)
	                  if($size != ''){
	                      $('#uni_modal .modal-dialog').addClass($size)
	                  }else{
	                      $('#uni_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-md")
	                  }
	                  $('#uni_modal').modal({
	                    show:true,
	                    backdrop:'static',
	                    keyboard:false,
	                    focus:true
	                  })
	                  end_load()
	              }
	          }
	      })
	  }
	  window._conf = function($msg='',$func='',$params = []){
	     $('#confirm_modal #confirm').attr('onclick',$func+"("+$params.join(',')+")")
	     $('#confirm_modal .modal-body').html($msg)
	     $('#confirm_modal').modal('show')
	  }
	   
	   window.alert_toast= function($msg = 'TEST',$bg = 'success' ,$pos=''){
	   	var Toast = Swal.mixin({
	      toast: true,
	      position: $pos || 'top-end',
	      showConfirmButton: false,
	      timer: 5000
	    });
	      Toast.fire({
	        icon: $bg,
	        title: $msg
	      })
	  }
  window.load_cart = function(){
    $.ajax({
      url:'admin/ajax.php?action=get_cart_count',
      success:function(resp){
        if(resp){
          resp =JSON.parse(resp)
          $('.cart-count').html(resp.count)
          if(Object.keys(resp.list).length > 0 ){
            var ul = $('<ul class="list-group"></ul>')
            Object.keys(resp.list).map(k=>{
              var li = $('<li class="list-group-item"><div class="item d-flex justify-content-between align-items-center"></div></li>')
               li.find('.item').append('<div class="cart-img"><img src="'+resp.list[k].img_path+'" alt=""></div>')
               li.find('.item').append('<div class="cart-title"><b>'+resp.list[k].pname+'</b></div>')
               li.find('.item').append('<span><span class="badge badge-primary cart-qty"><b>'+resp.list[k].qty+'</b></span></span>')
               ul.append(li)
            })
            $('#cart_product').html(ul)
          }else{
            $('#cart_product').html('<div class="d-block text-center bg-light"><b>No items.</b></div>')
          }
        }
      }
    })
  }
$(function () {
  bsCustomFileInput.init();
load_cart()
    $('.summernote').summernote({
        height: 300,
        toolbar: [
            [ 'style', [ 'style' ] ],
            [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
            [ 'fontname', [ 'fontname' ] ],
            [ 'fontsize', [ 'fontsize' ] ],
            [ 'color', [ 'color' ] ],
            [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
            [ 'table', [ 'table' ] ],
            [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
        ]
    })

  })
$('.number').on('input keyup keypress',function(){
        var val = $(this).val()
        val = val.replace(/[^0-9]/, '');
        val = val.replace(/,/g, '');
        val = val > 0 ? parseFloat(val).toLocaleString("en-US") : 0;
        $(this).val(val)
    })
</script>
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.js"></script>

<!-- PAGE assets/plugins -->
<!-- jQuery Mapael -->
<script src="assets/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="assets/plugins/raphael/raphael.min.js"></script>
<script src="assets/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="assets/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="assets/plugins/chart.js/Chart.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="assets/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="assets/dist/js/pages/dashboard2.js"></script>
<!-- DataTables  & Plugins -->
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="assets/plugins/jszip/jszip.min.js"></script>
<script src="assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

