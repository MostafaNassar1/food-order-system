<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>

        <?php 
            if(isset($_SESSION['add']))//Checking wether the Session is set or not
                {
                    echo $_SESSION['add'];//Display Session Message
                    unset($_SESSION['add']);//Remove Session Message
                }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name</td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter Your Name">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" placeholder="Your Username">
                    </td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="password" placeholder="Your Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="Submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>


<?php
    //Process the Value from Form and Save it in the database
    //Check wether the submit button is clicked or not

    if(isset($_POST['submit']))//If the value submit is passed through the POST method
        {
            //Button Clicked
            //echo "Button Clicked";

            //1. Get the Data from Form
            $full_name = $_POST['full_name'];
            $username = $_POST['username'];
            $password = md5($_POST['password']); //Password Encryption with MD5

            //2. SQL query to save the data into the database
            $sql = "INSERT INTO tbl_admin SET
                full_name='$full_name',
                username ='$username',
                password ='$password'
                ";

            //3. Execute Query and Save Data in Database
            $res = mysqli_query($conn, $sql) or die(mysqli_error());//if the query is executed successfully if not another process will be accessed

            //4. Check wether the (Query is Executed) data is inserted or not and display appropriate message
            if($res==TRUE){
                //Data Inserted
                //echo "Data Inserted";
                //Create Session Variable to display message
                $_SESSION['add'] = "Admin Added Successfuly";
                //Redirect Page to Manage Admin
                header("location:".SITEURL.'admin/manage-admin.php');
            }
            else{
                //Failed to insert data
                //Create Session Variable to display message
                $_SESSION['add'] = "Failed to Add Admin";
                //Redirect Page to Add Admin
                header("location:".SITEURL.'admin/add-admin.php');
            }
        }

?>