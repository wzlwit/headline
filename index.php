<?php
include_once('./includes/function.php');
// use Monolog\logger;
// use Monolog\Handler\StreamHandler;

// login as admin
$no_sub_message = '';




if (is_login() && ($_SESSION['type'] == 'admin')) {
    if (($_SESSION['return'] == 'user_admin'))
      header('location: user_admin.php');
    else
      header('location: admin.php');
  } elseif ((is_login() && ($_SESSION['type'] == 'free')) || (is_login() && ($_SESSION['type'] == 'paid'))) {


    $results = DB::query("SELECT * FROM subscript where id=%i", $_SESSION['user_id']);

    if (count($results) > 0) {
        $count = 0;

        foreach ($results as $result) {
            $ch_ids[$count] = $result['ch_id'];
            $count++;
          }

        $ch_ids = implode(",", $ch_ids);


        $channels = DB::query("SELECT * FROM channel  where ch_id in ($ch_ids)");

        $channels = fetch_data_from_api('register', $channels);
      } else {
      // first login, will only see three channels 
      $channels = DB::query("SELECT * FROM channel ORDER BY RAND() LIMIT 3");
      // pr($channels);

      $channels = fetch_data_from_api('visitor', $channels);

      $no_sub_message = displayAlert("choose your own channels", $class = "primary");
    }
  } else {
  // visitor, not login , will see 3 radom channels with 3 news titles
  $channels = DB::query("SELECT * FROM channel ORDER BY RAND() LIMIT 3");
  $channels = fetch_data_from_api('visitor', $channels);
}

echo $twig->render('./news.html', array(
  'random_news' => $channels,
  'canada_topfive' => $result_api_canada,
  'no_sub_message' => $no_sub_message
));
 