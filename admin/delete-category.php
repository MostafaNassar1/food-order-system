<?php 
    //Include contants file
    include('../config/constants.php');
    //Check wether the id and image_name valu is set or not
    if(isset($_GET['id']) && isset($_GET['image_name']))
        {
            //Get the value and delete 
            $id = $_GET['id'];
            $image_name = $_GET['image_name'];

            //Remove the physical image file is available
            if($image_name != "")
                {
                    //Image is available so remove it
                    $path = "../images/category/".$image_name;
                    //Remove the image
                    $remove = unlink($path);
                    //If failed to remove image then add an error and stop the process
                    if($remove == false)
                        {
                            //Save the session message
                            $_SESSION['remove'] = "<div class='error'>Failed to Remove Category Image.</div>";
                            //Redirect to manage category page
                            header('location:'.SITEURL.'admin/manage-category.php');
                            //Stop the process
                            die();
                        }
                }

            //delete data from database
            //SQL query delete data from database
            $sql = "DELETE FROM tbl_category WHERE id=$id";

            //Execute the query 
            $res = mysqli_query($conn, $sql);

            //Check wether the data is deleted from database or not
            if($res==true)
        {
            //Set success message and redirect
            $_SESSION['delete'] = "<div class='success'>Catgeory Deleted Successfully.</div>";
            //Rediret to Manage Category Page
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else{
            //Failed to delete category
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Category. Try Agian Later.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }

            //Redirect to manage category page with message
        }
        else
            {
                //redirect to manage category page
                header('location:'.SITEURL.'admin/manage-category.php');
            }

?>