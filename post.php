
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
                    if(isset($_GET['p_id'])){
                        $post_id = $_GET['p_id'];
                       
                    $query = "SELECT * FROM posts WHERE post_id = {$post_id}";
                    $res = mysqli_query($conn,$query);
                    while($r = mysqli_fetch_assoc($res)){
                        $post_title = $r['post_title'];
                        $post_author = $r['post_author'];
                        $post_date = $r['post_date'];
                        $post_content = $r['post_content'];
                        $post_content = str_replace("\r\n","<br>",$post_content);
                        $post_image = $r['post_image'];
                ?>
                


                <!-- First Blog Post -->
                <h2>
                    <a href="javascript:void(0);"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                <hr>
                <img class="img-rounded img-responsive" style ="max-height:50vh; margin:0 auto;" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>

                <hr>
                
               <?php } }?>
               
                <!-- Blog Comments -->
                    <?php
                        if(isset($_POST['comment_submit'])){
                            $post_id = $_GET['p_id'];
                            $comment_author = $_POST['comment_author'];
                            $comment_author = mysqli_real_escape_string($conn,$comment_author);
                            $comment_email = $_POST['comment_email'];
                            $comment_content = $_POST['comment_content'];
                            $comment_content = mysqli_real_escape_string($conn,$comment_content);
                            
                            $query = "INSERT INTO comments (comment_post_id, comment_status, comment_author, comment_email, comment_content, comment_date) ";
                            
                            $query .= "VALUES($post_id,'unapproved', '{$comment_author}', '{$comment_email}', '{$comment_content}', now()) ";
                            
                            $res = mysqli_query($conn, $query);
                            if(!$res){
                                die("Query Failed: ".mysqli_error($conn));
                            }
                            
                            $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
                            $query .= "WHERE post_id = {$post_id} ";
                            $res = mysqli_query($conn, $query);
                            if(!$res){
                                die("Query Failed: ".mysqli_error($conn));
                            }
                            
                            
                        }
                    ?>
                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <hr>
                    <form method="post" action="" role="form">
                       <div class="form-group">
                          <label for="comment_author">Author</label>
                           <input type="text" name="comment_author" placeholder="Name" class="form-control">
                       </div>
                       
                       <div class="form-group">
                           <label for="comment_email">Email</label>
                           <input type="email" name="comment_email" placeholder="E-Mail" class="form-control">
                       </div>
                        
                        <div class="form-group">
                           <label for="comment_content">Comment</label>
                            <textarea name="comment_content" class="form-control" rows="3"></textarea>
                        </div>
                        
                        <button type="submit" name="comment_submit" class="btn btn-primary">Submit</button>
                    </form>     
                </div>

                <hr>

                <!-- Posted Comments -->
                <?php
                    $query="SELECT * FROM comments WHERE comment_post_id = {$post_id} ";
                    $query.="AND comment_status = 'approved' ";
                    $query.="ORDER BY comment_id DESC";
                    $res = mysqli_query($conn, $query);
                    if(!$res){
                        die("Query Failed : ".mysqli_error($conn));
                    }
                    while($row = mysqli_fetch_array($res)){
                        $comment_date = $row['comment_date'];
                        $comment_content = $row['comment_content'];
                        $comment_author = $row['comment_author'];
                    ?> 
                
               
                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author ?>
                            <small><?php echo $comment_date?></small>
                        </h4>
                        <?php echo $comment_content ?>
                    </div>
                </div>

                 <?php } ?>

            </div>
            <br>
            <br>
            <br>

            <!-- Blog Sidebar Widgets Column -->
            <?php include("includes/sidebar.php") ?>
           
        </div>
        <!-- /.row -->

        <hr>

        <?php include("includes/footer.php") ?>