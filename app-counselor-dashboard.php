<?php include('includes/t_head.php'); ?>
<?php
  $dashboard = 'active';
  $reviews = $account = $accountprofile = $accountpass = $accdrop = '';

$cid = $_SESSION['tid'];
  //get counselor data
  $sql = "SELECT * FROM counselor where id = '$cid'";
  $get = mysqli_query($con , $sql);
  $data = mysqli_fetch_array($get);

//get total reviews
  $query = "SELECT * FROM ratings where counselor_id = '$cid'";
  $run = mysqli_query($con , $query);
  $totalreviews = mysqli_num_rows($run);

?>

  <div class="st-container">

    <?php include('includes/header.php'); ?>
    <?php include('includes/sidebar.php'); ?>
    <div class="st-pusher" id="content">

      <div class="st-content">

        <div class="st-content-inner padding-none">

          <div class="container-fluid">

            <div class="page-section">
              <h1 class="text-display-1">Dashboard</h1>
            </div>

            <div class="panel panel-default">
              <div class="media v-middle">
                <div class="media-left">
                  <div class="bg-green-400 text-white">
                    <div class="panel-body">
                      <i class="fa fa-credit-card fa-fw fa-2x"></i>
                    </div>
                  </div>
                </div>
                <div class="media-body">
                  <?php include('includes/news.php'); ?>                
                </div>
                
              </div>
            </div>

            <div class="row" data-toggle="isotope">
              <div class="item col-xs-12 col-lg-6">
                <div class="panel panel-default paper-shadow" data-z="0.5">
                  <div class="panel-heading" style="background-color: #42a5f5;">
                    <h4 class="text-headline margin-none">Rating: </h4>
                    <p class="text-subhead text-white">Rating Overview</p>
                  </div>
                    <p class="small margin-none media-right " >
                         <div class="rating-container rating-animate rating-disabled media-right">
                          <div class="clear-rating " title="Rating: <?php echo $data['average_rating']; ?> Stars">
                            <input id="input-1" name="input-1" class="rating rating-input" value="<?php echo $data['average_rating']; ?> " data-min="0" data-max="5" data-step="1" data-readonly="true" data-size="xl" readonly="readonly">
                          </div><br>
                        </div>
                      </p>
                </div>
              </div>  
             
              <div class="item col-xs-12 col-lg-6">
                <div class="s-container">
                  <h4 class="text-headline margin-none">Top Reviews</h4>
                  <p class="text-subhead text-light">Latest top rated reviews about you</p>
                </div>
                <div class="panel panel-default">
                  <ul class="list-group">
                     <?php 
                $get = "SELECT * FROM ratings where counselor_id = '$cid' ORDER BY rating ASC LIMIT 4";
                $gettotal = mysqli_query($con,$get);
                if (mysqli_num_rows($gettotal) > 0 ) {
                  while($result = mysqli_fetch_array($gettotal)){
                ?>
                    <li class="list-group-item">
                      <div class="media v-middle margin-v-0-10">
                        <div class="media-body">
                          <p class="text-subhead">
                            <a href="#">
                              <img src="images/people/blank.png" alt="person" class="width-30 img-circle" />
                            </a> &nbsp;
                            <a href="#">Student</a>
                          </p>
                        </div>
                      </div>
                      <p><?php echo $result['review']; ?> </p>
                      <p class="text-light">

                            <div class="rating-container rating-animate rating-disabled">
                              <div class="clear-rating " title="Rating: (<?php echo $result['rating']; ?> Stars)">
                                <input id="input-1" name="input-1" class="rating" value="<?php echo $result['rating']; ?>" data-min="0" data-max="5" data-step="1" data-readonly="true" data-size="xs" readonly="readonly">
                              </div>
                            </div>
                      </p>
                    </li>
                  <?php }  } ?>
                    
                  </ul>

                </div>
              </div>
              <div class="item col-xs-12 col-lg-6">
                <div class="s-container">
                  <h4 class="text-headline margin-none">Bad Reviews</h4>
                  <p class="text-subhead text-light">Latest bad rated reviews about you</p>
                </div>
                <div class="panel panel-default">
                  <ul class="list-group">
                     <?php 
                $get = "SELECT * FROM ratings where counselor_id = '$cid' ORDER BY rating DESC LIMIT 4";
                $gettotal = mysqli_query($con,$get);
                if (mysqli_num_rows($gettotal) > 0 ) {
                  while($result = mysqli_fetch_array($gettotal)){
                ?>
                    <li class="list-group-item">
                      <div class="media v-middle margin-v-0-10">
                        <div class="media-body">
                          <p class="text-subhead">
                            <a href="#">
                              <img src="images/people/blank.png" alt="person" class="width-30 img-circle" />
                            </a> &nbsp;
                            <a href="#">Student</a>
                          </p>
                        </div>
                      </div>
                      <p><?php echo $result['review']; ?> </p>
                      <p class="text-light">

                            <div class="rating-container rating-animate rating-disabled">
                              <div class="clear-rating " title="Rating: (<?php echo $result['rating']; ?> Stars)">
                                <input id="input-1" name="input-1" class="rating" value="<?php echo $result['rating']; ?>" data-min="0" data-max="5" data-step="1" data-readonly="true" data-size="xs" readonly="readonly">
                              </div>
                            </div>
                      </p>
                    </li>
                  <?php }  } ?>
                    
                  </ul>

                </div>
              </div>
            </div>

          </div>

        </div>
        <!-- /st-content-inner -->

      </div>
      <!-- /st-content -->

    </div>
    <!-- /st-pusher -->

    <?php include('includes/footer.php'); ?>