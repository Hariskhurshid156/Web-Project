    <?php 
    
  session_start();
  include('includes/connection.php');
  if (isset($_SESSION['type'])) {
    if ($_SESSION['type'] == 'student') {
       header('location: app-student-dashboard.php');
    }elseif ($_SESSION['type'] == 'counselor') {
      header('location: app-counselor-dashboard.php');
    }
   
  }
?>
<!DOCTYPE html>
<html class="hide-sidebar ls-bottom-footer transition-navbar-scroll top-navbar-xlarge bottom-footer " lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>ACCS | Advisory & Career counseling System</title>

  <link href="css/vendor/all.css" rel="stylesheet">

  <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>


 
  <link href="css/app/app.css" rel="stylesheet">
  <link rel="shortcut icon" type="image/png" href="images/logo.png"/>
  <style type="text/css">
    .btn-primary{
      background-color: #42a5f5;
    }
  </style>
</head>

<body class="login">

   <script src="widget.js"></script>
    <script>
        var botmanWidget = {
            frameEndpoint: 'chat.html',
            introMessage: 'Hello there.',
            chatServer : 'botman.php', 
            title: 'ACCS ASSISTANT'
        }; 
    </script>
  <!-- Fixed navbar -->
  <div class="navbar navbar-default navbar-fixed-top navbar-size-large navbar-size-xlarge paper-shadow" data-z="0" data-animated role="navigation">
    <div class="">
      <div class="navbar-header">
         
          <button ton type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-nav">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
           <div class="navbar-brand navbar-brand-logo" style="background-color: #42a5f5; padding-left: 17px">
          <a class="  " href="index.php">
           <img src="images/logo.png" height="50" width="100">
          </a>
        </div>
        </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="main-nav" style="margin-right: 50px">
        <div class="navbar-right">
          
          <a href="student-login.php" class="navbar-btn btn btn-primary">Log In As Student</a> &nbsp
            <a href="counselor-login.php" class="navbar-btn btn btn-primary">Log In As Counselor</a>
        </div>
      </div>
      <!-- /.navbar-collapse -->

    </div>
  </div>

  <div class="parallax cover overlay cover-image-full home">
    <img class="parallax-layer" src="images/index.jpg" alt="Learning Cover" />
    <div class="parallax-layer overlay overlay-full overlay-bg-white bg-transparent" data-opacity="true" data-speed="8">
      <div class="v-topright" style="padding-top: 180px; ">
        <div class="page-section">
          <h1 class="text-display-2 overlay-bg-white margin-v-0-15 inline-block" style="font-size: 50px; font-family: serif;" >ACCS</h1>
          <br/>
          <p class="lead text-overlay overlay-bg-white-strong inline-block" style="font-size: 35px; font-family: serif;" >Advisory & Career Counseling System</p>
        </div>
      </div>
    </div>
    
  </div>

  <div class="container">
    <div class="page-section-heading">
      <h2 class="text-display-1">Services</h2>
      <p class="lead text-muted">Learn about all of the major services.</p>
    </div>
    <div class="row" data-toggle="gridalicious">

      <div class="media">
        <div class="media-left padding-none">
          <div class="bg-green-300 text-white">
            <div class="panel-body">
              <i class="fa fa-graduation-cap fa-2x fa-fw"></i>
            </div>
          </div>
        </div>
        <div class="media-body" >
          <div class="panel panel-default">
            <div class="panel-body"  style="min-height: 150px">
              <div class="text-headline">Register Courses Online</div>
              <p>Students can register their relevant courses online and can view their registration status.</p>
            </div>
          </div>
        </div>
      </div>

      <div class="media">
        <div class="media-left padding-none">
          <div class="bg-purple-300 text-white">
            <div class="panel-body">
              <i class="fa fa-bar-chart fa-2x fa-fw"></i>
            </div>
          </div>
        </div>
        <div class="media-body">
          <div class="panel panel-default">
            <div class="panel-body"  style="min-height: 150px">
              <div class="text-headline">Student Dashboard</div>
              <p>Enables students to get latest news and scholarships and also their progress summary in a graphical view.</p>
            </div>
          </div>
        </div>
      </div>

      <div class="media">
        <div class="media-left padding-none">
          <div class="bg-orange-400 text-white">
            <div class="panel-body">
              <i class="fa fa-user fa-2x fa-fw"></i>
            </div>
          </div>
        </div>
        <div class="media-body">
          <div class="panel panel-default">
            <div class="panel-body" style="min-height: 150px">
              <div class="text-headline">Profiles</div>
              <p>Students and counselors have their personal profile to interact with each other and get the most of it.  .</p>
            </div>
          </div>
        </div>
      </div>

      <div class="media">
        <div class="media-left padding-none">
          <div class="bg-cyan-400 text-white">
            <div class="panel-body">
              <i class="fa fa-star-o fa-2x fa-fw"></i>
            </div>
          </div>
        </div>
        <div class="media-body">
          <div class="panel panel-default">
            <div class="panel-body" style="min-height: 150px">
              <div class="text-headline">counselors  Rating</div>
              <p>counselor's Rating based on how satisfied student are from them. Helps Other students to choose a counselor.</p>
            </div>
          </div>
        </div>
      </div>

      <div class="media">
        <div class="media-left padding-none">
          <div class="bg-pink-400 text-white">
            <div class="panel-body">
              <i class="fa fa-list fa-2x fa-fw"></i>
            </div>
          </div>
        </div>
        <div class="media-body">
          <div class="panel panel-default">
            <div class="panel-body" style="min-height: 150px">
              <div class="text-headline">Student Reviews</div>
              <p>Students reviews about counselors to help counselors to improve their performance on the basis of these reviews.</p>
            </div>
          </div>
        </div>
      </div>

      <div class="media">
        <div class="media-left padding-none">
          <div class="bg-red-400 text-white">
            <div class="panel-body" >
              <i class="fa fa-pencil fa-2x fa-fw"></i>
            </div>
          </div>
        </div>
        <div class="media-body">
          <div class="panel panel-default">
            <div class="panel-body"style="min-height: 150px">
              <div class="text-headline">Counseling</div>
              <p>Enables students to get counseling from their university counselors and get answers to their queried and solution to their problems.</p>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>
  <br/>

  <div class="page-section bg-white">
    <div class="container">

      <div class="text-center">
        <h3 class="text-display-1">Our Top Counselors</h3>
        <p class="lead text-muted">Some of our top rated counselors with best feedback.</p>
      </div>
      <br/>

      <div class="slick-basic slick-slider" data-items="2" data-items-lg="3" data-items-md="2" data-items-sm="1" data-items-xs="1">
        
        <?php
          $top = "SELECT * FROM counselor GROUP BY average_rating LIMIT 5";
          $gettop = mysqli_query($con,$top);
          if (mysqli_num_rows($gettop) > 0) {
            while ($row=mysqli_fetch_array($gettop)) {
        ?>
        <div class="item">
          <div class="panel panel-default paper-shadow" data-z="0.5" data-hover-z="1" data-animated>
            <div class="panel-body">
              <div class="media media-clearfix-xs">
                <div class="media-left">
                  <div class="cover width-90 width-100pc-xs overlay cover-image-full hover">
                    <span class="img icon-block s140 bg-default"></span>
                    <span class="overlay overlay-full padding-none icon-block s90 bg-default">
                        <span class="v-center">
                            <img src="<?php echo $row['picture']; ?> " class="width-90">
                        </span>
                    </span>
                  </div>
                </div>
                <div class="media-body">
                  <h4 class="media-heading margin-v-5-3"><a href="student-login.php"><?php echo $row['name']; ?></a></h4>
                  <br><p class=" margin-none">
                    <div class="rating-container rating-animate ">
                          <div class="clear-rating " title="Rating: <?php echo $row['average_rating']; ?> Stars">
                            <input id="input-1" name="input-1" class="rating" value="<?php echo $row['average_rating']; ?>" data-min="0" data-max="5" data-step="1" data-readonly="true" data-size="xs" readonly="readonly">
                          </div>
                        </div>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <?php
            }
          }
        ?>
        
      </div>

      <div class="text-center">
        <br/>
        <a class="btn btn-lg btn-primary" href="student-login.php">Browse More</a>
      </div>

    </div>
  </div>

  <div class="parallax cover overlay height-300 margin-none">
    <img class="parallax-layer" data-auto-offset="true" data-auto-size="false" src="images/review.webp" alt="Learning Cover" />
    <div class="parallax-layer overlay overlay-full overlay-bg-white bg-transparent" data-opacity="true" data-speed="8">
      <div class="v-center">
        <div class="page-section">
          <h1 class="text-display-2 overlay-bg-white margin-v-0-15 inline-block">Feedback</h1>
          <br/>
          <p class="lead text-overlay overlay-bg-white-strong inline-block">How much students are satisfied from counselors</p>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="page-section">
      <div class="row">
         <?php
          $top = "SELECT * FROM ratings GROUP BY rating LIMIT 3";
          $gettop = mysqli_query($con,$top);
          if (mysqli_num_rows($gettop) > 0) {
            while ($row=mysqli_fetch_array($gettop)) {
              $cid = $row['counselor_id'];
              $query = "SELECT * FROM counselor where id = '$cid'";
              $run = mysqli_query($con , $query);
              $data = mysqli_fetch_array($run);
        ?>
        <div class="col-md-4">
          <div class="testimonial">
            <div class="panel panel-default">
              <div class="panel-body">
                <p><?php echo $row['review']; ?>.</p>
              </div>
            </div>
            <div class="media v-middle">
              <div class="media-left">
                <img src="images/people/blank.png" alt="People" class="img-circle width-40" />
              </div>
              <div class="media-body">
                <p class="text-subhead margin-v-5-0">
                  <strong>Student. <span class="text-muted">@ <?php echo $data['name']; ?>.</span></strong>
                </p>
                <p class="small">
                  <div class="rating-container rating-animate ">
                          <div class="clear-rating " title="Rating: <?php echo $row['rating']; ?> Stars">
                            <input id="input-1" name="input-1" class="rating" value="<?php echo $row['rating']; ?>" data-min="0" data-max="5" data-step="1" data-readonly="true" data-size="xs" readonly="readonly">
                          </div>
                        </div>
                </p>
              </div>
            </div>
          </div>
        </div>
      <?php 
          }
        } 
      ?>
        
      </div>
    </div>
    <br/>

  </div>

  <section class="footer-section">
    <div class="container">
      <div class="row">
        
        <div class="">
          <h4 class="text-headline text-light">Your Reviews:</h4>

          <div class="form-group">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Say something">
              <span class="input-group-btn">
								<button class="btn btn-grey-800" type="button">Submit</button>
							  </span>
            </div>
          </div>
          <br/>
          <p class="text-center">
            <a href="#" class="btn btn-indigo-500 btn-circle"><i class="fa fa-facebook"></i></a>
            <a href="#" class="btn btn-pink-500 btn-circle"><i class="fa fa-dribbble"></i></a>
            <a href="#" class="btn btn-blue-500 btn-circle"><i class="fa fa-twitter"></i></a>
            <a href="#" class="btn btn-danger btn-circle"><i class="fa fa-google-plus"></i></a>
          </p>

        </div>
      </div>
    </div>
    </div>
  </section>

  <?php include('includes/footer.php'); ?>