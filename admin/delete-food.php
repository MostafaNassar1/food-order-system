<?php 
    //Include constraints page
    include('../config/constants.php');

if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //Process the Table
        //1. Get id and image name
        $id=$_GET['id'];
        $image_name = $_GET['image_name'];
        //2. Remove the image if available
        //Check wether the image is available or not and delete only if avaialable
        if($image_name != "")
            {
                //It has image and need to remove from folder
                //Get the image path
                $path = "../images/food/".$image_name;

                //Remove image file from folder
                $remove = unlink($path);

                //Check wether the image is removed or not
                if($remove==false)
                    {
                        //Failed to remove image
                        $_SESSION['upload'] = "<div class='error'>Failed to Remove Image File</div>";
                        //Redirect to manage food
                        header('location:'.SITEURL.'admin/manage-food.php');
                        //Stop the process of deleting food data from database
                        die();
                    }
            }
        //3. Delete food from database
        $sql = "DELETE FROM tbl_food WHERE id=$id";
        //Execute the query
        $res = mysqli_query($conn, $sql);
        

        //Check wether the query executed or not and set the session message respectively
        if($res==true)
            {
                //Food Deleted
             $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
            //Rediret to Manage Category Page
            header('location:'.SITEURL.'admin/manage-food.php');
            }
            else
                {
                    //Failed to delete
                    $_SESSION['delete'] = "<div class='error'>Failed to Delete Food. Try Agian Later.</div>";
                    header('location:'.SITEURL.'admin/food-category.php');
                }

        //4. Redirect to manage food with sesion image
    }
    else
        {
            //Redirect to manage Food page
            $_SESSION['unauthorized'] = "<div class='error'>Unauthorized Access.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }

?>