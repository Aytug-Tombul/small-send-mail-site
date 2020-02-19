var loginDiv = ` <div id="loginStatus">
<input type="text" class="username" style="margin-bottom : 10px;" placeholder="Username"><br>
<input type="text" class="password" style="margin-bottom : 10px;" placeholder="Password"><br>
<button type="button" id="login">login</button>
<button type="button" id="registerdiv">register</button>
</div>`;
var registerDiv = `<div id="registerStatus">
<input type="text" id="username" style="margin-bottom : 10px;" placeholder="Username"><br>
<input type="text" id="password" style="margin-bottom : 10px;" placeholder="Password"><br>
<button type="button" id="register">register</button>
</div>`;

var mailDiv = `<div id="mails"></div>
<div id="sendmail">
<select id="users">
  
</select>
<textarea id="post" rows="5" placeholder="Write Something Here..."></textarea>
<button type="button" id="postIt">POST</button>
</div>`;
var loggedToken = "";


$(document).on("click", "#registerdiv", function() {
  $("#loginStatus").remove();
  $("body").append(registerDiv);
});

$(document).on("click", "#register", function() {
  var usernameVal = $("#username").val();
  var passwordVal = $("#password").val();
  $.ajax({
    url: "register.php",
    type: "POST",
    dataType: "text",
    data: { username: usernameVal, password: passwordVal },
    success: function() {
      $("#registerStatus").remove();
      $("body").append(loginDiv);
    }
  });
});

$(document).on("click", "#login", function() {
  var usernameVal = $("#username").val();
  var passwordVal = $("#password").val();
  $.ajax({
    url: "login.php",
    type: "POST",
    dataType: "text",
    data: { username: usernameVal, password: passwordVal },
    success: function(data) {
      data = JSON.parse(data);
      loggedToken = data.token;
      $("#loginStatus").remove();
      $("body").append(mailDiv);
      getUsers(usernameVal);
      getMails()
    }
  });
});

function getMails() {
    $.ajax({
        url: "getMails.php",
        type: "POST",
        data:{token: loggedToken},
        success: function(data) { 
            data = JSON.parse(data);
            for (let i = 0; i < data.length; i++) {
                var gettedMail = `<div id="mail"><p>Gonderen : `+data[i].gonderen +
                 "<br>"+data[i].post+
                `</div`
                $("#mails").append(gettedMail);
            }
            
        
        }
      });
}
function getUsers(username) {
  $.ajax({
    url: "getUsers.php",
    type: "GET",
    success: function(data) {
      data = JSON.parse(data);
      for (let i = 0; i < data.length; i++) {
        if (data[i].username==username) {
            continue;
        }else{
            var option =
            `<option value=` +
            data[i].username +
            `>` +
            data[i].username +
            `</option>`;
          $("#users").append(option);
        }
        }
        
    }
  });
}

$(document).on("click", "#postIt", function() {
  var selectedUser=$('#users').val();
  var post = $("#post").val();
  $.ajax({
    url: "post.php",
    type: "POST",
    data: { post: post, token: loggedToken ,sendedUser:selectedUser},
    success: function(data) {
      $("#post").val("");
      window.alert(data);
    }
  });
});
