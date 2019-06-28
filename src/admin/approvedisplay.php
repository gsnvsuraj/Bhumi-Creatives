<!--
	Title: Bhmui Creatives - Individual Project Page for Moderators
-->
<!DOCTYPE html>
<html>

<head>
    <title>Image</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../lib/css/w3.css">
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <link rel="stylesheet" href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome-font-awesome.min.css">
    <link rel="stylesheet" href="../../lib/css/luxbar.min.css">
</head>
<!-- Call headerAdmin.php for Navigation Bar-->
<?php  include 'headerAdmin.php'; ?>
<body>
 <?php include 'approvedimgtest.php'; ?>
    <div class="content">
        <div class="content_wrapper clearfix">
            <div class="cnt_left">
                <div class="main_img img">
                    <img src=<?php echo $url;?> height="530px">
                </div>
                <div class="prod_thumbs">
                </div>
            </div>
            <div class="cnt_right">
                <h1 class="prod_title">
                    <?php echo ucfirst ($title);?>
                </h1>
                <p class="prod_sub_title">
                    <?php echo ucfirst($doneby);?>
                </p><br>

                <!--<div class="desc_wrapper">
                    <ul class="desc_points">
                        <!<li class="desc_point"></*?php echo $desc ?*/></li>-->
                  <!--  </ul>
                </div>-->
                <p><h4><b>Tags :</b><?php echo $tags; ?></h4></p><br>
                <p><h4><?php echo $desc; ?></h4></p>
                <div class="purchase_wrapper">
                  <center>
										<div class="buy_btn approve_col"><a href="<?php echo "approved.php?pid=".$row['pid']."&stat=A"?>">Approve</div>
										<div class="buy_btn dec_col"><a href="<?php echo "approved.php?pid=".$row['pid']."&stat=D"?>">Decline</div>

                  </center>
                </div>
            </div>
        </div>
    </div>
    <!-- Call footer.php for Footer Bar-->
    <?php include "..//common//footer.php"; ?>

</body>

</html>
