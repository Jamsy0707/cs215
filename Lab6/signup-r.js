/*
 * Lab6 signup-r.js 
 *
 * Contains:
 *  - event registrations for signup.html
 *  
 * Event handler functions are defined in validate.js
 * 
 * Read Carefully and watch for //TODO: comments
 */

document.getElementById("SignUp").addEventListener("submit", SignUpForm, false);
//TODO: Add code here to add an event listener for SignUp form reset events. 
//      Use the event handler function we started for you in validate.js
document.getElementById("SignUp").addEventListener("reset", ResetForm, false);
document.getElementById("SignUp").addEventListener("keypressS", load, false);