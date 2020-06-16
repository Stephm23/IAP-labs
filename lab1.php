<?php 
include_once 'DBConnector.php';
include_once 'user.php';
include_once 'fileUploader.php';

$conn = new DBConnector; 

if (isset($_POST['btn-save'])){
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $city = $_POST['city_name'];
    $username=$_POST['username'];
    $password=$_POST['password'];

    $image = $_FILES['fileToUpload']['name'];
    //$image_name  = $_FILES['fileToUpload']['tmp_name'];
    $tmp_name  = $_FILES['fileToUpload']['tmp_name'];

    $file_original_name = basename($_FILES['fileToUpload']['name']);
    $file_type = strtolower(pathinfo($file_original_name,PATHINFO_EXTENSION));
    $file_size = $_FILES['fileToUpload']['size'];
    $tmp_name = $_FILES["fileToUpload"]["tmp_name"];

    $utc_timestamp = $_POST['utc_timestamp'];
    $offset = $_POST['time_zone_offset'];

    $user = new User($first_name,$last_name,$city,$username,$password,$image,$utc_timestamp,$offset);

    //$uploader = new FileUploader;
    //$uploader = new FileUploader($file_original_name,$file_type,$file_size,$image);
    $uploader = new FileUploader($file_original_name,$file_type,$file_size,$tmp_name,$image);

    if(!$user->valiteForm()){
        $user->createFormErrorSessions();
        header("Refresh:0");
        die();
    }

    $file_upload_response = $uploader->uploadFile($tmp_name,$image);

    if (!$user->isUserExist()){
        $res = $user -> save();

        if ($res){
            echo "Save operation was successful";
        }else{
            echo "An error occurred!";
        }
    }
        else{
            echo "The username already exists";
        }
    
}
?>




<html>
    <head>
        <title>Title goes here</title>
        <script type = "text/javascript" src = "validate.js"></script>
        <link rel="stylesheet" type="text/css" href="validate.css">
    </head>
    <body>
        <form method="post" name="user_details" onsubmit="return validateForm()" action="<?=$_SERVER['PHP_SELF']?>">
            <table align="center">
                <tr>
                <td>
                    <div id="form-errors">
                        <?php
                            session_start();
                            if(!empty($_SESSION['form_errors'])){
                                echo" " . $_SESSION['form_errors'];
                                unset($_SESSION['form_errors']);

                            }
                         ?>

                    </div>
                </td>
                </tr>
                <tr>
                    <td><input type="text" name="first_name" required placeholder="First Name" /></td>
            
                </tr>
                <tr>
                    <td><input type="text" name="last_name" placeholder="Last Name" /></td>
                </tr>
                <tr>
                    <td><input type="text" name="city_name" placeholder="City" /></td>
                </tr>
                <tr>
                    <td><input type="text" name="username" placeholder="Username" /></td>
                </tr>
                <tr>
                    <td><input type="password" name="password" placeholder="Password" /></td>
                </tr>
                <tr>
                    <td>Profile image:<input type="file" name="fileToUpload" id="fileToUpload" /></td>
                </tr>
                <tr>
                    <td><button type="submit" name="btn-save"><strong>SAVE</strong></button></td>

                    <input type="hidden" name="utc_timestamp" id="utc_timestamp" value=""/>
					<input type="hidden" name="time_zone_offset" id="time_zone_offset" value=""/>

					<td><a href = "login.php">LogIn</td>
                </tr>
            </table>

        </form>
    </body>
</html>

<script type="text/javascript" src="validate.js"></script>
		<script type="text/javascript" src="js/materialize.min.js"></script>

		<!--include jquery here. cnd network is used-->
		<script src= "https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<!--your new js file comes after including your jquery-->
		<script type="text/javascript" src="timezone.js"></script>
