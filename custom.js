// custom.js

// Redirect all AJAX requests to nex.php and log the request
$(document).ajaxSend(function(event, jqXHR, settings) {
    console.log("Redirecting AJAX request to nex.php. Original URL was:", settings.url);
    settings.url = "nex.php";
});

// Example AJAX call (will go to nex.php)
function sendExampleAjax() {
    $.ajax({
        data: { foo: "bar" },
        success: function(resp) {
            alert("AJAX response: " + resp);
        },
        error: function(xhr, status, error) {
            alert("AJAX error: " + error);
        }
    });
}

// Optionally, call the example function on page load
$(function() {
    sendExampleAjax();
});