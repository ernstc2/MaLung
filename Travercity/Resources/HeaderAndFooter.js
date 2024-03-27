function showFullNavBar(id) { $(id).slideToggle(100); }
function moveNavBars() {
    amt = $("header").height() + 10;
    $("#Header_NavBar").css("top", amt + "px");
    $("#Header_NavBar_Account").css("top", amt + "px");
}
window.addEventListener("resize", moveNavBars);
$(document).ready(moveNavBars);

function logout() {
    $.ajax({
        url: "/iit/Travercity/Resources/destroySession.php",
        dataType: "json",
        success: function() {
            location.assign("/iit/Travercity/index.php");
        },
        error: function(xhr, status, error) {
            let message = xhr.responseJSON.error;
            alert('Error: ' + message);
            console.log('Error: ' + message);
        }
    });
}