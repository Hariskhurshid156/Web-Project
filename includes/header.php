

<div class="navbar navbar-size-large navbar-default navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <a href="#sidebar-menu" data-toggle="sidebar-menu" class="toggle pull-left visible-xs"><i class="fa fa-ellipsis-v"></i></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-nav">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div class="navbar-brand navbar-brand-primary navbar-brand-logo navbar-nav-padding-left">
            <a class="svg" href="app-student-dashboard.php">
              <img src="images/logo.png" height="50" width="100" style="margin-left: 50px">
            </a>
          </div>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="main-nav">
          <ul class="nav navbar-nav">
          </ul>
          <ul class="nav navbar-nav navbar-nav-bordered navbar-right">
            <!-- notifications -->
            
            <!-- // END notifications -->
            <!-- User -->
            <li class="dropdown">
              <a href="#" class="dropdown-toggle user" data-toggle="dropdown">
                <img src="<?php echo $_SESSION['picture']; ?>" alt="Bill" class="img-circle" width="40" /><?php echo $_SESSION['name']; ?><span class="caret"></span>
              </a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="app-student-profile.php">Account</a></li>
                <li><a href="includes/logout.php?for=<?php echo $_SESSION['type']; ?>">Logout</a></li>
              </ul>
            </li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->

      </div>
    </div>
