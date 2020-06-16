  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../images/logo.png" class="img-circle" style="min-height: 50px" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>ACCS</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="search_results.php" method="POST" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="keyword" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-book"></i> <span>Courses</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="add_courses.php"><i class="fa fa-circle-o"></i> Add Courses</a></li>
            <li><a href="show_courses.php"><i class="fa fa-circle-o"></i> View Courses</a></li>
            
          </ul>
        </li>
          
         <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i> <span>Students</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="add_students.php"><i class="fa fa-circle-o"></i> Add Students</a></li>
            <li><a href="show_students.php"><i class="fa fa-circle-o"></i> View Students</a></li>
            
          </ul>
        </li>
         <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Counselors</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="add_counselor.php"><i class="fa fa-circle-o"></i> Add Counselor</a></li>
            <li><a href="show_counselor.php"><i class="fa fa-circle-o"></i> View Counselor</a></li>
            
          </ul>
          
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>News</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="add_news.php"><i class="fa fa-circle-o"></i>Add a News</a></li>
            <li><a href="show_news.php"><i class="fa fa-circle-o"></i>Show News</a></li>
            
          </ul>
          
        </li>
         <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Scholarship</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="add_scholarship.php"><i class="fa fa-circle-o"></i>Add a Scholarship</a></li>
            <li><a href="show_scholarship.php"><i class="fa fa-circle-o"></i>Show All</a></li>
            
          </ul>
          
        </li>
        
 
   
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>