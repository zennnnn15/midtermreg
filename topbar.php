<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-primary navbar-dark ">
  <div class="container">
    <ul class="navbar-nav flex-row"> <!-- Updated: Added d-flex and flex-row -->
      <li class="nav-item">
        <!-- <a class="nav-link" data-widget="pushmenu" href="" role="button"><i class="fas fa-bars"></i></a> -->
      </li>
      <li>
        <a class="nav-link text-white" href="./" role="button">
          <large><b>Event Registration</b></large>
        </a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto flex-row"> <!-- Updated: Added d-flex and flex-row -->
      <li class="nav-item d-flex align-items-center"> <!-- Updated: Added d-flex and align-items-center -->
        <a class="nav-link nav-home" href="./">
          <b>Events</b>
        </a>
        <a class="nav-link nav-home" href="registrar/login.php">
          <b>Registrar</b>
        </a>
        <a class="nav-link nav-home" href="admin/login.php">
          <b>Admin</b>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" aria-expanded="true" href="javascript:void(0)">
          <span>
            <div class="d-flex badge-pill"></div>
          </span>
        </a>
      </li>
    </ul>
  </div>
</nav>

  <style>
     .cart-img {
          width: calc(25%);
          max-height: 13vh;
          overflow: hidden;
          padding: 3px
      }
      .cart-img img{
        width: 100%;
        /*height: 100%;*/
      }
      .cart-qty {
        font-size: 14px
      }
  </style>
  <!-- /.navbar -->
  <script>
    $(document).ready(function(){
      var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
      if($('.nav-link.nav-'+page).length > 0){
        $('.nav-link.nav-'+page).addClass('active')
          console.log($('.nav-link.nav-'+page).hasClass('tree-item'))
        if($('.nav-link.nav-'+page).hasClass('tree-item') == true){
          $('.nav-link.nav-'+page).closest('.nav-treeview').siblings('a').addClass('active')
          $('.nav-link.nav-'+page).closest('.nav-treeview').parent().addClass('menu-open')
        }
        if($('.nav-link.nav-'+page).hasClass('nav-is-tree') == true){
          $('.nav-link.nav-'+page).parent().addClass('menu-open')
        }

      }
      $('.manage_account').click(function(){
        uni_modal('Manage Account','manage_user.php?id='+$(this).attr('data-id'))
      })
    })
  </script>
