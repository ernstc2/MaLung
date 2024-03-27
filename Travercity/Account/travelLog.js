// Get specific entry and display in full page
function showEntry(entryid) {
  $("#travelLogContent").css("display", "none");
  $("#contents").css("display", "block");
  $("#content" + entryid).css("display", "block");
}

// Go back to all entries from a specific entry
function hideContent(entryid) {
  $("#travelLogContent").css("display", "block");
  $("#contents").css("display", "none");
  $("#content" + entryid).css("display", "none");
}

// Fetch all entries and display them
function getEntries() {
  $.ajax({
    type: "GET",
    url: "getEntries.php",
    datatype: "json",
    success: function(data) {
      let arr = JSON.parse(data);
      console.log(arr);
      
      // Show all entries
      let output = "";
      $(arr).each(function(i, obj) {
        console.log(obj);
        let currOutput = "";
        let func = "showEntry(" + obj.entryid + ")";
        currOutput = "<div id = 'entry" + obj.entryid + "' class = 'mainContentBlock travelLogBlock entry' onclick = '" + func + "'>";
          currOutput += "<h1 id = 'title" + obj.entryid + "'></h1>";
          currOutput += "<span>" + obj.timeCreated + "</span>";
        currOutput += "</div>";
        output = currOutput + output;
      });
      $("#entries").html(output);
      $(arr).each(function(i, obj) {
        document.getElementById("title" + obj.entryid).innerText = obj.title; //using innerText to prevent user from inserting their own HTML
      });
      
      // Show detailed entries
      output = "";
      $(arr).each(function(i, obj) {
        let currOutput = "";
        let func = "hideContent(" + obj.entryid + ")";
        currOutput += "<div id = 'content" + obj.entryid + "' class = 'entryContent'>";
          currOutput += "<img class = 'backButton' src = '../Resources/Images/back_button.png' onclick = '" + func + "'>";
          currOutput += "<div>";
            currOutput += "<h2 id = 'innerTitle" + obj.entryid + "'></h2>";
          currOutput += "</div>";
          currOutput += "<div>";
            currOutput += "<h2>Content:</h2><br>";
            currOutput += "<div id = 'detailedContent" + obj.entryid + "'></div>";
          currOutput += "</div>";
          currOutput += "<div>";
            currOutput += "<h2>Images:</h2><br>";
            $(obj.images).each(function(i, img) {
              currOutput += "<img class = 'entryImage' src = '" + img + "'><br>";
            });
          currOutput += "</div>";
        currOutput += "</div>";
        output = currOutput + output;
      });
      $("#contents").html(output);
      $(arr).each(function(i, obj) {
        document.getElementById("innerTitle" + obj.entryid).innerText = "Title: " + obj.title;
        document.getElementById("detailedContent" + obj.entryid).innerText = obj.content;
      });
    },
    error: function(xhr, status, error) {
      let message = xhr.responseJSON.error;
      document.getElementById("newEntryError").innerHTML = "Error: " + message;
    }
  });
}

$(document).ready(function() {
  getEntries();
});