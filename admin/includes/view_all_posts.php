<div class="table-responsive">
   <table class="table table-striped table-bordered table-hover">
       <thead>
           <tr>
               <th>Id</th>
               <th>Author</th>
               <th>Title</th>
               <th>Category</th>
               <th>Status</th>
               <th>Image</th>
               <th>Tags</th>
               <th>Comments</th>
               <th>Date</th>
           </tr>
       </thead>
       <tbody>
          <?php
            global $conn;
            $query = "SELECT * FROM posts";
            $res = mysqli_query($conn,$query);

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
                echo "<tr>";
                echo "<td>{$post_id}</td>";
                echo "<td>{$post_author}</td>";
                echo "<td>{$post_title}</td>";
                
                $q = "SELECT * from categories WHERE cat_id = {$post_category}";
                $re = mysqli_query($conn,$q);
                while($rr = mysqli_fetch_assoc($re)){
                    $post_category_name = $rr['cat_title'];
                }
                
                echo "<td>{$post_category_name}</td>";
                echo "<td>{$post_status}</td>";
                echo "<td><img width ='100' src = \"../images/{$post_image}\"></td>";
                echo "<td>{$post_tag}</td>";
                echo "<td>{$post_comments}</td>";
                echo "<td>{$post_date}</td>";
                echo "<td><a href='../post.php?p_id={$post_id}'>View</a></td>";
                echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                echo "<td><a href='posts.php?delete={$post_id}'>Delete</a></td>";
                echo "</tr>"; 
                
            }
           ?>
       </tbody>
   </table>
   
   <?php 
        if(isset($_GET['delete'])){
            $the_post_id = $_GET['delete'];
            $query = "DELETE FROM posts WHERE post_id = {$the_post_id}";
            $res = mysqli_query($conn, $query);
            if(!res){
                die("Query Failed: ".mysqli_error($conn));
            }
            
            $query = "DELETE FROM comments WHERE comment_post_id = {$the_post_id}";
            
            $res = mysqli_query($conn, $query);
            if(!res){
                die("Query Failed: ".mysqli_error($conn));
            }
            
            
            
            header("Location: posts.php");
        }
    ?>
</div>