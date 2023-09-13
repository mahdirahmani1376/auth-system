<?php
require __DIR__.'/../../../vendor/autoload.php';

$sender = "1000689696";
$receptor = "09194997769";
$message = ".وب سرویس پیام کوتاه کاوه نگار";
$api = new \Kavenegar\KavenegarApi("777050506244797576416C5344762B5A43362B56426D4F75694955464A33543939706868426E39553971553D");
$api->Send($sender,$receptor,$message);
