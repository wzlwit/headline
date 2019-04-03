<?php
require('./includes/function.php');


$countrys = array();
$ch_ids = array();

$results = DB::query("SELECT DISTINCT location, count(*) as number FROM channel group by location ");


foreach ($results as $country) {
        $country["channels"] = DB::query("SELECT * FROM channel where location=%s", $country["location"]);
        // array_push($countrys,$country);
        array_push($countrys, $country);
    }

//pr($countrys);
if (is_login()) {


    if ($_SERVER['REQUEST_METHOD'] == "POST") {


            $user_subscript = user_subscript();

            // return an array that contains the entries from array1 that are not present in array2
            $ch_diffs = array_diff($user_subscript, $_POST['channel_sub']);


            if (count($ch_diffs) > 0) {

                foreach ($ch_diffs as $ch_diff) {
                        $createtime = DB::queryOneField('createtime', "SELECT * FROM subscript WHERE id=%s and ch_id=%i", $_SESSION['user_id'], $ch_diff);
                       
                        DB::insert('history', array(
                            'id' => $_SESSION['user_id'],
                            'ch_id' => $ch_diff,
                            'createtime' =>  $createtime
                        ));
                    }
            }
            DB::query("DELETE FROM subscript where id=%i", $_SESSION['user_id']);



            foreach ($_POST['channel_sub'] as $channel_update) {

                    DB::insert('subscript', array(
                        'id' => $_SESSION['user_id'],
                        'ch_id' => $channel_update
                    ));
                }
      header('location:index.php');

        }



    $ch_ids = user_subscript();
  // 
}

echo $twig->render(
    './channels.html',
    array(
        'countrys' => $countrys,
        'canada_topfive' => $result_api_canada,
        'channels_subscript' => $ch_ids
    )
);
 ?>