<?php
            global $conn;
            if(isset($_GET['p_id'])){
                $p_id = $_GET['p_id'];
            

            $query = "SELECT * FROM posts WHERE post_id = {$p_id}";
            $res = mysqli_query($conn,$query);
            if(!$res){
                die("Query Failed: ".mysqli_error($conn));
            }

            while($r = mysqli_fetch_assoc($res)){
                $post_id = $r['post_id'];
                $post_author = $r['post_author'];
                $post_title = $r['post_title'];
                $post_category = $r['post_category'];
                $post_status = $r['post_status'];
                $post_image = $r['post_image'];
                $post_tag = $r['post_tag'];
                $post_comments = $r['post_comment_count'];
                $post_date = $r['post_date'];
                $post_content = $r['post_content'];
            }
          }

    if(isset($_POST['update_post'])){
        $post_author = $_POST['post_author'];
        $post_author = mysqli_real_escape_string($conn,$post_author);
        $post_title = $_POST['title'];
        $post_title = mysqli_real_escape_string($conn,$post_title);
        $post_category = $_POST['post_category_id'];
        $post_status = $_POST['post_status'];
        
        $post_image = $_FILES['post_image']['name'];
        $post_image_tmp = $_FILES['post_image']['tmp_name'];
        
        $post_tag = $_POST['post_tags'];
        $post_comments = 5; 
        $post_content = $_POST['post_content']; 
        $post_content = mysqli_real_escape_string($conn,$post_content);
        
        move_uploaded_file($post_image_tmp,"../images/$post_image");
        
        if(empty($post_image)){
            $query = "SELECT post_image FROM posts WHERE post_id = {$p_id}";
            $res = mysqli_query($conn,$query);
            while($r = mysqli_fetch_assoc($res)){
                $post_image = $r['post_image'];
            }
        }
        
        $query = "UPDATE posts SET ";
        $query.= "post_title = '{$post_title}' , ";
        $query.= "post_category = {$post_category} , ";
        $query.= "post_date = now() , ";
        $query.= "post_author = '{$post_author}' , ";
        $query.= "post_status = '{$post_status}' , ";
        $query.= "post_tag = '{$post_tag}' , ";
        $query.= "post_content = '{$post_content}' , "; 
        $query.= "post_image = '{$post_image}' "; 
        $query.= "WHERE post_id = {$p_id}";
       
        
        
        $res = mysqli_query($conn, $query);
        if(!$res){
            die("<br>Query Failed: ".mysqli_error($conn));
        }
        header("Location: posts.php?source=edit_post&p_id={$p_id}");
    }
?>
  

  <form action="" method="post" enctype="multipart/form-data">
   <div class="form-group">
       <label for="title">Post Title</label>
       <input type="text" class="form-control" value = "<?php echo $post_title?>" name="title">
   </div>
   
    <div class="form-group">
       <label for="post_category_id">Post Category</label>
       <select class = "form-control" name="post_category_id">
         <?php
            global $conn;
            $query = "SELECT * FROM categories";
            $res = mysqli_query($conn,$query);

            while($r = mysqli_fetch_assoc($res)){
                $cat_id = $r['cat_id'];
                $cat_title = $r['cat_title'];
                if($cat_id === $post_category)
                    echo "<option selected ='selected' value='{$cat_id}'>{$cat_title}</option>";
                else
                    echo "<option value='{$cat_id}'>{$cat_title}</option>";
            }
         ?>
       </select>
   </div>
   
    <div class="form-group">
       <label for="post_author">Post Author</label>
       <input type="text" class="form-control"  value = "<?php echo $post_author?>" name="post_author">
   </div>
    <div class="form-group">
       <label for="post_status">Post Status</label>
       <input type="text" class="form-control"  value = "<?php echo $post_status?>" name="post_status">
   </div>
    <div class="form-group">
       <label for="post_image">Post Image</label>
       <br>
       <br>
       <img width = "100" src="../images/<?php echo $post_image ?>" alt="">
       <br>
       <br>
       <input type="file" name="post_image">
   </div>
    <div class="form-group">
       <label for="post_tags">Post Tags</label>
       <input type="text" class="form-control"  value = "<?php echo $post_tag?>" name="post_tags">
   </div>
    <div class="form-group">
       <label for="post_content">Post Content</label>
       <textarea name="post_content" cols="30" rows="10" class="form-control"><?php echo $post_content?></textarea>
   </div>
   
   <div class="form-group">
       <input type="submit" class="btn btn-primary" name="update_post" value="Update Post">
   </div>
    
</form>