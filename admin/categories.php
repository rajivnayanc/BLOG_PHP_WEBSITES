<?php include("includes/admin_header.php"); ?>



    <div id="wrapper">

        <!-- Navigation -->
        <?php include("includes/admin_navbar.php"); ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Category Page
                            <small>Author</small>
                        </h1>
                        
                        <div class="col-sm-6">
                           
                          <?php insert_categories(); ?>
                            
                            
                            
                            <form action="" method = "post">
                                <div class="form-group">
                                    <label for="cat_title">Add Category</label>
                                    <input type="text" class="form-control" name="cat_title" >
                                </div>
                                <div class="form-group">
                                    <input type="submit" class = "btn btn-success" name="submit" value="Add Category">
                                </div>
                            </form>
                            
                            <br>
                          
                          
                          
                        <?php if(isset($_GET['edit'])){
                            $cat_id = $_GET['edit'];
                            include("includes/edit_category.php");
                                }?>
                            
                            
                        </div>
                        
                        <div class="col-sm-6">
                           <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category Title</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                <?php showAllCategories(); ?>
                                
                                <?php deleteCategory();  ?>
                                
                                </tbody>
                            </table>
                          </div>
                        </div>
                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<?php include("includes/admin_footer.php") ?>
