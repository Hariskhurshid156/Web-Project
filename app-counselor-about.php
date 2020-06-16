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

$oldrating = $count = $sumrating = $averagerating = $totalrating= 0;
$oldreview = $ratingErr = $reviewErr ='';
session_start();
$id = $_SESSION['id'];

if(isset($_GET['for'])){
  $cid = $_GET['for'];
  $sql = "SELECT * FROM counselor where id = '$cid'";
  $getdata = mysqli_query($con , $sql);
  if ($getdata) {
    $cdata = mysqli_fetch_array($getdata);
  }else{
    header('location: app-list-counselors.php');
  }
}elseif(!isset($_GET['for'])){
  header('location: app-list-counselors.php');
}




if (isset($_POST['ratecounselor'])) {
  $rating = $_POST['rating'];
  $review = $_POST['review'];

  if (empty($rating)) {
    $ratingErr = "Rating is required";
    $_SESSION['error'] = $ratingErr;
  }
  if (empty($review)) {
    $reviewErr = "Review is required";
    $_SESSION['error'] = $reviewErr;
  }

  if (empty($reviewErr) && empty($ratingErr)) {
    
    $query = "SELECT * FROM ratings where std_id = '$id' && counselor_id = '$cid'";
    $run = mysqli_query($con,$query);
    if (mysqli_num_rows($run) > 0) {
      $update = "UPDATE ratings SET rating = '$rating', review = '$review' WHERE std_id = '$id' && counselor_id = '$cid'";
      $runupdate = mysqli_query($con , $update);
      if ($runupdate) {
        $_SESSION['success'] = "Rating Updated";
        $average = getaverage($cid);

        updateaverage($cid , $average);
      }else
      $_SESSION['error'] = "Some Error Occured";
    }elseif(mysqli_num_rows($run) == 0) {
      $add = "INSERT INTO ratings(`std_id` , `counselor_id` , `rating` , `review`) VALUES('$id' , '$cid' , '$rating' , '$review')";
      $addrating = mysqli_query($con , $add);
      if ($addrating) {
        $_SESSION['success'] = "Rated Succesfully";
        $average = getaverage($cid);

        updateaverage($cid , $average);
      }
    }else
      $_SESSION['error'] = "Some Error Occured";
  }
}

//getting old rating. if already rated
$oldd = "SELECT * FROM ratings where std_id = '$id' && counselor_id = '$cid'";
      $runold = mysqli_query($con,$oldd);
      if (mysqli_num_rows($runold) > 0) {
    $getrating=mysqli_fetch_array($runold);
    $oldrating = $getrating['rating'];
    $oldreview = $getrating['review'];
  }
$averagerating = getaverage($cid);

