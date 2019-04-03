<?php
require('./includes/function.php');

$account = array();
$msg = '';
$action= '';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $email = htmlspecialchars($_POST['email']);
    $username = htmlspecialchars($_POST['username']);
    $password1 = md5(htmlspecialchars($_POST['psw_a']));
    $password2 = md5(htmlspecialchars($_POST['psw_b']));

$account = DB::queryFirstRow("SELECT * FROM account where id=%i", $_SESSION['user_id']);

    if ($account == null) {
        $msg = "Cannot update your account, please contact admin!";
    } else {
            if ($username == "") {
                $msg = " Please enter your user name!!";
            }
            elseif ($password1 == "" || $password2 == "") {
                $msg = " Please enter your PASSWORD!";
            }

           elseif (preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email) ? false : true) 
            
            {
                    $msg = "Please check your EMAIL format!";
                }


            elseif ($password1 != $password2) {
                    $msg = " PASSWORD not the same";
                }
            
                else {
                DB::update('account', array(
                    'username' => $username,
                    'password' => $password1,
                    'email' => $email
                )
                ,"id=%i",  $_SESSION['user_id']
            );

                $msg = "Update successfully, will go back to Homepage shortly";
                $action= 'finish';
            }
        }
}

$account = DB::queryFirstRow("SELECT * FROM account where id=%i", $_SESSION['user_id']);

echo $twig->render(
    './account.html',
    array(
        'form_action' => $_SERVER['PHP_SELF'],
        'account' => $account,
        'message' => $msg,
        'canada_topfive' => $result_api_canada,
        "action" => $action
      
    )
);
 