<?php

function uploadFiles($data){

    $str  = microtime();
    $str  = str_replace(' ','',$str);
    $name = str_replace('.','',$str);
    $extension = pathinfo($data['name'], PATHINFO_EXTENSION);
    $imageName = $name;
    $result =   move_uploaded_file($data["tmp_name"],"notice_images/".$imageName.".".$extension);
    return $adhar_back_name =  $imageName.".".$extension;

}
?>