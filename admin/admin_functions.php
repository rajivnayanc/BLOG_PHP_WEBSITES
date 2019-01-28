 <?php 
    function insert_categories(){
        global $conn;
        if(isset($_POST['submit'])){
            $cat_title = $_POST['cat_title'];
            if($cat_title == "" || empty($cat_title)){
                echo "<span style = \"color:red;\">Field should not be empty</span>";
            }
            else{
                $query = "INSERT INTO categories(cat_title)";
                $query.= "VALUE('{$cat_title}')";
                $res =  mysqli_query($conn,$query);
                if(!$res){
                    die("Query Failed!");
                }
            }
       }
    }


    function showAllCategories(){
         
        global $conn;
        $query = "SELECT * FROM categories";
        $res = mysqli_query($conn,$query);

        while($r = mysqli_fetch_assoc($res)){
            $cat_id = $r['cat_id'];
            $cat_title = $r['cat_title'];
            echo "<tr>";
            echo "<td>{$cat_id}</td>";
            echo "<td>{$cat_title}</td>";
            echo "<td><a href = \"categories.php?delete={$cat_id}\">Delete</td>";
            echo "<td><a href = \"categories.php?edit={$cat_id}\">Edit</td>";
            echo "</tr>";                                       
        }
                                
    }
    
    function deleteCategory(){
        global $conn;
        if(isset($_GET['delete'])){
            $cat_id_rec = $_GET['delete'];
            $query = "DELETE FROM categories WHERE cat_id={$cat_id_rec}";
            $res = mysqli_query($conn,$query);
            if(!$res){
                echo "Query Failed!";
            }
            
            header("Location: categories.php");
        } 
    }
?>