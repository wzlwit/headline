function readMore(loopindex) {

  var dot = 'dot' + loopindex;
  var more = 'more' + loopindex;
  var myBtn = 'myBtn' + loopindex;
  var dots = document.getElementById(dot);
  var moreText = document.getElementById(more);
  var btnText = document.getElementById(myBtn);


  if (dots.style.display === "none") {
    dots.style.display = "inline";
    btnText.innerHTML = "Read more";
    moreText.style.display = "none";
  } else {
    dots.style.display = "none";
    btnText.innerHTML = "Read less";
    moreText.style.display = "inline";
  }
}

//call back function to limit free user can only subscript maximum 5 channels
$(document).ready(function () {
  var bol = $("input.inputimg:checkbox:checked").length >= 5;
  console.log($("input.inputimg:checkbox:checked"));
  $("input.inputimg:checkbox")
    .not(":checked")
    .attr("disabled", bol);

  $("input.inputimg:checkbox").click(function () {
    var bol = $("input.inputimg:checkbox:checked").length >= 5;
    if (bol) {
      $("input.inputimg:checkbox")
        .not(":checked")
        .attr("disabled", "disabled");
    } else {
      $("input.inputimg:checkbox")
        .not(":checked")
        .removeAttr('disabled');
    }
  });
});




//validate form of editchannel use formValitation library 
$("#editchannel").validate({
  rules: {
    name: "required",
    source: "required",
    icon: "required",
    location: "required"
  },
  messages: {
    name: "please provide a name",
    source: "Please entre the source information",
    icon: "Pleace upload a icon",
    location: "Please choose a location from the list"
  }
});


//validate form of updateChannel use formValitation library 
$("#updateChannel").validate({
  rules: {
    name: "required",
    source: "required",
    location: "required"
  },
  messages: {
    name: "please provide a name",
    source: "Please entre the source information",
    location: "Please choose a location from the list"
  }
});

//validate form of updateUser use formValitation library 
$("#updateUser").validate({
  rules: {
    username: "required",
    email: "required",
    type: "required"
  },
  messages: {
    username: "please provide a name",
    email: "Please entre the your Email",
    type: "Please choose a type from this user"
  }
});


//validate form of login use ajax 
function validation() {
  var email = $("#email_login").val();
  var password = $("#password_login").val();
  var remember=$('#remember').checked; 
console.log(remember);
  if (email == "" && password == "") {
    $("#msg").html("Login: Please complete all the infomations!!");
    return false;
  } else {
    if (email == "") {
      $("#msg").html("Login: Please enter your Email!!");
      return false;
    }
    if (password == "") {
      $("#msg").html("Login: Please enter your PASSWORD!");
      return false;
    }
  }
 
  $.ajax({
    url: "login.php",
    type: "POST",
    dataType: "json",
    data: { email: email, password: password ,remember :remember},
    beforeSend: function() {
      $("#msg")
        .addClass("text-success")
        .text("login...");
    },
    success: function(res) {
      if (res.code == 1) {
        //登录成功
        $("#msg").html(res.message);
        location.href = "index.php";
      } else {
        $("#msg").html(res.message);
        // console.log(data);
        return false;
      }
      console.log(res.code);
    },
  });
  return false;
}

//validate form of login use ajax
function signup() {
  var user_r = $("#username_r").val();
  var pass_a = $("#psw_a").val();
  var pass_b = $("#psw_b").val();
  var email_r = $("#email_r").val();

  if (user_r == "" && pass_a == "" && pass_b == "" && email_r == "") {
    $("#msg_r").html(" Please complete all the infomations!!");
    return false;
  } else {
    var reg = /^\w+((.\w+)|(-\w+))@[A-Za-z0-9]+((.|-)[A-Za-z0-9]+).[A-Za-z0-9]+$/;

    if (user_r == "") {
      $("#msg_r").html("Sign Up: Please enter your user name!!");
      return false;
    }
    if (pass_a == "" || pass_b == "") {
      $("#msg_r").html("Sign Up: Please enter your PASSWORD!");
      return false;
    }
    if (pass_a != pass_b) {
      $("#msg_r").html("Sign Up: PASSWORD not the same!");
      return false;
    }
    if (email_r == "") {
      $("#msg_r").html("Sign Up: Please enter your EMAIL !");
      return false;
    }
    if (!reg.test(email_r)) // check if email adress is valid
    {
      $("#msg_r").html("Sign Up: Please enter a valid EMAIL address!");
    }
  }

  //ajax to check if email has already been used
  $.ajax({
    url: "signup.php",
    type: "POST",
    dataType: "json",
    data: { username: user_r, password: pass_a, email: email_r },
    beforeSend: function () {
      $("#msg_r")
        .addClass("text-success")
        .text("Sign up...");
    },
    success: function (res) {
      if (res.code == 1) {
        //signup succesfully
        console.log(res);
        $("#msg_r").html(res.message);
        location.href = "index.php";
      } else {
        $("#msg_r").html(res.message);
        // console.log(data);
        return false;
      }
    },
  });

  return false;
}

