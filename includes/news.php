<div class="onoffswitch3">
    <input type="checkbox" name="onoffswitch3" class="onoffswitch3-checkbox" id="myonoffswitch3" checked>
    <label class="onoffswitch3-label" for="myonoffswitch3">
        <span class="onoffswitch3-inner">
            <span class="onoffswitch3-active">
                <marquee class="scroll-text">

                    <?php 
                        $sqli = "SELECT * FROM news ORDER BY date ASC";
                        $getnews = mysqli_query($con,$sqli);
                        while($news = mysqli_fetch_array($getnews)){               
                    ?>
                    <span style="font-size: 18px"><?php echo $news['subject']; ?></span> : <?php echo $news['body']; ?> | (<?php echo $news['date']; ?>)&nbsp;  <span class="glyphicon glyphicon-forward"></span>&nbsp;
                    <?php
                        }
                    ?>


                </marquee>
                <span class="onoffswitch3-switch" style="background-color: #42a5f5;"> NEWS </span>
            </span>
            <span class="onoffswitch3-inactive"><span class="onoffswitch3-switch">SHOW BREAKING NEWS</span></span>
        </span>
    </label>
</div>