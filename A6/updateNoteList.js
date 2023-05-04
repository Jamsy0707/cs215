// Script to periodically update the note list

// Run the function every 90 seconds
setInterval(updateNoteList, 90000);

console.log ("AJAX code loaded");

function updateNoteList(e) {
    console.log("Start update note list");

    var xhr = new XMLHttpRequest();         // Create the async request object

    xhr.onreadystatechange = function () {  // Set up async request object callback
        if (xhr.readyState == 4 && xhr.status == 200) {

            var noteList = JSON.parse(xhr.responseText);

            // Iterate over JSON object
            for (var i = 0; i < noteList.length; i++) { 
                // Update the time the notes were created
                var noteListTag = document.getElementById("created" + noteList[i].note_id);
                if (noteListTag) {
                    noteListTag.innerHTML = noteList[i].created;
                }
                // Update the names
                var noteListTag = document.getElementById("title" + noteList[i].note_id);
                if (noteListTag) {
                    noteListTag.innerHTML = noteList[i].note_name;
                }
                // Update the last edit time
                var noteListTag = document.getElementById("edit" + noteList[i].note_id);
                if (noteListTag) {
                    noteListTag.innerHTML = noteList[i].last_edit;
                }
            }

            xhr.open("GET", "noteList.php", true);
            xhr.send(null);

            console.log ("End of update");  
        }
    }

}