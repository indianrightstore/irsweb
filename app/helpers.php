<?php
// My common functions

function test(){
	//ALTER TABLE `stores` ADD `store_category_id` INT(11) NOT NULL AFTER `product_id`;
	//ALTER TABLE `stores` CHANGE `location` `store_location` VARCHAR(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL;
}

function skill_crypt($string, $action = 'e')
{
    // you may change these values to your own
    $secret_key = 'skillbox';
    $secret_iv = 'staycreative';

    $output = false;
    $encrypt_method = 'AES-256-CBC';
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    if ($action == 'e') {
        $output = base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
    } elseif ($action == 'd') {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    return $output;
}

function getMaxSize($type = 'image')
{
    if ($type == 'video') {
        $size = '1048576000'; // 1000mb
    } elseif ($type == 'audio') {
        $size = '524288000'; //500 mb
    } elseif ($type == 'photograph') {
        $size = '524288000'; //500 mb
    } else {
        $size = '5242880'; //5 mb
    }

    return $size;
}

function getUploadPathServer($encryptedId = '', $type = 'temp')
{     
    if ($type == 'temp') {
        $path = 'temp/';
    } elseif ($type == 'backup') {
        $path = '/files/upload_file/';
    }elseif($type == 'map_image'){
        $path = $type.'/';
    }elseif(empty($encryptedId)){
        $path = $type;
    } else {
        $path = $type . '/' . $encryptedId . '/';
    }
    return $path;
}

function getValidExtension($type = 'image')
{
    if ($type == 'video') {
        $extension = array('mp4', 'flv', 'mov', 'wmv', 'mkv', 'ogg', 'flac', 'mpeg4', 'm4v', 'webm', 'f4v', 'x-ms-wmv');
    } elseif ($type == 'audio') {
        $extension = array('wav', 'mp3', 'acc', 'm4a', 'ogg', 'wma', 'flac', 'ac3', 'amr', 'mpeg', 'x-wav');
    } elseif ($type == 'document') {
        $extension = array('pdf', 'doc', 'docx', 'ppt', 'pptx');
    } elseif ($type == 'photograph') {
        $extension = array('jpeg', 'jpg', 'png');
    } else {
        $extension = array('jpeg', 'jpg', 'png', 'gif');
    }

    return $extension;
}

function getImagePath($path, $width = 100, $hight = 100, $method)
{   
   
     
    if (!empty($path)) {
        $path = ImageResize::url($path, $width, $hight, $method);
        if(!checkRemoteFile($path)){
            $path = url('resources/listing/banner-image.jpg');
        }
    } else {
        $path = url('resources/listing/banner-image.jpg');
    }

    return $path;
}

function checkRemoteFile($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_NOBODY, 1);
    curl_setopt($ch, CURLOPT_FAILONERROR, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    if (curl_exec($ch) !== false) {
        return true;
    } else {
        return false;
    }
}
?>