<?php
include_once './includes/function.php';

if(is_admin()){
// if login as admin
$channel_update = array();
$activity = 'none';
$location = '';
$fields = array('name', 'source', 'location');
$error = '';
$message="";
$openModal=0;
$search='';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

if($_POST['action']=='update')

{
    foreach ($fields as $f) {
        //check all fields are set and not empty strings
        if (!isset($_POST[$f]) || $_POST[$f] == "") {
            $error = "All fields are required";
            break;
        }


    if ($_FILES["icon"]["error"] ==4)
    {
        DB::update('channel', array(
            'name' => $_POST['name'],
            'source' => $_POST['source'],
            'location' => $_POST['location']
            // 'category' => $_POST['Category']
          ) ,"ch_id=%i", $_POST['id']
         );
        
    }
 
    if ($_FILES["icon"]["error"] ==0)
    {
        if (empty($error)){
            $upload= uploadFile($_FILES);
            $new_name=$upload['name'];
            $error=$upload['error'];
       }
       
           if ($error== "") { // still no errors... save to db
        
       
               //file upload validation
               DB::update('channel', array(
                   'name' => $_POST['name'],
                   'source' => $_POST['source'],
                   'location' => $_POST['location'],
                   'icon' => $new_name
                   // 'category' => $_POST['Category']
               ),"ch_id=%i", $_POST['id']
            
            );
           
    }


}}}

    // todo : updata validation

    if($_POST['action']=='create')
 {

    foreach ($fields as $f) {
        //check all fields are set and not empty strings
        if (!isset($_POST[$f]) || $_POST[$f] == ""|| $_FILES['icon']['name']=='') {
            $error = "All fields are required";
            break;
        }
    }

    if (empty($error)){
     $upload= uploadFile($_FILES);
     $new_name=$upload['name'];
     $error=$upload['error'];
}

    if ($error== "") { // still no errors... save to db
 

        //file upload validation
        DB::insert('channel', array(
            'name' => $_POST['name'],
            'source' => $_POST['source'],
            'location' => $_POST['location'],
            'icon' => $new_name
            // 'category' => $_POST['Category']
        ));
    
      $_SESSION['location']=$_POST['location'];

 } 
}  

 // header ("Location: admin.php?loacation= $location");
    }

// if click on update or delete
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

if(isset($_GET['action'])&&$_GET['action']=="search"){
$search=DB::queryFirstRow("SELECT * FROM channel WHERE name =%s", $_GET['topic']);
}
else
    {
    $openModal=1;
  if (isset($_GET['id']) &&is_numeric($_GET['id'] ))
   {
        $id = $_GET['id'];
    //  if (isset($_GET['location']) &&$_GET['location']!='' )
// if click on delete
   if (isset($_GET['del']) && $_GET['del'] == 1) 
      {    $openModal=2;
          // delete channel with ch_id
          DB::delete('channel', "ch_id=%i", $id);
      }
      //update
      else {
           $openModal=3;
// get information on the channels with the id= id get
          $channel_update = DB::queryFirstRow("SELECT * FROM channel WHERE ch_id=%i", $id);
        
      }
  }
}}


$results = DB::query("SELECT DISTINCT location, count(*) as number FROM channel group by location ");
$countrys = array();

foreach ($results as $country) {
    $country["channels"] = DB::query("SELECT * FROM channel where location=%s", $country["location"]);
    array_push($countrys, $country);
}



echo $twig->render('./admin.html',
    array('form_action' => $_SERVER['PHP_SELF'],
        'countrys' => $countrys,
        'channel_update' => $channel_update,
        'error'=> $error,
        'message'=> $message,
        'openModal'=>$openModal,
        'search'=>$search
       // 'location'=>$_SESSION['location']
    ));
}
else{

 header('location:./index.php');

}
?>