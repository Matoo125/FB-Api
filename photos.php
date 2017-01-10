<?php
$album_id = isset($_GET['album_id']) ? $_GET['album_id'] : die('Album ID not specified.');
$album_name = isset($_GET['album_name']) ? $_GET['album_name'] : die('Album name not specified.');

$page_title = "{$album_name} Photos";

$access_token="1212907838803986|ijGhwERuA0BJDgy0Q4055w3BTVs";
$json_link = "https://graph.facebook.com/v2.8/{$album_id}/photos?fields=source,images,name&access_token={$access_token}";
$json = file_get_contents($json_link);

$obj = json_decode($json, true, 512, JSON_BIGINT_AS_STRING);

$photo_count = count($obj['data']);
?>

<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?php echo $page_title; ?></title>

	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

</head>
<body>

	<div class="container">
		<h1><?php echo $page-header; ?>
			<a href="index.php">Albums</a> / <?php echo $page_title; ?>
		</h1>

		<?php

		for($x=0; $x<$photo_count; $x++):

	    $source = isset($obj['data'][$x]['images'][0]['source']) ? $obj['data'][$x]['images'][0]['source'] : ""; //hd image
	    $thumb = isset($obj['data'][$x]['images'][4]['source']) ? $obj['data'][$x]['images'][4]['source'] : '';
	    $name = isset($obj['data'][$x]['name']) ? $obj['data'][$x]['name'] : "";


		?>
		<div id="images">
			<a href="<?php echo $source; ?>">
				<img src="<?php echo $thumb; ?>">
			</a>
		</div>

		
	<?php endfor; ?>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

</body>
</html>