//Setting sizes of elements (not doing in CSS b/c need math to set these sizes)
function setSizes() {
  //Setting height of main tag
  let mainHeight = $(document).height() - $("header").height() - $("footer").height();
  $("main").css("min-height", mainHeight + "px"); //min-height cuz if user has a lot of posts, the height should be larger than this

  //Setting width of mainContent (account info, sensitive info, posts)
  let contentWidth = $("main").width() - $("#sidebar").width();
  $(".mainContent").css("width", contentWidth + "px");
}

//What to do when clicking edit button
function clickEdit(imgId, formId) {
  let edit = "../Resources/Images/edit_button.png";
  let x = "../Resources/Images/x_button.png";
  let src = $(imgId).attr("src");

  if (src == edit) {
    $(imgId).attr("src", x);
    $(formId).css("display", "block");
  } else {
    $(imgId).attr("src", edit);
    $(formId).css("display", "none");
  }
}

// action tells function which form called the function and will do something specific to each action
// Updates page if entered password is correct, tells user password is incorrect otherwise
function checkPassword(action) {
  let pw = (function () {
    switch (action) {
      case "change1":
        return document.getElementById("changePw1").value;
      case "change2":
        return document.getElementById("changePw2").value;
      case "delete1":
        return document.getElementById("deletePw1").value;
    }
  })();

  $.ajax({
    type: "GET",
    url: "passwordCheck.php",
    dataType: "json",
    data: {password: pw},
    success: function(data) {
      if (data.returnVal) {
        document.getElementById("changeError1").innerHTML = "";
        document.getElementById("changeError2").innerHTML = "";
        document.getElementById("deleteError1").innerHTML = "";
        if (action == "change1") {
          $("#changeForm1").css("display", "none");
          $("#changeForm2").css("display", "block");
        } else if (action =="change2") {
          $("#changeForm2").css("display", "none");
          $("#changeForm3").css("display", "block");
        } else {
          $("#deleteForm1").css("display", "none");
          $("#deleteForm2").css("display", "block");
        }
      } else {
        if (action == "change1") {
          document.getElementById("changeError1").innerHTML = "Incorrect password";
        } else if (action == "change2") {
          document.getElementById("changeError2").innerHTML = "Incorrect password";
        } else {
          document.getElementById("deleteError1").innerHTML = "Incorrect password";
        }
      }
    },
    error: function(xhr, status, error) {
      let message = xhr.responseJSON.error;
      if (action == "change1") {
        document.getElementById("changeError1").innerHTML = 'Error: ' + message;
      } else if (action == "change2") {
        document.getElementById("changeError2").innerHTML = 'Error: ' + message;
      } else {
        document.getElementById("deleteError1").innerHTML = 'Error: ' + message;
      }
    }
  });
}

// Check if re-entered password is entered correctly
// Changes password and updates page if password was valid, doesn't update anything otherwise and tells user password is invalid
function changePassword() {
  let pw = document.getElementById("changePw3").value;
  $.ajax({
    type: "PATCH",
    url: "passwordCheck.php",
    dataType: "json",
    data: {newPassword: pw},
    success: function(data) {
      if (data.returnVal) {
        document.getElementById("changeError3").innerHTML = "";
        alert("Password successfully changed");
        $("#changeForm3").css("display", "none");
        $("#sensitiveInfoContent").css("display", "block");
      } else {
        document.getElementById("changeError3").innerHTML = "Invalid password";
      }
    },
    error: function(xhr, status, error) {
      let message = xhr.responseJSON.error;
      document.getElementById("changeError3").innerHTML = 'Error: ' + message;
    }
  });
}

// Validate that the new password meets password requirements
// Returns a promise that resolves to true if password was deleted, false otherwise (returning a promise because AJAX is async)
function deletePassword() {
  let pw = document.getElementById("deletePw2").value;
  return new Promise((resolve, reject) => {
    $.ajax({
      type: "DELETE",
      url: "passwordCheck.php",
      dataType: "json",
      data: {password: pw},
      success: function(data) {
        if (data.returnVal) {
          alert("Account successfully deleted"); //let user move to new page
          resolve(true);
        } else {
          alert("Incorrect password"); //need to keep user on same page
          resolve(false);
        }
      },
      error: function(xhr, status, error) {
        let message = xhr.responseJSON.error;
        reject('Error: ' + message);
      }
    })
  })
}

