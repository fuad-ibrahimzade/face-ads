<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomAnalyticsInfo extends Model
{
    //
//'visited_page_link', 'user_ip', 'country', 'http_referer','ip_data'
    protected $fillable = [
        'analytics_type', 'analytics_data'
    ];
//'ip_data' => 'array',
    protected $casts = [
        'analytics_data' => 'array'
    ];

    public function distinct_columns(){
//        return $this->select('analytics_type')->distinct()->get();
        return 'aaaaa';
    }

    public static function get_location(){
        $apiKey_ipgeolocationio = "fb27303e07bf4eb4ac60e3bbc7c2885a";
//        $ip = "CLIENT_IP_ADDRESS";
        $ip=(string)CustomAnalyticsInfo::get_client_ip_env();
//        print_r($ip);
//        exit;
        if($ip=='::1')$ip='5.197.246.25';//az kompumun ipsi

        $location = CustomAnalyticsInfo::get_geolocation($apiKey_ipgeolocationio, $ip);
//        $decodedLocation = json_decode($location, true);
        $decodedLocation = json_decode($location);
//        echo "<pre>";
//        print_r($decodedLocation);
//        echo "</pre>";

        return $decodedLocation;
    }

    protected static function get_geolocation($apiKey=null, $ip, $lang = "en", $fields = "*", $excludes = "") {
        $url = "https://api.ipgeolocation.io/ipgeo?apiKey=".$apiKey."&ip=".$ip."&lang=".$lang."&fields=".$fields."&excludes=".$excludes;

        $url = 'http://ip-api.com/json/'.$ip;
        $url = 'http://ip-api.com/json/'.$ip.'?fields=8450047';
        $cURL = curl_init();

        curl_setopt($cURL, CURLOPT_URL, $url);
        curl_setopt($cURL, CURLOPT_HTTPGET, true);
        curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cURL, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Accept: application/json'
        ));
        return curl_exec($cURL);
    }

    protected static function get_client_ip_env() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    protected static function get_client_ip_serv() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
}
