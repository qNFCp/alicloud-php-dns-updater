<?php

date_default_timezone_set('UTC');

include_once 'alicloud-php-updaterecord/V20150109/AlicloudUpdateRecord.php';

use Roura\Alicloud\V20150109\AlicloudUpdateRecord;

//HTTP GET
function get_url($url)
{
    $curlget = curl_init();
    curl_setopt($curlget, CURLOPT_URL,$url);  //Set the url address for access
    curl_setopt($curlget, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curlget, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curlget, CURLOPT_RETURNTRANSFER,1);//No output
    $result = curl_exec($curlget);
    curl_close ($curlget);
    return $result;
}
//GET END

$AccessKeyId     = 'ACCESS_KEY_ID'; //Edit here
$AccessKeySecret = 'ACCESS_KEY_SECRET'; //Edit here
$updater         = new AlicloudUpdateRecord($AccessKeyId, $AccessKeySecret);

//$newIp = $_SERVER['REMOTE_ADDR']; // Upload client IP address
$newIp = get_url('https://v6.ipv6-test.com/api/myip.php'); // Upload server-side IPv6 address
//$newIp = get_url('https://v4.ipv6-test.com/api/myip.php'); // Upload server-side IPv4 address

$updater->setDomainName('DOMAIN.COM');
//$updater->setRecordType('A');
$updater->setRecordType('AAAA');
$updater->setRR('@');
$updater->setValue($newIp);

print_r($updater->sendRequest());
