<?php
require('./vendor/autoload.php');
session_start();

// variabsle for APINews
$api_head = 'https://newsapi.org/v2/top-headlines?sources=';

$api_keys = array(
  '44b2de67fa3f4329b591e1076b6e8bf5',
  'bda7be050323422bade474011e626a84',
  '8ad6060a7ef843ea8e70cc5498180f80',
  "10032b5cbc084cf5b6e2ff55320cab7f",
  "fe216b327bce47d4838009e05f0874ae"
);

// this function can automatically change to new api if one API is exhausted. however, it will exhaust API quickly. Unless, pay for an API to get unlimited access
function testConnection($api_keys)
{
  foreach ($api_keys as $api_key) {
    $url_canada = "https://newsapi.org/v2/top-headlines?country=ca&apiKey=" . $api_key;
    $content_right = file_get_contents($url_canada);
    if ($content_right != false)
      return $api_key;
  }
}

$api_key = testConnection($api_keys);


//to get top five news today from canada
$url_canada = "https://newsapi.org/v2/top-headlines?country=ca&apiKey=" . $api_key;
$content_right = file_get_contents($url_canada);
$result_api_canada  = json_decode($content_right, true);

// global variables for location of the channel and type of user
$continents =  array('American', 'Asia', 'Europe', 'Africa', 'Australia');
$userType = array('free', 'paid', 'admin');

// database parameters
DB::$user = 'root';
//DB::$password='ipdipd';
DB::$dbName = 'headlinenews';

//twig configuration
$loader = new \Twig\Loader\FilesystemLoader('template');
$twig = new \Twig\Environment($loader);

//function for user search
function search($topic)
{
  $search = 'https://newsapi.org/v2/everything?q=' . $topic . '&apiKey=' . $GLOBALS['api_key'];
  $content = file_get_contents($search);
  $result_api  = json_decode($content, true);
  return $result_api;
}

function checkCookie()
{
  if (!empty($_COOKIE['user'])) {
    $_SESSION['user'] = $_COOKIE['user'];
    $_SESSION['user_id'] = $_COOKIE['user_id'];
    $_SESSION['type'] = $_COOKIE['type'];
    $_SESSION['email'] = $_COOKIE['email'];
  }
}

//function for upload file
function uploadFile($FILES)
{
  $returnValue = array(
    'name' => '',
    'error' => ''
  );
  if ((($_FILES["icon"]["type"] == "image/jpg")
    || ($_FILES["icon"]["type"] == "image/gif")
    || ($_FILES["icon"]["type"] == "image/png"))
    //should check files size
    //  && ($_FILES["icon"]["size"] < 50000)
  ) {
    if ($_FILES["icon"]["error"] > 0) {
      $returnValue['error'] = "Return Code: " . $_FILES["icon"]["error"];
    } else {
      // if no error, upload the file 
      $filetype = strrchr($_FILES["icon"]["name"], ".");
      $new_name = trimall($_POST['name']) . $filetype;
      move_uploaded_file(
        $_FILES["icon"]["tmp_name"],
        "images/" . $new_name
      );
      $returnValue['name'] = $_FILES["icon"]["name"];
    }
  } else {
    $returnValue['error'] = "Invalid file";
  }
  return $returnValue;
}

//  functions for debug, will delete after all done
function br()
{
  echo '<br>';
}

function pr($arr)
{
  echo '<pre>';
  print_r($arr);
  echo '</pre>';
  echo '<hr>';
}

function displayAlert($message, $class = "primary")
{
  return "<div class='alert alert-" . $class . "'>" . $message . "</div>";
}

// to check if user is logged in
function is_login()
{
  if (isset($_SESSION['user']) && $_SESSION['user'] != '') {
    return true;
  } else
    return false;
}

// to check if user is login as admin
function is_admin()
{
  if (isset($_SESSION['type']) && $_SESSION['type'] == 'admin')
    return true;
  else
    return false;
}

function trimall($str)
{
  $before = array(" ", "　", "\t", "\n", "\r");
  $after = array("", "", "", "", "");
  return str_replace($before, $after, $str);
}

// check user subscript history
function user_subscript()
{
  $results = DB::query("SELECT * FROM subscript where id=%i", $_SESSION['user_id']);
  if (count($results) > 0) {
    $count = 0;
    foreach ($results as $result) {
      $ch_ids[$count] = $result['ch_id'];
      $count++;
    }
  } else
    $ch_ids = array();
  return $ch_ids;
}

// main function to fetch data from apinews, prepare news according to user's type
function fetch_data_from_api($type, $channels)
{
  $counter = 0;
  foreach ($channels as $channel) {
    $url = $GLOBALS['api_head'] . $channel['source'] . '&apiKey=' . $GLOBALS['api_key'];
    $content = file_get_contents($url);
    $result_api  = json_decode($content, true);
    $channel['today_news'] = array();
    $random_news = array();
    // if not login , will show three random channels with three news for each channel
    if ($type == 'visitor') {
      if (count($result_api['articles']) < 3)
        $total_news = count($result_api['articles']);
      else
        $total_news = 3;
    }

    // if user login, display the subscript channels with news 
    else {
      $total_news = count($result_api['articles']);
    }
    for ($i = 0; $i < $total_news; $i++) {
      //push news into the array of channel
      array_push($channel['today_news'], $result_api['articles'][$i]);
    }

    $channels[$counter] = $channel;
    $counter++;
  }
  return $channels;
}

function statistic()
{
  $stat = array();
  DB::query("SELECT * FROM account ");
  $stat['totalUsers'] = DB::count();
  DB::query("SELECT * FROM subscript ");
  $stat['totalSub'] = DB::count();
  $channelsSub = DB::query("SELECT  count(*) as number ,c.name FROM subscript as s
  inner join channel as c
  on
  s.ch_id=c.ch_id
  group by s.ch_id order by number desc");
  $topfive = array_slice($channelsSub, 0, 5);
  $stat['topfive'] = $topfive;
  $statisticColor = array('progress-bar-danger', 'progress-bar-warning', 'progress-bar-success', ' ', 'progress-bar-info');

  for ($i = 0; $i < 5; $i++) {
    $stat['topfive'][$i]['class'] = $statisticColor[$i];
  }

  return $stat;
}

checkCookie(); //if remembered, will login automatically

/* pr($_SESSION);
echo "Cookies: <br>";
pr($_COOKIE); */

// global variable for twig
$twig->addGlobal('is_logged_in', is_login());
$twig->addGlobal('is_admin', is_admin());
$twig->addGlobal('session', $_SESSION);
$twig->addGlobal('continents', $continents);
$twig->addGlobal('userType', $userType);
$twig->addGlobal('statistic', statistic());
?>