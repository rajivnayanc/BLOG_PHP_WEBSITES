
 <?php include("includes/header.php") ?>
  
    <!-- Navigation -->
   <?php include("includes/navbar.php") ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            
            <div class="col-md-8">
               
                <h1 class="page-header">
                    Page Headings
                    <small>Secondary Text</small>
                </h1>
                <?php
                    $query = "SELECT * FROM posts";
                    $res = mysqli_query($conn,$query);
                    while($r = mysqli_fetch_assoc($res)){
                    	
                        $post_id = $r['post_id'];
                        $post_title = $r['post_title'];
                        $post_author = $r['post_author'];
                        $post_date = $r['post_date'];
                        $post_content = substr($r['post_content'],0,150);;
                        $post_content = str_replace("\r\n","<br>",$post_content);
                        $post_image = $r['post_image'];
        
                ?>
                


                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                <hr>
                <img class="img-rounded img-responsive" style ="max-height:50vh; margin:0 auto;" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content ?> &nbsp; &nbsp; ...</p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
                
               <?php } ?>


            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include("includes/sidebar.php") ?>
           
        </div>
        <!-- /.row -->

        <hr>

        <?php include("includes/footer.php") ?>