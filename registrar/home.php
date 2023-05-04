<?php include('../admin/db_connect.php') ?>
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
   $events = $conn->query("SELECT * FROM events WHERE id IN (SELECT event_id FROM assigned_registrar WHERE user_id = {$_SESSION['login_id']})");

    while($row = $events->fetch_assoc()):
      $trans = get_html_translation_table(HTML_ENTITIES,ENT_QUOTES);
        unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
        $desc = strtr(html_entity_decode($row['description']),$trans);
        $desc=str_replace(array("<li>","</li>"), array("",", "), $desc);
  ?>
  <a class="event-item text-dark" href="./index.php?page=manage_attendance&c=<?php echo md5($row['id']) ?>" data-id = '<?php echo $row['id'] ?>'>
    <div class="card card-widget widget-user mx-1 my-1" style="width: 15rem;">
      <!-- Add the bg color to the header using any of the bg-* classes -->
      <div class="widget-user-header bg-info">
        <h3 class="widget-user-username"><?php echo ucwords($row['event']) ?></h3>
        <h5 class="widget-user-desc"><?php echo ucwords($row['venue']) ?></h5>
      </div>
      <div class="card-footer">
        <div class="d-block py-1 px-1 w-100">
          <p class="truncate"><?php echo strip_tags($desc) ?></p>
        </div>
        <?php if($row['status'] != 2): ?>
          <span class="badge badge-success">Open</span>
        <?php else: ?>
          <span class="badge badge-secondary">Close</span>
        <?php endif; ?>
      </div>
    </div>
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