<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$fb_access_token = "1445348478810507|_CRPGOwDfp9C5cb3MBOgL942L6Y";
$fb_page_id = "131398130355556";
$fetch_year_range = 2;

$fetch_since = date('Y-m-d', strtotime('-' . $fetch_year_range . "years"));
$fetch_until = date('Y-m-d', strtotime('+' . $fetch_year_range . " years"));

$fetch_since_timestamp = strtotime($fetch_since);
$fetch_until_timestamp = strtotime($fetch_until);

$fields_to_fetch = array("id", "name", "description", "start_time", "cover");

$request_url = "https://graph.facebook.com/v2.7/" . $fb_page_id . "/events/attending/?fields=" . implode(",", $fields_to_fetch) . "&access_token=" . $fb_access_token . "&since=" . $fetch_since_timestamp . "&until=" . $fetch_until_timestamp;
$json_response = file_get_contents($request_url);
$events_array = json_decode($json_response, true)['data'];


?>

<?php foreach($events_array as $event): ?>

<img src="<?php echo $event['cover']['source']; ?>"> <br>

<h2><?php echo $event['name']; ?></h2> 

<p><i><?php echo date("j-n-Y | H:i", strtotime($event['start_time'])); ?></i></p>

<p><?php echo $event['description']; ?></p> 

<?php endforeach; ?>


