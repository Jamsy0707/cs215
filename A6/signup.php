<!DOCTYPE html>
<html lang="en"> 
    <head>
        <meta charset="utf-8"/>
        <title>Signup</title>
        <link rel="stylesheet" href="mystyle.css">
        <script type="text/javascript" src="validateSignUp.js"></script>
    </head>
    <body>
        <?php
	        session_start();
		  
	        if(isset($_SESSION["email"]))
	        {
              header("Location: notelist.php");
	        }
        ?>
        <header>
            <h1>James Sieben's Note Application</h1>
        </header>
        <div class="container" id="container-other">

            <div class="item2">
                <h1>Please create an account</h1>

                <form id="SignUp" class="login" method="POST" action="signup.php">
                <input type="hidden" name="submitted" value="1"/>

                    <label id="msg_email" class="err_msg"></label>
                    <div class="input">
                        <input id="box" type="text" name="email"/>
                        <div class="username-label" data-dynamic-label-for="username">Email address</div>
                    </div>

                    <label id="msg_uname" class="err_msg"></label>
                    <div class="input">
                        <input id="box2" type="text" name="uname"/>
                        <div class="username-label" data-dynamic-label-for="username">Username</div>
                    </div>

                    <label id="msg_pswd" class="err_msg"></label>
                    <div class="input">
                        <input id="box3" type="password" name="pswd"/>
                        <div class="password-label" data-dynamic-label-for="username">Password</div>
                    </div>

                    <label id="msg_pswdr" class="err_msg"></label>
                    <div class="input">
                        <input id="box4" type="password" name="pswdr"/>
                        <div class="password-label" data-dynamic-label-for="username">Confirm password</div>
                    </div>

                    <label id="msg_file" class="err_msg"></label>
                    <div class="input2">
                        <p>Upload a profile picture: <input type="file" id="file" name="file" accept=".jpg,.jpeg,.png,.gif"/></p>
                    </div>

                    <div class="input">
                        <input type="submit" class="button-continue" id="box5" value="Continue"/>
                    </div>

                </form>

                <script type="text/javascript" src="validateSignUp-r.js"></script>

                <div id="display_info"></div>

            </div>
        </div>
    </body>
    <?php
        $validate = true;
        $error = "";
        $reg_Email = "/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/";
        $reg_Uname = "/^\w+\S$/";
        $reg_Pswd = "/^(\S*)?\d+(\S*)?$/";
        $email = "";


        if (isset($_POST["submitted"]) && $_POST["submitted"]) {
            $email = trim($_POST["email"]);
            $uname = trim($_POST["uname"]);
            $password = trim($_POST["pswd"]);
            $pic = trim($_POST["file"]); 
            $folder = "pics/".$pic;
            
            $db = new mysqli("localhost", "jls273", "i3SB*qK!GsS4xQ$", "jls273");
            if ($db->connect_error) {
                die ("Connection failed: " . $db->connect_error);
            }
            
            $q1 = "SELECT * FROM Users WHERE user_email = '$email'";
            $r1 = $db->query($q1);

            // if the email address is already taken.
            if($r1->num_rows > 0) {
                $validate = false;

            } else {
                $emailMatch = preg_match($reg_Email, $email);
                if($email == null || $email == "" || $emailMatch == false) {
                    $validate = false;
                }
                
                $unameMatch = preg_match($reg_Uname, $uname);
                if($uname == null || $uname == "" || $unameMatch == false) {
                    $validate = false;
                }

                $pswdLen = strlen($password);
                $pswdMatch = preg_match($reg_Pswd, $password);
                if($password == null || $password == "" || $pswdLen != 6 || $pswdMatch == false) {
                    $validate = false;
                }

                if($pic == null) {
                    $validate = false;
                }
            }

            if($validate == true) {
                $q2 = "INSERT INTO Users (user_email, user_name, user_password, user_image) VALUES ('$email', '$uname', '$password', '$pic')";

                move_uploaded_file($pic, $folder);

                $r2 = $db->query($q2);
                
                if ($r2 === true) {
                    header("Location: login.php");
                    $db->close();
                    exit();
                }

            } else {
                $error = "Signup failed";
                $db->close();
            }
        }
    ?>
</html>