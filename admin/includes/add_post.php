<?php
    if(isset($_POST['create_post'])){
        $post_title = $_POST['title'];
        $post_category_id = $_POST['post_category_id'];
        $post_author = $_POST['post_author'];
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        $post_date = date('d-m-y');
//        $post_comment_count = 5;
        $post_image = $_FILES['post_image']['name'];
        $post_image_tmp = $_FILES['post_image']['tmp_name'];
        $post_status = $_POST['post_status'];
        move_uploaded_file($post_image_tmp,"../images/$post_image");
        $post_content = mysqli_real_escape_string($conn,$post_content);
        $query = "INSERT INTO posts(post_category,post_title,post_author,post_date,post_image,post_content,post_tag,post_status) ";
        $query.="VALUES({$post_category_id},'{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}')"; 
        
        $res = mysqli_query($conn,$query);
        if(!$res){
            die("Query Failed: ".mysqli_error($conn));
        }
     
    }

?>
  

  
<form action="" method="post" enctype="multipart/form-data">
   <div class="form-group">
       <label for="title">Post Title</label>
       <input type="text" class="form-control" name="title">
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
                echo "<option value='{$cat_id}'>{$cat_title}</option>";
            }
         ?>
       </select>
   </div>
    <div class="form-group">
       <label for="post_author">Post Author</label>
       <input type="text" class="form-control" name="post_author">
   </div>
    <div class="form-group">
       <label for="post_status">Post Status</label>
       <input type="text" class="form-control" name="post_status">
   </div>
    <div class="form-group">
       <label for="post_image">Post Image</label>
       <input type="file" name="post_image">
   </div>
    <div class="form-group">
       <label for="post_tags">Post Tags</label>
       <input type="text" class="form-control" name="post_tags">
   </div>
    <div class="form-group">
       <label for="post_content">Post Content</label>
       <textarea name="post_content" cols="30" rows="10" class="form-control"></textarea>
   </div>
   
   <div class="form-group">
       <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
   </div>
    
</form>