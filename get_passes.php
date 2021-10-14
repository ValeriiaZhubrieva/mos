<?php
$autoNumber = trim($_POST['string'] ?? ''); // "В061ОУ1591";

$response = makeRequest("https://proverit-propusk-msk.ru/get_passes.php", "string={$autoNumber}", [
  'x-requested-with: XMLHttpRequest',
  'referer: https://proverit-propusk-msk.ru/',
], false);

echo json_encode($response);
exit;



function makeRequest($url, $payload, $headers = [], $is_get_request = false)
{
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.66 Safari/537.36');
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($curl, CURLOPT_HEADER, false);
  if (!$is_get_request) {
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
  }
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
  $out = curl_exec($curl);
  $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
  curl_close($curl);
  
  $response = json_decode($out, true);
  // $response['code'] = $code;
  return $response;
}

/*
function pass_cmp($a,$b){
    if($a->status=="ACTIVE" && $b->status!="ACTIVE"){
        return -63072000;
    }
    if($a->status!="ACTIVE" && $b->status=="ACTIVE"){
        return 63072000;
    }

    return strtotime($b->dateEnd)-strtotime($a->dateEnd);
}

function covert_data($data){
    $out=array();
    for ($i=0; $i < count($data) ; $i++) {
        $row=array();
        $row['zone']=$data[$i]->propusktype;
        $row['passInfo']=$data[$i]->seriya;
        $row['dateStart']=date("d.m.Y",strtotime($data[$i]->datestart));
        $row['dateEnd']=date("d.m.Y",strtotime($data[$i]->dateend));
        $row['status']=$data[$i]->colorstatus;
        array_push($out,(object)$row);
    }
    return $out;
}

function getNewData($vehicle_number){
    $curl = curl_init();
    $vehicle_number=$name = str_replace(' ', '', $vehicle_number);
    $post="string=".$vehicle_number;
    curl_setopt_array($curl, array(
        CURLOPT_URL => "http://proverit-propusk.ru/serch_number22.php",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $post,
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "content-type: application/x-www-form-urlencoded"
        ),
    ));


    $result = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    }
    $result=json_decode($result);
    if (isset($result->isnotfound)){
        return array();
    }
    $result=covert_data($result);
    usort($result, "pass_cmp");
    return $result;

}
if(isset($_POST['string'])){
    header("Content-type:application/json");
    echo json_encode(getNewData($_POST['string']));
}
else{
	die("no param passed");
}

?>
*/
