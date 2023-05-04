function validateForm(){
    var w=document.forms.myForm.email.value;
    var x=document.forms.myForm.uname.value;
    var y=document.forms.myForm.pswd.value;
    var z=document.forms.myForm.pswdr.value;
    var alrt = "";

    if (w==null || w==""){
       alrt += "Email must be filled out.\n";
    }
    if (x==null || x==""){
        alrt += "Username must be filled out.\n";
    }
    if (y==null || y==""){
        alrt += "Password must be filled out.\n";
    }
    if (z==null || z==""){
        alrt += "Password verification must be filled out.\n";
    }
    if (y.length != 8){
        alrt += "Password must be 8 characters long.\n";
    }
    if (y != z){
        alrt += "Passwords do not match.\n";
    }

    if (!(w==null || w=="") && !(w==null || w=="") && !(w==null || w=="") && !(y.length != 8) && !(y != z)) {
        alert("Email: " + w + "\nUsername: " + x + "\nPassword: " + y);
        return true;
    }
    else {
        alert(alrt);
        return false;
    }
 }