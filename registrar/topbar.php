<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-primary navbar-dark ">
    <!-- Left navbar links -->
    <div class="container">
      <ul class="navbar-nav">
        <?php if(isset($_SESSION['login_id'])): ?>
        <li class="nav-item">
          <!-- <a class="nav-link" data-widget="pushmenu" href="" role="button"><i class="fas fa-bars"></i></a> -->
        </li>
      <?php endif; ?>
        <li>
          <a class="nav-link text-white"  href="./" role="button"> <large><b>Event Registration</b></large></a>
        </li>
      </ul>

      <ul class="navbar-nav ml-auto">
       
        <li class="nav-item">
          <a class="nav-link nav-home" href="./">
            <b>Events</b>
          </a>
        </li>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link"  data-toggle="dropdown" aria-expanded="true" href="javascript:void(0)">
              <span>
                <div class="d-felx badge-pill">
                  <span class="fa fa-user mr-2"></span>
                  <span><b><?php echo ucwords($_SESSION['login_firstname']) ?></b></span>
                  <span class="fa fa-angle-down ml-2"></span>
                </div>
              </span>
            </a>
            <div class="dropdown-menu" aria-labelledby="account_settings" style="left: -2.5em;">
              <a class="dropdown-item" href="signup.php" id="manage_my_account"><i class="fa fa-cog"></i> Manage Account</a>
              <a class="dropdown-item" href="../admin/ajax.php?action=logout2"><i class="fa fa-power-off"></i> Logout</a>
            </div>
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
