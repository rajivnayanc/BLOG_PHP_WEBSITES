<div class="table-responsive">
   <table class="table table-striped table-bordered table-hover">
       <thead>
           <tr>
               <th>Id</th>
               <th>Author</th>
               <th>Comment</th>
               <th>Email</th>
               <th>Status</th>
               <th>In Response To</th>
               <th>Date</th>
               <th></th>
               <th></th>
               <th></th>
               <th></th>
           </tr>
       </thead>
       <tbody>
          <?php
            global $conn;
            $query = "SELECT * FROM comments";
            $res = mysqli_query($conn,$query);

            while($r = mysqli_fetch_assoc($res)){
                
                $comment_id = $r['comment_id'];
                $comment_post_id = $r['comment_post_id'];
                $comment_author = $r['comment_author'];
                $comment_content = $r['comment_content'];
                $comment_email = $r['comment_email'];
                $comment_status = $r['comment_status'];
                $comment_date = $r['comment_date'];
                
                echo "<tr>";
                echo "<td>{$comment_id}</td>";
                echo "<td>{$comment_author}</td>";
                echo "<td>{$comment_content}</td>";
                echo "<td>{$comment_email}</td>";
                echo "<td>{$comment_status}</td>";
                
            $q = "SELECT * from posts WHERE post_id = {$comment_post_id}";
                $re = mysqli_query($conn,$q);
                while($rr = mysqli_fetch_assoc($re)){
                    $post_id = $rr['post_id'];
                    $in_response_name = $rr['post_title'];
                }
                
                echo "<td><a href='../post.php?p_id={$post_id}'>{$in_response_name}</a></td>";
                echo "<td>{$comment_date}</td>";
                
                echo "<td><a href='comments.php?approve={$comment_id}'>Approve</a></td>";
                echo "<td><a href='comments.php?unapprove={$comment_id}'>Unapprove</a></td>";
                echo "<td><a href='comments.php?delete={$comment_id}'>Delete</a></td>";
                echo "</tr>";     
            }
           ?>
       </tbody>
   </table>
   
   <?php 
        if(isset($_GET['delete'])){
            $the_comment_id = $_GET['delete'];
            $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id}";
            $res = mysqli_query($conn, $query);
            if(!res){
                die("Query Failed: ".mysqli_error($conn));
            }
            
            $query = "UPDATE posts SET post_comment_count = post_comment_count - 1 ";
            $query .= "WHERE post_id = {$comment_post_id} ";
            $res = mysqli_query($conn, $query);
            if(!$res){
                die("Query Failed: ".mysqli_error($conn));
            }
            
            header("Location: comments.php");
        }
    ?>
    
    <?php 
        if(isset($_GET['unapprove'])){
            $the_comment_id = $_GET['unapprove'];
            $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = {$the_comment_id}";
            $res = mysqli_query($conn, $query);
            if(!res){
                die("Query Failed: ".mysqli_error($conn));
            }
            
            header("Location: comments.php");
        }
    ?>
    
    <?php 
        if(isset($_GET['approve'])){
            $the_comment_id = $_GET['approve'];
            $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = {$the_comment_id}";
            $res = mysqli_query($conn, $query);
            if(!res){
                die("Query Failed: ".mysqli_error($conn));
            }
            
            header("Location: comments.php");
        }
    ?>
    
</div>