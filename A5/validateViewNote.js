function ViewNoteForm(event) {

    //Assume the form is valid; set to false if any validation tests fail.
    var valid = true;
    
    var elements = event.currentTarget;
    var text = elements[1].value; //Text
  
    // javascript regular expressions (jre) to validate email, username and password
    var regex_text = /./;
  
  
    // Empty error message cells have been added to the table above the email, 
    // username, password and confirm password fields styled with red text color   
    var msg_text = document.getElementById("msg_text");
    msg_text.innerHTML  = "";
  
  
    //Variables for DOM Manipulation commands
    var textNode;
    var htmlNode;
  
  
    // if email is left empty or email format is wrong, add an error message to the matching cell.

    if (text == null || text == "") {
        textNode = document.createTextNode("You need text before you can save.");
        msg_text.appendChild(textNode);
        valid = false;
      } 
      else if (regex_text.test(text) == false) {
        textNode = document.createTextNode("Text is in the wrong form.");
        msg_text.appendChild(textNode);
        valid = false;
      }
      else if (text.length > 1500) {
        textNode = document.createTextNode("Text is too long. Maximum is 1500 characters.");
        msg_text.appendChild(textNode);
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

  function countChars(event){
    var maxLength = 1500;
    var strLength = event.value.length;
    
    if(strLength > maxLength)
        document.getElementById("charNum").innerHTML = '<span style="color: red;">'+(strLength - maxLength)+' characters over limit</span>';
    else
        document.getElementById("charNum").innerHTML = '<span style="color: green;">'+(maxLength - strLength)+' characters left</span>';
}

function ResetForm(event) {
    document.getElementById("edit-note").reset();
    display_info.innerHTML = "";
    msg_text.innerHTML = "";
}
  