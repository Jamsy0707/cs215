<!DOCTYPE html>
<html lang="en"> 
    <head>
        <meta charset="utf-8"/>
        <title>Grant/Revoke Access</title>
        <link rel="stylesheet" href="mystyle.css">
    </head>
    <body>
    <?php
	    session_start();
		  
        // Change this to ! after notelist has been fixed
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

        <?php
            $db = new mysqli("localhost", "jls273", "i3SB*qK!GsS4xQ$", "jls273");
            if ($db->connect_error) {
                die ("Connection failed: " . $db->connect_error);
            }

            //To do: for a note_id, find user_id where role_type = editor
            //       use user_id list to find corresponding names

            //To do: Change "3" to note_id of currently viewed note
            $q = "SELECT user_id FROM Roles WHERE note_id = 3 AND role_type = 'editor'";
            $id_result = $db->query($q);

            //Pseudo code for grant/revoke logic:

            //When grant button is clicked:
            //$q = "UPDATE Roles SET role_type = 'editor' WHERE user_id = 'id of user clicked on'";
            //$db->query($q);

            //When revoke button is clicked:
            //$q = "UPDATE Roles SET role_type = 'none' WHERE user_id = 'id of user clicked on'";
            //$db->query($q);
        ?>

        <div class="container">
            <div class="backbutton"><input class="backbutton" type="button" value="back" onclick="history.back()"/></div>
            <h2 class="mainheader">Note 1</h2>
            <div class="withaccess">
                <h2>Users with access:</h2>

                <?php
                    // To do: dynamically create each user div class in loop
                    while ($id_result) {
                        $name = "SELECT user_name FROM Users WHERE user_id = $id_result";
                        $name_result = $db->query($name);
                    }
                ?>
                <div class="user">
                    <img src="creatorpic.jpg" alt="Creator Picture" class="picture">
                    <div class="name">User 1</div>
                    <div class="access-gr"><input class="button" type="button" value="revoke"/></div>
                </div>

                <div class="user">
                    <img src="creatorpic.jpg" alt="Creator Picture" class="picture">
                    <div class="name">User 2</div>
                    <div class="access-gr"><input class="button" type="button" value="revoke"/></div>
                </div>

                <div class="user">
                    <img src="creatorpic.jpg" alt="Creator Picture" class="picture">
                    <div class="name">User 3</div>
                    <div class="access-gr"><input class="button" type="button" value="revoke"/></div>
                </div>

                <div class="user">
                    <img src="creatorpic.jpg" alt="Creator Picture" class="picture">
                    <div class="name">User 4</div>
                    <div class="access-gr"><input class="button" type="button" value="revoke"/></div>
                </div>
            </div>

            <div class="withoutaccess">
                <h2>Users without access:</h2>

                <div class="user">
                    <img src="creatorpic.jpg" alt="Creator Picture" class="picture">
                    <div class="name">User 5</div>
                    <div class="access-gr"><input class="button" id="button2" type="button" value="grant"/></div>
                </div>

                <div class="user">
                    <img src="creatorpic.jpg" alt="Creator Picture" class="picture">
                    <div class="name">User 6</div>
                    <div class="access-gr"><input class="button" id="button3" type="button" value="grant"/></div>
                </div>

                <div><input class="searchbutton" type="button" value="Search"/></div>
            </div>
        </div>
    </body>
</html>