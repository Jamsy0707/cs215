<!DOCTYPE html>
<html lang="en"> 
    <head>
        <meta charset="utf-8"/>
        <title>Note List</title>
        <link rel="stylesheet" href="mystyle.css">
    </head>
    <body>
    <?php
	    session_start();
		  
	    if(!isset($_SESSION["user_email"]))
	    {
            header("Location: login.php");
            exit();
	    }
    ?>
        <header>
            <h1>James Sieben's Note Application</h1>
            <p class="username">Hello <b><?php echo $_SESSION['user_email'] ?></b><input class="logoutbutton" type="button" value="logout" onclick="window.location.href='./login.php'"/></p>
        </header>

        <?php
            $db = new mysqli("localhost", "jls273", "i3SB*qK!GsS4xQ$", "jls273");
            if ($db->connect_error) {
                die ("Connection failed: " . $db->connect_error);
            }

            $user = $_SESSION['user_email'];
            //The following code finds a list of notes the user has access to
            $user_id = "SELECT user_id FROM Users WHERE user_email = '$user'";
            $q = "SELECT note_id FROM Roles WHERE user_id = '$user_id'";

            //if ($result = $db->query($q)) {  //If at least one note corresponding to the user exists
                    //Query the current note info
                  //  $q = "SELECT note_name,created,last_edit FROM Notes WHERE note_id = $row";
                  //  $r = $db->query($q);
            //}


            // Used to check for new contributions
            $r = mysqli_query($db, "SELECT * FROM Notes");

            $data = array();
            while ($row = mysqli_fetch_object($r)) {
                array_push($data, $row);
            }

            echo json_encode($data);
            exit();
        ?>

        <?php //To do: Dynamically create each note in a loop using new php data ?>
                    <div class="container">
                        <div class="yournotes">
                            <h2>Your notes:</h2>

                            <div class="note">
                                <div class="view"><input class="viewbutton" type="button" value="view" onclick="window.location.href='./viewnote.html'"/></div>
                                <div id="created">Created on: <?php echo $r->created ?></div>
                                <div id="title"><?php echo $r->note_name ?></div>
                                <div id="edit">Last edit: <?php echo $r->last_edit ?><br>Total edits: <?php //Sum of all rows ?></div>
                                <div class="access"><input class="accessbutton" type="button" value="access" onclick="window.location.href='./access.html'"/></div>
                            </div>
                        </div>
                        <input class="create" type="button" value="+" onclick="window.location.href='./createnote.php'"/>

                        <div class="sharednotes">
                            <h2>Shared notes:</h2>

                            <div class="note">
                                <div class="view"><input class="viewbutton" type="button" value="view" onclick="window.location.href='./viewnote.html'"/></div>
                                <div id="created">Created on: 01/01/2022</div>
                                <div id="title">Note 1</div>
                                <div id="edit">Last edit: 01/01/2022<br>Total edits: 1</div>
                            </div>
                        </div>
                    </div>


    </body>
</html>