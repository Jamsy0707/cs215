/*
 * A3 validateLogin.js 
 *
 * Contains:
 *  - LoginForm: submit event handler / form validator 
 */

function LoginForm(event) {

    //Assume the form is valid; set to false if any validation tests fail.
    var valid = true;
    
    var elements = event.currentTarget;
    var email = elements[0].value; //Email
    var pswd  = elements[1].value; //Password
  
    // javascript regular expressions (jre) to validate email, username and password
    var regex_email = /^.*@.*\..*$/;
    var regex_pswd  = /^[a-zA-Z]*[^a-zA-Z]+\S$/;
  
  
    // Empty error message cells have been added to the table above the email, 
    // username, password and confirm password fields styled with red text color   
    var msg_email = document.getElementById("msg_email");
    var msg_pswd  = document.getElementById("msg_pswd");
    msg_email.innerHTML  = "";
    msg_pswd.innerHTML   = "";
  
  
    //Variables for DOM Manipulation commands
    var textNode;
    var htmlNode;
  
  
    // if email is left empty or email format is wrong, add an error message to the matching cell.

    if (email == null || email == "") {
        textNode = document.createTextNode("Email address empty.");
        msg_email.appendChild(textNode);
        valid = false;
      } 
      else if (regex_email.test(email) == false) {
        textNode = document.createTextNode("Email address is in the wrong format. example: username@somewhere.sth");
        msg_email.appendChild(textNode);
        valid = false;
      }
      else if (email.length > 60) {
        textNode = document.createTextNode("Email address is too long. Maximum is 60 characters.");
        msg_email.appendChild(textNode);
        valid = false;
      }
  
  
  
    if (pswd == null || pswd == "") {
      textNode = document.createTextNode("Password is empty.");
      msg_pswd.appendChild(textNode);
      valid = false;
    }
    else if (regex_pswd.test(pswd) == false) {
      textNode = document.createTextNode("Password must contain at least one non-letter.");
      msg_pswd.appendChild(textNode);
      valid = false;
    }
    else if (pswd.length != 6) {
      textNode = document.createTextNode("Password must be 6 characters.");
      msg_pswd.appendChild(textNode);
      valid = false;
    }
  
  
    // Provide feedback in "display_info" div at the bottom of the page
    var display_info = document.getElementById("display_info");
    display_info.innerHTML = "";
    if (valid == false) {
      event.preventDefault(); 
  
      // If the form is not valid, display an "Invalid Data Entered" message and set red text color
  
      display_info.setAttribute("style", "color: red"); 
  
      textNode = document.createTextNode("Invalid Data Entered");
      display_info.appendChild(textNode);
      htmlNode = document.createElement("br");
      display_info.appendChild(htmlNode);
    }
  
}
  