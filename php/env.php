<?php

function get_url_contents($url){
	$crl = curl_init();
	$timeout = 5;
// 	curl_setopt($crl, CURLOPT_PROXY, "http://out.com:3128"); // Если сервер идет через прокси
	curl_setopt($crl, CURLOPT_URL,$url);
	curl_setopt($crl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($crl, CURLOPT_CONNECTTIMEOUT, $timeout);
	$ret = curl_exec($crl);
	curl_close($crl);
	return $ret;
}

function get_url_json_contents($url){
	$strParts = get_url_contents($url);
	$arParts = json_decode($strParts, true);
    return $arParts;
}

// Для контрактных запчастей
function get_UsedPartInfo($id, $type){
	$arParts=false;
	if($type=='id'){
		$arParts = get_url_json_contents("https://bibinet.ru/service/search/used_parts?ver_api=v3&ver2=1&format=json&onerow&id=".$id);
	}else{
		$arParts = get_url_json_contents("https://bibinet.ru/service/search/used_parts?ver_api=v3&ver2=1&format=json&onerow&invnn=".$id);
	}
    return $arParts;
}
// Для новых запчастей
function get_NewPartInfo($id, $type){
	$arParts=false;
	if($type=='id'){
		$arParts = get_url_json_contents("https://bibinet.ru/service/search/new_parts_v1?ver_api=v3&onerow&id=".$id);
	}else{
		$arParts = get_url_json_contents("https://bibinet.ru/service/search/new_parts_v1?ver_api=v3&onerow&invnn=".$id);
	}
    return $arParts;
}

// Для шин
function get_TiresInfo($id, $type){
    $arParts=false;
    if($type=='id'){
        $arParts = get_url_json_contents("https://bibinet.ru/service/search/tires?ver_api=v3&id=".$id);
    }else{
        $arParts = get_url_json_contents("https://bibinet.ru/service/search/tires?ver_api=v3&invnn=".$id);
    }
    return $arParts;
}

// Для дисков
function get_WheelsInfo($id, $type){
    $arParts=false;
    if($type=='id'){
        $arParts = get_url_json_contents("https://bibinet.ru/service/search/wheels?ver_api=v3&id=".$id);
    }else{
        $arParts = get_url_json_contents("https://bibinet.ru/service/search/wheels?ver_api=v3&invnn=".$id);
    }
    return $arParts;
}
?>
