<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

$DB_DSN = 'mysql:dbname=;host=127.0.0.1';
$DB_USER = 'matcha'; //user_mysql
$DB_PASSWORD = '111111'; //password
$DB_DSNF = 'mysql:host=127.0.0.1'; //databases and host
$DB_NAME = 'credit'; //db_name

define('DB_DSN',$DB_DSN);
define('DB_USER',$DB_USER);
define('DB_PASSWORD',$DB_PASSWORD);
define('DB_DSNF',$DB_DSNF);
define('DB_NAME', $DB_NAME);

function get_url($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

try
    {
        $db = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $use_db = $db->prepare("USE `".DB_NAME."`");
        $use_db->execute();
    }
catch (PDOException $ex)
    {
        echo ("Conection error: ". $ex->getMessage() .PHP_EOL );
        $db = NULL;
    }

$get_data = function ($uri,  $table_credit, $table_rate) use ($db) {
    $datas = json_decode(get_url($uri), true);
    foreach ($datas['credits']['items'] as $credits) {
        $values = '';
        foreach ($credits as $credit) {
            $set = ($credit) ? "'" . $credit . "'" : "Null";
            $values .= ($values == '' ? '' : ', ') . $set;
        }
        $values.=",'".$table_credit."'";
        $sql = "Insert Into ".$table_credit." VALUES (" . $values . ")";
        $wait = $db->prepare($sql)->execute();
    }
    foreach ($datas['rates']['items'] as $rates) {
        $values = '';
        foreach ($rates as $rate) {
            $set = ($rate) ? "'" . $rate . "'" : "Null";
            $values .= ($values == '' ? '' : ', ') . $set;
        }
        $sql = "Insert Into ".$table_rate." VALUES (" . $values . ")";
        $wait = $db->prepare($sql)->execute();;
    }
    return;
};
    $get_data('https://hotline.finance/api/consumerloans?page=0&is_promo=0&limit=20&sum=10000&period=180&currency=2&payment=0&orderby=priority&orderdir=desc&group=0','consumers','consumer_rates');
    $get_data('https://hotline.finance/api/mortgages?page=0&is_promo=0&limit=20&sum=400000&period=720&currency=2&payment=30&orderby=priority&orderdir=desc&group=0','mortgages','mortgage_rates');
    $get_data('https://hotline.finance/api/autoloans?page=0&is_promo=0&limit=30&sum=400000&period=720&currency=2&payment=30&orderby=priority&orderdir=desc&group=0','autos','auto_rates');
    $sql = "INSERT INTO results (title, `type`, bank, uah, min_time, max_time) Select credit.title , credit.type, credit.bank, rates.uah, rates.period as min_time, rates.period as max_time From consumers as credit INNER  JOIN consumer_rates as rates ON credit.id=rates.credit";
    $sql1 = "INSERT INTO results (title, `type`, bank, uah, min_time, max_time) Select credit.title , credit.type, credit.bank, rates.uah, rates.period as min_time, rates.period as max_time From mortgages as credit INNER  JOIN mortgage_rates as rates ON credit.id=rates.credit ";
    $sql2 = "INSERT INTO results (title, `type`, bank, uah, min_time, max_time) Select credit.title , credit.type, credit.bank, rates.uah, rates.period as min_time, rates.period as max_time From autos as credit INNER  JOIN auto_rates as rates ON credit.id=rates.credit ";
    $wait = $db->prepare($sql)->execute();
    $wait1 = $db->prepare($sql1)->execute();
    $wait2 = $db->prepare($sql2)->execute();
?>