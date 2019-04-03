<?php
include_once './includes/function.php';

if(is_admin()){
// if login as admin


$fields=array('username','email','type');
$error = '';
$user_update="";
$openModal=0;

if ($_SERVER['REQUEST_METHOD'] == "POST") {

if($_POST['action']=='update')

{
    foreach ($fields as $f) {
        //check all fields are set and not empty strings
        if (!isset($_POST[$f]) || $_POST[$f] == "") {
            $error = "All fields are required";
            break;
        }

        if ($error== "") { // still no errors... save to db
        
       
               //file upload validation
               DB::update('account', array(
                   'username' => $_POST['username'],
                   'email' => $_POST['email'],
                   'type' => $_POST['type']
               ),"id=%i", $_POST['id']
            
            );
           header('location:user_admin.php');
    }


}}}

    
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $openModal=1;
  if (isset($_GET['id']) &&is_numeric($_GET['id'] ))
   {
        $id = $_GET['id'];
    //  if (isset($_GET['location']) &&$_GET['location']!='' )
// if click on delete
   if (isset($_GET['del']) && $_GET['del'] == 1) 
      {    $openModal=2;
          // delete channel with ch_id
          DB::delete('account', "id=%i", $id);
      }
      //update
      else {
           $openModal=3;
// get information on the channels with the id= id get
          $user_update = DB::queryFirstRow("SELECT * FROM account WHERE id=%i", $id);
        
      }
  }
}



$accounts= array('free','paid','admin');

foreach ($accounts as $account_type) {
    $accounts[$account_type] = DB::query("SELECT * FROM account where type=%s", $account_type);
 
}


$accounts=array_slice($accounts,count($accounts)/2,count($accounts)/2,true);

echo $twig->render('./user_admin.html',
    array('form_action' => $_SERVER['PHP_SELF'],
        'accounts' => $accounts,
        'user_update' => $user_update,
        'openModal'=>$openModal
       // 'location'=>$_SESSION['location']
    ));
}
else{

 echo 'need to do';
 //header('location:./index.php');

}
?>