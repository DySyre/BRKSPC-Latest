// Wait for the document to load
document.addEventListener("DOMContentLoaded", function() {
    // Get the image element
    var image = document.getElementById("landingImage");

    // Add an event listener for a click event
    image.addEventListener("click", function() {
        // Change the image source
        image.src = "images/1.jpg";
    });
});
