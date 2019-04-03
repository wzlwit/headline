<?php

require './includes/function.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $email = htmlspecialchars($_POST['email']);
    $username = htmlspecialchars($_POST['username']);
    $password = md5(htmlspecialchars($_POST['password']));

    $result = DB::queryFirstRow("SELECT * FROM account where email=%s", $email);

    if ($result !=null) {
        $msg = array("code" => 2, "message" => "User already exist!");
    // if (count($result) > 0) {
    //     $msg = array("code" => 2, "message" => "User already exist!");

    } else {
        $time = date("Y-m-d H:i:s");
        //if is a new free user sign up 
        if(!is_login()&&!is_admin())
        {
        $_SESSION['user']=$username; 
        $_SESSION['type']='free';
        }else
        {
            $_SESSION['return']='user_admin';
        }


    DB::insert('account', array(
        'username' => $username,
        'password' => $password,
        'email' => $email,
        'type' => $_SESSION['type'],
        'regtime' => $time,
        'lastlogintime' => $time,
    ));
        $msg = array("code" => 1, 'message' => 'sign up successfully');
       $_SESSION['user_id']=DB::insertId(); 
    }

    echo json_encode($msg);
}
