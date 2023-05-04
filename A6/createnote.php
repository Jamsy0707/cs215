<!DOCTYPE html>
<html lang="en"> 
    <head>
        <meta charset="utf-8"/>
        <title>Create Note</title>
        <link rel="stylesheet" href="mystyle.css">
        <script type="text/javascript" src="validateNote.js"></script>
    </head>
    <body>
    <?php
	    session_start();
		  
	    if(isset($_SESSION["email"]))
	    {
            header("Location: login.php");
            exit();
	    }
    ?>
        <header>
            <h1>James Sieben's Note Application</h1>
            <p class="username">Hello <b><?php $_SESSION['email'] ?></b><input class="logoutbutton" type="button" value="logout" onclick="window.location.href='./login.html'"/></p>
        </header>
        <div class="container" id="container-other">
            <div class="backbutton"><input class="backbutton" type="button" value="back" onclick="history.back()"/></div>
            <div class="item2">
                <h1><br><br><br>Create a new note:</h1>

                <form id="Create" method="POST" action="createnote.php">
                <input type="hidden" name="submitted" value="1"/>

                    <label id="msg_title" class="err_msg"></label>
                    <div class="input">
                        <input id="box" type="text" name="title"/>
                        <div class="title-label" data-dynamic-label-for="title-label">Title</div>
                    </div>

                    <div class="input">
                        <input type="submit" class="button-continue" id="box2" value="Create"/>
                    </div>

                    <div id="display_info"></div>

                </form>

                <script type="text/javascript" src="validateNote-r.js"></script>

            </div>
        </div>
    </body>
    <?php
        $validate = true;
        $error = "";
        $title = "";
        $date = date("Y/m/d");
        $time = date("H:i:s");
        $date_time = $date . " " . $time;


        if (isset($_POST["submitted"]) && $_POST["submitted"]) {
            $title = trim($_POST["title"]);

            $db = new mysqli("localhost", "jls273", "i3SB*qK!GsS4xQ$", "jls273");
            if ($db->connect_error) {
                die ("Connection failed: " . $db->connect_error);
            }

            if($title == NULL || $title == "") {
                $validate = false;
            } 

            if($validate == true) {
                $q2 = "INSERT INTO Notes (note_name, created, last_edit) VALUES ('$title', '$date_time', '$date_time')";

                $r2 = $db->query($q2);
                
                if ($r2 === true) {
                    header("Location: notelist.php");
                    $db->close();
                    exit();
                }

            } else {
                $error = "Note not created";
                $db->close();
            }
        }
    ?>
</html>