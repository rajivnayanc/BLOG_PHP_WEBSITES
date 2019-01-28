<form action="" method = "post">
    <div class="form-group">
        <label for="cat_title">Update Category</label>

        <?php 
            if(isset($_GET['edit'])){
                $cat_id = $_GET['edit'];
                global $conn;
                $query = "SELECT * FROM categories WHERE cat_id = {$cat_id}";
                $res = mysqli_query($conn,$query);
                if(!$res){

                }

                while($r = mysqli_fetch_assoc($res)){
                    $cat_id = $r['cat_id'];
                    $cat_title = $r['cat_title'];

                    ?>
                   <input type="text" value=" <?php if(isset($cat_title)){echo $cat_title;} ?>" name="cat_title" class="form-control"> 


        <?php }} ?>

        <?php 
          if(isset($_POST['update_category'])){

                $cat_title = $_POST['cat_title'];
                $query = "UPDATE categories SET cat_title='{$cat_title}' where cat_id = {$cat_id}";;
                $res = mysqli_query($conn,$query);
                if(!$res){
                    die ("Query Failed!".mysqli_error($conn));
                }
                else{
                    header("Location: categories.php");
                }
            }
            
        ?>

    </div>

    <div class="form-group">
        <input type="submit" name="update_category" value="Edit Category" class="btn btn-primary">
    </div>
</form>