<?php
class City {
function getCity($province){
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://api.rajaongkir.com/starter/city?&province=".$province,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "key: 14221a36a1376773a58eda3295b23fee"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  //echo $response;
  
  $data = json_decode($response, true);
  //echo json_encode($k['rajaongkir']['results']);

  
  for ($i=0; $i < count($data['rajaongkir']['results']); $i++){
  $hasil[]=array($data[rajaongkir][results][$i]['city_id'],$data[rajaongkir][results][$i]['city_name']);

  
  }
 
}
return $hasil;
}
}

?>
