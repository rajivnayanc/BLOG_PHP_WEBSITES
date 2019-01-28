 <div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="search.php" class="form-inline" method="post">
                        <div class="input-group">
                            <input name ="search" type="text" class="form-control">
                            <span class="input-group-btn">
                            <button name = "submit" class="btn btn-default" type="submit">
                            <span class="glyphicon glyphicon-search"></span>
                            </button>
                            </span>
                    </div>
                    </form>
                    <!-- /.input-group -->
                </div>
                
                

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <?php 
                                global $conn;
                                $query = "SELECT * FROM categories";
                                $res = mysqli_query($conn,$query);
                                while($r = mysqli_fetch_assoc($res)){
                                    echo "<li><a href = \"category.php?category={$r['cat_id']} \">{$r['cat_title']}</a></li>";
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
               <?php include("widget_sidebar.php") ?>

            </div>
