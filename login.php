<?php
require('./includes/function.php');
$msg = array("code" => 2, "logintime" => date("Y-m-d H:i:s"), "message" => "Please enter your information required!");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  if (isset($_POST['email']) && isset($_POST['password'])) {
    if ($_POST['email'] == '' && $_POST['password'] == '') {
      $msg = array("code" => 2, "logintime" => date("Y-m-d H:i:s"), "message" => "Please complete all the infomations!");
    } else if ($_POST['password'] == '') {
      // not enter password
      $msg = array("code" => 2, "logintime" => date("Y-m-d H:i:s"), "message" => "Please enter your PASSWORD!");
    } else if ($_POST['email'] == '') {
      //no username/email entered
      $msg = array("code" => 2, "logintime" => date("Y-m-d H:i:s"), "message" => "Please enter your USER NAME!");
    } else {
      $email = htmlspecialchars($_POST['email']);
      $password = htmlspecialchars($_POST['password']);

      $result = DB::queryFirstRow("SELECT * FROM account where email=%s", $email);
      if (md5($_POST['password']) == $result['password']) {
        //successfuly login, set session
        $_SESSION['user'] = $result['username'];
        $_SESSION['email'] = $result['email'];
        $_SESSION['user_id'] = $result['id'];
        $_SESSION['type'] = $result['type'];

        if (isset($_POST['remember']) && $_POST['remember'] == "true") {
          setcookie("username", $result['username'], time() + (86400 * 30));
          setcookie("email", $result['email'], time() + (86400 * 30));
          setcookie("user_id", $result['id'], time() + (86400 * 30));
          setcookie("type", $result['type'], time() + (86400 * 30));
          setcookie("remember", $_POST['remember'], time() + (86400 * 30));
        } else {
          setcookie('username', '', 0);
          setcookie("email", '', 0);
          setcookie("user_id", '', 0);
          setcookie("type", '', 0);
          setcookie("remember", '', 0);
        }

        //succeed return code=1，logintime=current time
        $msg = array("code" => 1, "logintime" => date("Y-m-d H:i:s",time()), "message" => "Login successfully!");
      } else {
        //fail return ode=2，logintime=current time 
        $msg = array("code" => 2, "logintime" => date("Y-m-d H:i:s",time()), "message" => "password is not correct");
      }
    }
  }
 
  //将PHP数组转换成JSON格式数据，以便前台JS好接收返回值 
  echo json_encode($msg);
}
?>
