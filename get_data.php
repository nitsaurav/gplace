<?php
if(isset($_POST['submit_address']))
{
  $address =$_POST['address']; // Google HQ
  $prepAddr = str_replace(' ','+',$address);
  $geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
  $output= json_decode($geocode);
  $latitude = $output->results[0]->geometry->location->lat;
  $longitude = $output->results[0]->geometry->location->lng;
	
  echo "latitude - ".$latitude;
  echo "longitude - ".$longitude;
}

if(isset($_POST['submit_coordinates']))
{
  $lat=$_POST['latitude'];
  $long=$_POST['longitude'];
	
//   $url  = "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$lat.",".$long."&key=AIzaSyB3y1SVmEEPYnFh8oI9lbhluGV08EXhGdA";
//   $url = "https://geokeo.com/geocode/v1/reverse.php?lat=".$lat."&lng=".$long."&api=AIzaSyB3y1SVmEEPYnFh8oI9lbhluGV08EXhGdA";
$url="https://maps.googleapis.com/maps/api/geocode/json?latlng=" .$lat. '%2C' . $long."&language=en";
  $json = @file_get_contents($url);
  $data = json_decode($json);
  print_r($data);die;
  $status = $data->status;
  $address = '';
  if($status == "OK")
  {
	echo $address = $data->results[0]->formatted_address;
  }
  else
  {
	echo "No Data Found Try Again";
  }
}
?>
<?php

// $url = "https://geokeo.com/geocode/v1/reverse.php?lat=23.3297763&lng=85.37659029999999&api=AIzaSyB3y1SVmEEPYnFh8oI9lbhluGV08EXhGdA";

// //call api
// $json = file_get_contents($url);
// $json = json_decode($json);
// // print_r($json->results);die;
// if(array_key_exists('status',$json))
// {
	
// 	if($json->status=='ok')
// 	{
// 		$address = $json->results[0]->formatted_address;
// 		$latitude = $json->results[0]->geometry->location->lat;
// 		$longitude = $json->results[0]->geometry->location->lng;
// 		//do something with the data
//         echo $address;
			
// 	}else{
//         echo "fail";
//     }		
// }else{
//     echo "fa";
// }
?>