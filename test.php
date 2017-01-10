<?php
// $access_token="1212907838803986|ijGhwERuA0BJDgy0Q4055w3BTVs";

// $fields="id,name,description,link,cover_photo,count";
// $fb_page_id = "1075939145776856";

// $json_link = "https://graph.facebook.com/v2.8/{$fb_page_id}/albums?fields={$fields}&access_token={$access_token}";
// $json = file_get_contents($json_link);
// echo '<pre>';
// print_r($obj = json_decode($json, true, 512, JSON_BIGINT_AS_STRING));
// echo '</pre>';

$album_id = '1116692381701532';
$access_token="1212907838803986|ijGhwERuA0BJDgy0Q4055w3BTVs";
$json_link = "https://graph.facebook.com/v2.8/{$album_id}/photos?fields=source,images,name&access_token={$access_token}";
$json = file_get_contents($json_link);

echo '<pre>';
print_r($obj = json_decode($json, true, 512, JSON_BIGINT_AS_STRING));
echo '</pre>';