<?php 
    //Authorization - Access Control
    //Check wether the user is logged in or not
    if(!isset($_SESSION['user'])) //If user session is not set
        {
            //user is not logged in
            //Redirect to login page with message
            $_SESSION['no-login-message'] = "<div class='error text-center'>Please Log In to access Admin Panel</div>";
            //Redirect to Login Page
            header('location:'.SITEURL.'admin/login.php');
        }
?>