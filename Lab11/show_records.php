<?php
	//TODO: Create a connection to your database using a mysqli object
	// - notice we are using object oriented style
	// - see example 1 here: https://www.php.net/manual/en/mysqli.construct.php
	// - see also lab 11: https://www.cs.uregina.ca/Links/class-info/215/php_mysql/index.html#dbconnection
	$db = new mysqli("localhost", "jls273", "i3SB*qK!GsS4xQ$", "jls273");
	
	if ($db -> connect_error) {
	   die ("Connection failed: " . $db -> connect_error);
	}

	$q = $_GET['q'];
	//TODO: query the User table... 
	// - Use object oriented style: https://www.php.net/manual/en/mysqli.query.php
	// - Be sure to select only fields you need.
	// - filter your results using 'q' value sent in the request
	$result = $db->query("SELECT email,password,birthday FROM USER WHERE email LIKE '$q%');

	//OPTIONAL TODO: if the query did not work, perhaps echo an error message
	// - the sample Javascript is built to handle this by printing it anything that is not JSON encoded
	// - warning: users are not always happy to see error messages...


	//TODO: if the query worked, loop through the results and add each row to an array (do not print or echo them yet)
	// - Use object oriented style!
	// - request rows such that we get an associative array with field names, not index numbers
	//   see mysqli_fetch_assoc for more: https://www.php.net/manual/en/mysqli-result.fetch-assoc.php
	// - appending to PHP arrays: 
	//    - https://www.php.net/manual/en/language.types.array.php#language.types.array.syntax.modifying
	//    - https://www.php.net/manual/en/function.array-push.php
	// - HINT: when reading www.php.net, check the User Contributed Notes too...

    if (mysqli_num_rows($result) > 0) {
        $db_record;
        $row;
        $cell;
        $content;
        $display_table_body = array();

        for ($i = 0; $i < mysqli_num_rows($result); $i++) {
            //create a row and add it to the table
            $row = document.createElement("tr");
            array_push($display_table_body, $row);

            //extract a record from the json results
            $db_record = result[i];

            //add the email field from this record to the table row
            $cell = document.createElement("td");

            $content = document.createTextNode(db_record.email);
            $cell.appendChild(content);
            $row.appendChild(cell);

            $content = document.createTextNode(db_record.password);
            $cell.appendChild(content);
            $row.appendChild(cell);

            $content = document.createTextNode(db_record.birthday);
            $cell.appendChild(content);
            $row.appendChild(cell);
        }
    }

	//TODO: after creating a query results array, encode it as JSON and echo it as the message
	// - encoding as JSON from PHP: https://www.php.net/manual/en/function.json-encode.php
    echo json_encode($display_table_body);

	$db->close();
?>
