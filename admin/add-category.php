<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>

        <?php 
        
            if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }

                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }

        ?>
        <br><br>
        <!-- Add Category Form Starts -->
        <form action="" method="POST" enctype="multipart/form-data"><!-- This allow us to upload file -->

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" plaeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>
                    <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
        <!-- Add Category Form Ends -->

        <?php 
        
        //Check wether the submit button is clicked or not
        if(isset($_POST['submit']))
            {
                //1. Get the value from Category Form
                $title = $_POST['title'];

                //For radio input type, we need to check wether the button is selected or not
                if(isset($_POST['featured']))
                    {
                        //Get the value from form
                        $featured = $_POST['featured'];
                    }
                    else
                        {
                            //Set the default value
                            $featured = "No";
                        }

                    if(isset($_POST['active']))
                        {
                            $active = $_POST['active'];
                        }
                        else
                            {
                                $active = "No";
                            }

                            //Check wether the image is selected or not and set the value for image name accordingly
                            //print_r($_FILES['image']);
                            //die();//Break the code
                            
                            if(isset($_FILES['image']['name']))//if the image has a name value
                                {
                                    //Upload image
                                    //To upload image we need image name, source path and destination path
                                    $image_name = $_FILES['image']['name'];

                                    //Upload the image only if image is selected
                                    if($image_name!="")
                                        {

                                        

                                    /*//Auto Rename our image
                                    //Get the extension of our image(jpp, png, gif, etc) e.g. "food1.jpg"(initial image name)
                                    $ext = end(explode('.', $image_name));//Breaking the image and getting the extension only and getting the a new name

                                    //Rename the image
                                    $image_name = "Food_Category_".rand(000, 999).'.'.$ext;//e.g. new name: Food_Category_834.jpg this name will be saved in database
                                        */
                                    $source_path = $_FILES['image']['tmp_name'];

                                    $destination_path = "../images/category/".$image_name;//concatenate

                                    //Finally upload the image
                                    $upload = move_uploaded_file($source_path, $destination_path);

                                    //Check wether the image is uploaded or not
                                    //And if the image is not uploaded then we will stop the process and redirect with error message
                                    if($upload==false)
                                        {
                                            //Set message 
                                            $_SESSION['upload']="<div class='error'>Failed to Upload Image.</div>";
                                            //Redirect to category page
                                            header('location:'.SITEURL.'admin/add-category.php');
                                            //Stop the process
                                            die();
                                        }
                                        }
                                }
                                else
                                    {
                                        //Dont Upload Image and set the image_name value as blank
                                        $image_name="";
                                    }

                            //2. Create SQL query into database
                            $sql = "INSERT INTO tbl_category SET
                            title='$title',
                            image_name='$image_name',
                            featured='$featured',
                            active='$active'
                            ";

                            //3. Execute the query and save in database
                            $res = mysqli_query($conn, $sql);

                            //4. Check wether the queryexecuted or not and data added or not
                            if($res==true)
                                {
                                    //Query Executed and categery Added
                                    $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
                                    //Redirect to manage Category Page
                                    header('location:'.SITEURL.'admin/manage-category.php');
                                    
                                }
                                else
                                    {
                                        //Failed to add Category
                                        $_SESSION['add'] = "<div class='error'>Failed to Add Category.</div>";
                                        //Redirect to manage Category Page
                                        header('location:'.SITEURL.'admin/add-category.php');

                                    }
            }

        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>