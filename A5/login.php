<!DOCTYPE html>
<html lang="en"> 
    <head>
        <meta charset="utf-8"/>
        <title>Login</title>
        <link rel="stylesheet" href="mystyle.css">
        <script type="text/javascript" src="validateLogin.js"></script>
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
                <h1>Hello!</h1>
                <h1>Please Login</h1>

                <form id="Login" class="login" method="POST" action="login.php">
                <input type="hidden" name="submitted" value="1"/>

                    <label id="msg_email" class="err_msg"></label>
                    <div class="input">
                        <input id="box" type="text" name="email"/>
                        <div class="username-label" data-dynamic-label-for="username">Email address</div>
                    </div>

                    <label id="msg_pswd" class="err_msg"></label>
                    <div class="input">
                        <input id="box2" type="password" name="pswd"/>
                        <div class="password-label" data-dynamic-label-for="username">Password</div>
                    </div>

                    <input type="button" class="forgot" value="Forgot password?"/>

                    <div class="input">
                        <input type="submit" class="button-continue" id="box3" value="Continue"/>
                    </div>

                    <div class="input">
                        <p>Or <input type="button" class="signup" value="sign up" onclick="window.location.href='./signup.html'"/></p>
                    </div>

                    <div id="display_info"></div>

                </form>

                <script type="text/javascript" src="validateLogin-r.js"></script>

            </div>
        </div>
    </body>
    <?php
    $validate = true;
    $reg_Email = "/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/";
    $reg_Pswd = "/^(\S*)?\d+(\S*)?$/";

    $email = "";
    $error = "";

    if (isset($_POST["submitted"]) && $_POST["submitted"]) {
        $email = trim($_POST["email"]);
        $password = trim($_POST["pswd"]);
        
        $db = new mysqli("localhost", "jls273", "i3SB*qK!GsS4xQ$", "jls273");
        if ($db->connect_error) {
            die ("Connection failed: " . $db->connect_error);
        }

        $q = "SELECT * FROM Users WHERE user_email = '$email' AND user_password = '$password'";
        
        $r = $db->query($q);
        $row = $r->fetch_assoc();
        if($email != $row["user_email"] && $password != $row["user_password"]) {
            $validate = false;

        } else {
            $emailMatch = preg_match($reg_Email, $email);
            if($email == null || $email == "" || $emailMatch == false) {
                $validate = false;
            }
            
            $pswdLen = strlen($password);
            $passwordMatch = preg_match($reg_Pswd, $password);
            if($password == null || $password == "" || $pswdLen != 6 || $passwordMatch == false) {
                $validate = false;
            }
        }
        
        if($validate == true) {
            session_start();
            $_SESSION["user_email"] = $row["user_email"];
            header("Location: notelist.php");
            $db->close();
            exit();

        } else {
            $error = "The email/password combination was incorrect. Login failed.";
            $db->close();
        }
    }

    ?>
</html>