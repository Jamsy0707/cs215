<!DOCTYPE html>
<html lang="en"> 
    <head>
        <meta charset="utf-8"/>
        <title>View Note</title>
        <link rel="stylesheet" href="mystyle.css">
        <script type="text/javascript" src="validateViewNote.js"></script>

        <script>
      
            $(() => {
                $("#submitButton").click(function(ev) {
                    var form = $("#edit-note");
                    var url = form.attr('action');
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: form.serialize(),
                        success: function(data) {
                            alert("uccessfully submitted");
                        },
                        error: function(data) {
                            alert("Error");
                        }
                    });
                });
            });
        </script>

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

            //To do: figure out how to pass the currently viewed note's id
            $q = "SELECT role_id,contribute,save_dt FROM Contributions WHERE note_id = 2";
            $result = $db->query($q);
        ?>

        <div class="container">
            <div class="backbutton"><input class="backbutton" type="button" value="back" onclick="history.back()"/><br><br><br></div>
            <div class="profile">
                <p><b>Creator:</b><br>James</p>
                <img src="creatorpic.jpg" alt="Creator Picture" id="picture-creator">
            </div>e

            <div class="note-view">
                <div id="title-note">Note 1<br><hr></div>

                <form id="edit-note" method="POST" action="viewnote.php">
                <input type="hidden" name="submitted" value="1"/>
                    <label id="msg_text" class="err_msg"></label>
                    <p id="charNum"></p>
                    <textarea type="text" id="edit-note-area" name="text" onkeyup="countChars(this);"></textarea>
                    <input type="submit" class ="button-continue" id="button-edit" name="edit" value="save"/>
                    <input type="reset" class ="button-continue" id="button-clear" value="clear"/>
                    <div id="display_info"></div>
                </form>
                <script type="text/javascript" src="validateViewNote-r.js"></script>

                <?php //To do: create a while loop to dynamically display each note 
                    $i = 0;

                ?>
                <div id="picturelist">
                    <br><img src="creatorpic.jpg" alt="Pic 1" class="picture-edit">
                </div>
                <div id="editlist">
                    <p><b>Edit:</b><br><?php $result ?><br><?php echo $result->save_dt ?></p>
                </div>
                <div id="text">
                    <p><?php $result->contribute ?><br><br><br></p>
                </div>
            </div>

            <div class="info">
                <p><b>Created on:</b><br>01/01/2022</p>
                <input class="accessbutton" type="button" value="access" onclick="window.location.href='./access.html'"/>
            </div>
        </div>
    </body>
    <?php
        $validate = true;
        $error = "";
        $edit = "";
        $date = date("Y/m/d");
        $time = date("H:i:s");
        $date_time = $date . " " . $time;


        if (isset($_POST["submitted"]) && $_POST["submitted"]) {
            $edit = trim($_POST["text"]);

            $db = new mysqli("localhost", "jls273", "i3SB*qK!GsS4xQ$", "jls273");
            if ($db->connect_error) {
                die ("Connection failed: " . $db->connect_error);
            }

            if($edit == NULL || $edit == "" || strlen($edit) > 1500) {
                $validate = false;
            }

            if($validate == true) {
                $q2 = "INSERT INTO Contributions (role_id, note_id, contribute, save_dt) VALUES ('1', '2', '$edit', '$date_time')";

                $r2 = $db->query($q2);
                
                if ($r2 === true) {
                    header("Location: viewnote.php");
                    $db->close();
                    exit();
                }

            } else {
                $error = "Edit not saved.";
                $db->close();
            }
        }
    ?>

    <?php
        // Used to check for new contributions
        $db = new mysqli("localhost", "jls273", "i3SB*qK!GsS4xQ$", "jls273");
        $r = mysqli_query($db, "SELECT * FROM Contributions");

        $data = array();
        while ($row = mysqli_fetch_object($r)) {
            array_push($data, $row);
        }

        echo json_encode($data);
        exit();
    ?>
</html>