// Attempt to delete account
// If entered password is correct, account will be deleted and user will be sent to accountDeleted.php
// Else, user will be told password is incorrect and stay on the correct page
function attemptDelete(form) {
  deletePassword().then((returnVal) => {
    if (returnVal) { // password is correct
      form.submit();
    } else {
      document.getElementById("deleteError2").innerHTML = "Incorrect password";
    }
  }).catch((error) => {
    document.getElementById("deleteError2").innerHTML = error;
  })
}

// Made image validator using ChatGPT
function areAllFilesValidImages(inputElement, callback) {
  const files = inputElement.files;
  let valid = true;
  let count = 0;

  function checkImageValidity(file) {
    const reader = new FileReader();

    reader.onload = function (e) {
      const image = new Image();
      image.src = e.target.result;

      image.onload = function () {
        count++;

        // Check if all files are processed
        if (count === files.length) {
          callback(valid);
        }
      };

      image.onerror = function () {
        count++;
        valid = false;

        // Check if all files are processed
        if (count === files.length) {
          callback(valid);
        }
      };
    };

    reader.readAsDataURL(file);
  }

  for (let i = 0; i < files.length; i++) {
    checkImageValidity(files[i]);
  }
}

function makeNewEntry(form) {
  let imagesInput = document.getElementById('entryImages');

  if (imagesInput.files.length == 0) {
    uploadEntry(form);
  }
  
  areAllFilesValidImages(imagesInput, function (isValid) {
    if (isValid) {
      uploadEntry(form);
    } else {
      document.getElementById("newEntryError").innerHTML = "Invalid file(s). Please ensure all files are valid images.";
    }
  });
}

function uploadEntry(form) {
  let entryTitle = document.getElementById("entryTitle").value;
  let entryContent = document.getElementById("entryContent").value;
  let entryImages = document.getElementById("entryImages").files;

  let form_data = new FormData();
  form_data.append("entryTitle", entryTitle);
  form_data.append("entryContent", entryContent);
  for (let i = 0; i < entryImages.length; i++) {
    form_data.append("img" + i, entryImages[i]);
  }

  $.ajax({
    type: "POST",
    url: "uploadEntry.php",
    dataType: "json",
    data: form_data,
    processData: false,
    contentType: false,
    cache: false,
    success: function () {
      form.submit();
    },
    error: function (xhr, status, error) {
      let message = xhr.responseJSON.error;
      document.getElementById("newEntryError").innerHTML = "Error: " + message;
    }
  });
}

$(document).ready(function() {
  setSizes();

  // Sidebar options
  $("#accountInfo").on("click", function() {
    location.assign("index.php");
    $(".sidebarOption").css("background-color", "white");
    $("#accountInfo").css("background-color", "rgb(235, 232, 232)");
  });

  $("#sensitiveInfo").on("click", function() {
    location.assign("sensitiveInfo.php");
    $(".sidebarOption").css("background-color", "white");
    $("#sensitiveInfo").css("background-color", "rgb(235, 232, 232)");
  });

  // $("#posts").on("click", function() {
  //   location.assign("posts.php");
  //   $(".sidebarOption").css("background-color", "white");
  //   $("#posts").css("background-color", "rgb(235, 232, 232)");
  // });

  $("#travelLog").on("click", function () {
    location.assign("travelLog.php");
    $(".sidebarOption").css("background-color", "white");
    $("#travelLog").css("background-color", "rgb(235, 232, 232)");
  })

  // Account info
  $("#editName").on("click", function() {
    clickEdit("#editName", "#nameForm");
  });
  $("#editPronouns").on("click", function() {
    clickEdit("#editPronouns", "#pronounsForm");
  });
  $("#editHomeCountry").on("click", function() {
    clickEdit("#editHomeCountry", "#homeCountryForm");
  });
  $("#editEmail").on("click", function() {
    clickEdit("#editEmail", "#emailForm");
  });
  $("#editPhoneNum").on("click", function() {
    clickEdit("#editPhoneNum", "#phoneNumForm");
  });

  // Sensitive info
  $("#changePassword").on("click", function() {
    $("#sensitiveInfoContent").css("display", "none");
    $("#changeForm1").css("display", "block");
  });

  $("#deleteAccount").on("click", function() {
    $("#sensitiveInfoContent").css("display", "none");
    $("#deleteForm1").css("display", "block");
  });

  // Travel log
  $("#newEntry").on("click", function () {
    $("#travelLogContent").css("display", "none");
    $("#newEntryForm").css("display", "block");
  });

  $("#entryFormBackButton").on("click", function () {
    $("#travelLogContent").css("display", "block");
    $("#newEntryForm").css("display", "none");
  })
});