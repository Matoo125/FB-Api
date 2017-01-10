<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

$page_title = "Display Facebook Page Events on Website"; 
$access_token = "1445348478810507|_CRPGOwDfp9C5cb3MBOgL942L6Y";
$fb_page_id = "131398130355556"; 

$year_range = 2;
// automatically ajdust date range
$since_date = date('Y-01-01', strtotime('-' . $year_range . ' years'));
$until_date = date('Y-01-01', strtotime('+' . $year_range . ' years'));

// unix timestamp years
$since_unix_timestamp = strtotime($since_date);
$until_unix_timestamp = strtotime($until_date);

$fields = "id,name,description,place,timezone,start_time,cover";
$json_link = "https://graph.facebook.com/v2.7/{$fb_page_id}/events/attending/?fields={$fields}&access_token={$access_token}&since={$since_unix_timestamp}&until={$until_unix_timestamp}";

$json = file_get_contents($json_link);

$obj = json_decode($json, true, 512, JSON_BIGINT_AS_STRING);

?>

<!DOCTYPE html>
<html lang="en">
<head>
 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
    <title><?php echo $page_title; ?></title>

    <table class="table table-hover table-responsive table-bordered">
    	<?php
    		// count the number of events
    		$event_count = count($obj['data']);

    		for ($x=0; $x < $event_count; $x++): 
				// set timezone
				date_default_timezone_set($obj['data'][$x]['timezone']);
				 
				$start_date = date( 'l, F d, Y', strtotime($obj['data'][$x]['start_time']));
				$start_time = date('g:i a', strtotime($obj['data'][$x]['start_time']));
				  
				$pic_big = isset($obj['data'][$x]['cover']['source']) ? $obj['data'][$x]['cover']['source'] : "https://graph.facebook.com/v2.7/{$fb_page_id}/picture?type=large";
				 
				$eid = $obj['data'][$x]['id'];
				$name = $obj['data'][$x]['name'];
				$description = isset($obj['data'][$x]['description']) ? $obj['data'][$x]['description'] : "";
				 
				// place
				$place_name = isset($obj['data'][$x]['place']['name']) ? $obj['data'][$x]['place']['name'] : "";
				$city = isset($obj['data'][$x]['place']['location']['city']) ? $obj['data'][$x]['place']['location']['city'] : "";
				$country = isset($obj['data'][$x]['place']['location']['country']) ? $obj['data'][$x]['place']['location']['country'] : "";
				$zip = isset($obj['data'][$x]['place']['location']['zip']) ? $obj['data'][$x]['place']['location']['zip'] : "";
				 
				$location="";
				 
				if($place_name && $city && $country && $zip){
				    $location="{$place_name}, {$city}, {$country}, {$zip}";
				}else{
				    $location="Location not set or event data is too old.";
			}
    			?>
    			<tr>
    				<td rowspan="6" style="width: 20em;">
    					<img src="<?php echo $pic_big; ?>" width="200px" />
    				</td>
    			</tr>

    			<tr>
    				<td style="width: 15em;">What:</td>
    				<td><b><?php echo $name; ?></b></td>
    			</tr>

    			<tr>
    				<td>When:</td>
    				<td><?php echo $start_date . ' at ' . $start_time ?></td>
    			</tr>

    			<tr>
    				<td>Where:</td>
    				<td><?php echo $location; ?></td>
    			</tr>

    			<tr>
    				<td>Where:</td>
    				<td><?php echo $description; ?></td>
    			</tr>

    			<tr>
    				<td>Facebook link:</td>
    				<td><a href="https://www.facebook.com/events/<?php echo $eid; ?>/" target='_blank'>View on Facebook</a></td>
    			</tr>

    	    <?php endfor; ?>
    </table>
 
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
 
</head>
<body>
     
 
<div class="container">
 
	<div class="page-header">
		<h1><?php echo $page_title; ?></h1>
	</div>

<!-- events will be here -->
 
</div>
 
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
 
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
 
</body>
</html>