?>
<?php include('includes/header.php'); ?>

   <?php include('includes/sidebar.php'); ?>  
  <div class="">

    

    <div class="st-pusher" id="content">

      <div class="st-content">
        <div class="st-content-inner padding-none">

          <div class="container-fluid">

            <div class="media media-grid media-clearfix-xs">
              <div class="media-body">

                <div class="page-section">
                  <div class="media">
                    <div class="media-left">
                      <span class="icon-block s60"><img height="60" width="60" src="<?php echo $cdata['picture']; ?>"></span>
                    </div>
                    <div class="media-body">
                      <h1 class="text-display-1 margin-none"> <?php echo $cdata['name']; ?></h1>
                      <strong class=" margin-none">
                        <div class="rating-container rating-animate rating-disabled">( <?php echo $averagerating;?> )
                          <div class="clear-rating " title="Rating: <?php echo $averagerating; ?> Stars">
                            <input id="input-1" name="input-1" class="rating rating-input" value="<?php echo $averagerating; ?>" data-min="0" data-max="5" data-step="1" data-readonly="true" data-size="xs" readonly="readonly">
                          </div>
                        </div>
                        
                      </strong>
                    </div>
                  </div><hr>
                </div>

                <div class="page-section">
                  <?php include('includes/flash_messages.php'); ?>  
                  <h2 class="text-headline margin-none">About:</h2>
                  <ul class="list-group relative paper-shadow margin-none" data-hover-z="0.5" data-animated>
                    <li class="list-group-item">
                      <div class="media v-middle">
                        <div class="media-left">
                          <div class="icon-block s30 bg-red-300 text-white img-circle">
                            <i class="fa fa-building  "></i>
                          </div>
                        </div>
                        <div class="media-body text-body-2">
                          <span class="media-left" style="font-size: 18px">Department: </span> <span class="media-body" style="padding-left: 30px"><?php echo $cdata['department']; ?></span>
                        </div>
                      </div>
                    </li>
                    <li class="list-group-item paper-shadow">
                      <div class="media v-middle">
                        <div class="media-left">
                          <div class="icon-block s30 bg-green-300 text-white img-circle">
                            <i class="fa fa-envelope"></i>
                          </div>
                        </div>
                        <div class="media-body text-body-2">
                           <span class="media-left" style="font-size: 18px">Email: </span> <span class="media-body" style="padding-left: 81px"><?php echo $cdata['email']; ?></span>
                        </div>
                      </div>
                    </li>
                    <?php if(isset($cdata['skype_id'])){ ?>
                    <li class="list-group-item paper-shadow">
                      <div class="media v-middle">
                        <div class="media-left">
                          <div class="icon-block s30 bg-indigo-300 text-white img-circle">
                            <i class="fa fa-skype"></i>
                          </div>
                        </div>
                        <div class="media-body text-body-2">
                         <span class="media-left" style="font-size: 18px">Skype: </span> <span class="media-body" style="padding-left: 78px"><?php echo $cdata['skype_id']; ?></span>
                        </div>
                      </div>
                    </li><?php }  if(isset($cdata['qualification'])){ ?>
                    <li class="list-group-item paper-shadow">
                      <div class="media v-middle">
                        <div class="media-left">
                          <div class="icon-block s30 bg-orange-300 text-white img-circle">
                            <i class="fa fa-graduation-cap"></i>
                          </div>
                        </div>
                        <div class="media-body text-body-2">
                          <span class="media-left" style="font-size: 18px">Qualification: </span> <span class="media-body" style="padding-left: 25px"><?php echo $cdata['qualification']; ?></span>
                        </div>
                      </div>
                    </li><?php } if(isset($cdata['phone_number'])){ ?>
                    <li class="list-group-item paper-shadow">
                      <div class="media v-middle">
                        <div class="media-left">
                          <div class="icon-block s30 bg-grey-500 text-white img-circle">
                            <i class="fa fa-phone"></i>
                          </div>
                        </div>
                        <div class="media-body text-body-2">
                          <span class="media-left" style="font-size: 18px">Phone: </span> <span class="media-body" style="padding-left: 75px"><?php echo $cdata['phone_number']; ?></span>
                        </div>
                      </div>
                    </li><?php } ?>
                  </ul>
                </div>

                <h2 class="text-headline margin-none">Reviews: </h2>  
                <br/>

                <div class="row">
                <?php 
                $get = "SELECT * FROM ratings where counselor_id = '$cid'";
                $gettotal = mysqli_query($con,$get);
                if (mysqli_num_rows($gettotal) > 0 ) {
                  while($result = mysqli_fetch_array($gettotal)){
                ?>
                  <div class="col-md-6">
                    <div class="testimonial">
                      <div class="panel panel-default">
                        <div class="panel-body">
                          <p><?php echo $result['review']; ?></p>
                        </div>
                      </div>
                      <div class="media v-middle">
                        <div class="media-left">
                          <img src="images/people/blank.png" alt="People" class="img-circle width-40" />
                        </div>
                        <div class="media-body">
                          <p class="text-subhead margin-v-5-0">
                            <strong>User</strong>
                          </p>
                          <p class="">
                            <div class="rating-container rating-animate rating-disabled">
                              <div class="clear-rating " title="Rating: (<?php echo $result['rating']; ?> Stars)">
                                <input id="input-1" name="input-1" class="rating" value="<?php echo $result['rating']; ?>" data-min="0" data-max="5" data-step="1" data-readonly="true" data-size="xs" readonly="readonly">
                              </div>
                            </div>
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php } }else{
                    echo "<p class='text-center' style='color: red;' > No Reviews yet </p>";
                  } ?>
                </div><br><br><br><br>

              </div>

              <div class="media-right">

                <div class="page-section width-270 width-auto-xs">
                  <div class="panel panel-default paper-shadow" data-z="0.5" data-hover-z="1" data-animated>
                    <form method="POST" action="app-counselor-about.php?for=<?php echo $cid; ?>">
                    <div class="panel-heading">
                      <h4 class="text-headline">Rate this counselor: </h4>
                      <?php if (!empty($oldrating)) { ?>
                      <p class="text-center" style="color: green">Already Rated</p><?php 
                      }else{
                        echo " <p class='text-center' style='color: red'>Not Rated yet</p>";
                      } 

                      ?>
                    </div>
                    <div class="panel-body">
                      <p class="large text-center" style="font-size: 20px">
                          <input id="input-1" name="rating" class="rating rating-loading" value="<?php echo $oldrating; ?>" data-min="0" data-max="5" data-step="0.5" data-size="xs">
                          </p>
                    </div>
                    <hr class="margin-none" />
                    <div class="panel-body text-center">
                      
                      <textarea class="form-control" name="review" placeholder="Your reviews" ><?php echo $oldreview; ?></textarea>
                      
                    </div>
                    <ul class="list-group">
                      <li class=" text-center">
                         <button type="submit" name="ratecounselor" class="btn btn-success paper-shadow relative" data-z="0.5" data-hover-z="1" data-animated>Rate</button>
                      </li>
                     
                    </ul>
                   
                  </form>
                  </div>
            
                </div>

              </div>
            </div>

          </div>

        </div>

      </div>

    </div>


<script>
$("#input-id").rating();
</script>


   <?php include('includes/footer.php'); ?>