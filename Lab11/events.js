var searchButton = document.getElementById("search_button");
searchButton.addEventListener("click", send_ajax_request, false);

//TODO: add code to register the "input" event on the search text box so that
//it sends ajax requests whenever a key is pressed
var textBox = document.getElementById("search_text");
textBox.addEventListener("input", send_ajax_request, false);