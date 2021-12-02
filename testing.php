<?php

function hit_post($counter)
{
    $url = "https://studi-kasus-1-evelynsierraa.000webhostapp.com/register.php";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
        "Accept: application/json",
        "Content-Type: application/json",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    $data = <<<DATA
{
  "register":"true",
  "username": "gerry{$counter}",
  "name": "gerry",
  "email": "gsihaj5@gmail.com",
  "password" : "12345678",
  "notelp" : "12345678",
  "jurusan" : "tc"
}
DATA;

    curl_setopt($curl, CURLOPT_POSTFIELDS,
        "register=true&username=gerry" . $counter . "&name=gerry&email=gsihaj5@gmail.com&password=12345678&notelp=12345678&jurusan=tc"
    );

//for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $resp = curl_exec($curl);
    var_dump($resp);
    curl_close($curl);
    return $counter + 1;
}

$counter = 1;
while (true) {
    $counter = hit_post($counter);
    echo $counter;
}

//hit_post(1);
?>
