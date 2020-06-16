<?php include('includes/t_head.php'); ?>
<?php
  $reviews = 'active';
  $dashboard = $account = $accountprofile = $accountpass = $accdrop = '';


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

    <!-- Fixed navbar -->
   <?php include('includes/header.php'); ?>
   <?php include('includes/sidebar.php');?>

    <div class="st-pusher" id="content">

      <!-- this is the wrapper for the content -->
      <div class="st-content">

        <!-- extra div for emulating position:fixed of the menu -->
        <div class="st-content-inner padding-none">

          <div class="container-fluid">

            <div class="page-section third">
              <!-- Tabbable Widget -->
              <div class="tabbable paper-shadow relative" data-z="0.5">

                
            <div class="panel-body" style="margin-left: 290px;">
              <div style="margin-left: 115px">
                <img src="<?php echo $_SESSION['picture']; ?>" alt="People" class="img-circle width-100" />
              </div><br>
              <div class="media-body">
                  <p class="small margin-none media-right " >
                         <div class="rating-container rating-animate rating-disabled media-right">
                          <div class="clear-rating " title="Rating: <?php echo $data['average_rating']; ?> Stars">
                            <input id="input-1" name="input-1" class="rating rating-input" value="<?php echo $data['average_rating']; ?> " data-min="0" data-max="5" data-step="1" data-readonly="true" data-size="xl" readonly="readonly">
                          </div><br>
                        </div>
                      </p>
                      
                </div><span class="text-center" style="margin-left: 80px">Your average Rating is <span class="label label-default" style="background-color: #42a5f5;"><?php echo $data['average_rating']; ?></span>  </span><br><span style="margin-left: 110px">Out of <span class="label label-default"><?php echo $totalreviews; ?></span> reviews</span>
            </div><br><br><hr>

            <div class="page-section">
              <h1 class="text-display-1"> &nbsp;Reviews:</h1>
            </div>
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
                            <strong>Student <span class="text-muted">@ <?php echo $data['name']; ?>.</span></strong>
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
                </div>

              </div>
              <!-- // END Tabbable Widget -->

            </div>

          </div>

        </div>
        <!-- /st-content-inner -->

      </div>
      <!-- /st-content -->

    </div>
    <!-- /st-pusher -->
<?php include('includes/footer.php'); ?>