<?php
require 'includes/function.php';

if($_SERVER['REQUEST_METHOD'] == "GET")

{

if(isset($_GET['topic'])&&$_GET['topic']!='')
{
    $results=array();
    $topic=$_GET['topic'];

    $topic=str_replace(" ","%20",$topic);
    $search=search($topic);
    //pr($search);
    $totalRes=$search['totalResults'];
   // echo $totalRes;
    if(is_login()&&$_SESSION['type']=='paid'){
      if( $totalRes<=20)
      $row= $totalRes ;
       else
       $row=20;
    }
    else{
      if( $totalRes<=10)
      $row= $totalRes ;
        else
        $row=10;
      
    }

//echo $totlRes;


for($i=0;$i<$row;$i++)
{
   $results[$i]= $search['articles'][$i];
}

$topic=str_replace("%20"," ",$topic);

//pr($results);


}




}

echo $twig->render('./search.html',array(
'results'=>$results,
'canada_topfive'=>$result_api_canada ,
'total'=>$totalRes,
'topic'=>$topic));




?>