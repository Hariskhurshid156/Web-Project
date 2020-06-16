<?php session_start(); 
include('includes/connection.php');
include('includes/functions.php');
if (!isset($_SESSION['id'])) {
  header('location: index.php');
}if (isset($_SESSION['tid'])) {
  header('location: app-counselor-dashboard.php');
}
?>
<!DOCTYPE html>
<html class="st-layout ls-top-navbar-large ls-bottom-footer show-sidebar sidebar-l3" lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Learning</title>
  <link href="css/vendor/all.css" rel="stylesheet">
  <link href="css/app/app.css" rel="stylesheet">
  <link rel="stylesheet" href="css/news.css">

   <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>

  <script src="js/vendor/jquery-3.3.1.js"></script>

  
</head>

<body>
<?php
 $counselor  = 'active';
  $accountpass = $account = $accountprofile = $courses = $messages = $mycourse = $takecourse = $courselist = $accdrop= $crsdrop =$dashboard ='';
?>
<div class="st-container">
  <!-- Fixed navbar -->
  <?php include('includes/header.php'); ?>
  <?php include('includes/sidebar.php'); ?>
  
  <div class="st-pusher" id="content">

      <!-- this is the wrapper for the content -->
      <div class="st-content">

        <!-- extra div for emulating position:fixed of the menu -->
        <div class="st-content-inner padding-none">

          <div class="container-fluid">

            <div class="page-section">
              <div class="media v-middle">
                <div class="media-body">
                  <h1 class="text-display-1 margin-none">Counselors:</h1>
                </div>
                
              </div>
            </div>

      <div class="row" data-toggle="isotope">
        <?php 
        $all = "SELECT * FROM counselor";
        $getall = mysqli_query($con , $all);
        while($data = mysqli_fetch_array($getall)){
        ?>
        <div class="item col-xs-12 col-sm-6 col-lg-4">
          <div class="panel panel-default paper-shadow" data-z="0.5">
            <div class="panel-heading" style="background-color: #42a5f5; color: white">
              <h3 class="panel-title"><a href="app-counselor-about.php?for=<?php echo $data['id']; ?>"><?php echo $data['name']; ?> (<?php echo $data['department']; ?>)</a></h3>
            </div>
            <div class="panel-body">
              <div class="media">
                <div class="media-left ">
                  <a href="website-instructor-public-profile.html">
                    <img class="img-circle" height="100px" width="100px" src="<?php echo $data['picture']; ?>" alt="people"  />
                  </a>
                </div>
                <div class="media-body">

                <span>Rating:</span> 
                  <p class="small margin-none media-right " >
                         <div class="rating-container rating-animate rating-disabled media-right">
                          <div class="clear-rating " title="Rating: <?php echo $data['average_rating']; ?> Stars">
                            <input id="input-1" name="input-1" class="rating rating-input" value="<?php echo $data['average_rating']; ?>" data-min="0" data-max="5" data-step="1" data-readonly="true" data-size="xs" readonly="readonly">
                          </div>
                        </div>
                      </p>
                </div>
              </div>
            </div>
            <div class="panel-footer" style="min-height: 150px">
              <?php 
              $cid = $data['id'];
                $latest = "SELECT * FROM ratings where counselor_id = '$cid' GROUP BY id ASC";
                $getlatest = mysqli_query($con , $latest);
                if (mysqli_num_rows($getlatest) > 0) {
                  $lat = mysqli_fetch_array($getlatest);
              ?>
              <h5 class="margin-none">Latest Review</h5>
              <div class="media">
                <div class="media-left">
                  <a href="website-course.html" class="icon-block half bg-gray-dark"><i class="text-white fa fa-user"></i></a>
                </div>
                <div class="media-body">
                  <p class="small text-muted"><?php echo $lat['review']; ?></p>
                   <p class=" margin-none media-right " >
                       <div class="rating-container rating-animate rating-disabled media-right">
                          <div class="clear-rating " title="Rating: <?php echo $lat['rating']; ?> Stars">
                            <input id="input-1" name="input-1" class="rating rating-input" value="<?php echo $lat['rating']; ?>" data-min="0" data-max="5" data-step="1" data-readonly="true" data-size="xs" readonly="readonly">
                          </div>
                        </div>
                      </p>
                </div>
              </div>

              <?php
                }
              ?>
            </div>
            <div class="panel-footer text-right">
              <a style="background-color: #42a5f5;"  href="app-counselor-about.php?for=<?php echo $data['id']; ?>" class="btn btn-sm btn-primary">View profile</a>
            </div>
          </div>
        </div>
      <?php } ?>


    </div>
  </div>
</div>
</div>
</div>
 <?php include('includes/footer.php'); ?>