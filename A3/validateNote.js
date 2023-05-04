/*
 * A3 validateNote.js 
 *
 * Contains:
 *  - NoteForm: submit event handler / form validator 
 */

function NoteForm(event) {

    //Assume the form is valid; set to false if any validation tests fail.
    var valid = true;
    
    var elements = event.currentTarget;
    var title = elements[0].value; //Title
  
    // javascript regular expressions (jre) to validate title
    var regex_title = /^.*$/;
  
  
    // Empty error message cells have been added to the table above the title, 
    // username, password and confirm password fields styled with red text color   
    var msg_title = document.getElementById("msg_title");
    msg_title.innerHTML  = "";
  
  
    //Variables for DOM Manipulation commands
    var textNode;
    var htmlNode;
  
  
    // if title is left empty or title format is wrong, add an error message to the matching cell.

    if (title == null || title == "") {
        textNode = document.createTextNode("You need to have a title.");
        msg_title.appendChild(textNode);
        valid = false;
      } 
      else if (regex_title.test(title) == false) {
        textNode = document.createTextNode("The title is not valid.");
        msg_title.appendChild(textNode);
        valid = false;
      }
      else if (title.length > 256) {
        textNode = document.createTextNode("Max title length is 256 characters.");
        msg_title.appendChild(textNode);
        valid = false;
      }
  
  
    // Provide feedback in "display_info" div at the bottom of the page
    var display_info = document.getElementById("display_info");
    display_info.innerHTML = "";
    if (valid == false) {
      event.preventDefault(); // Normally, this is where this command should be
  
      // If the form is not valid, display an "Invalid Data Entered" message and set red text color
  
      display_info.setAttribute("style", "color: red"); 
  
      textNode = document.createTextNode("Invalid Data Entered");
      display_info.appendChild(textNode);
      htmlNode = document.createElement("br");
      display_info.appendChild(htmlNode);
    }
  
}
  