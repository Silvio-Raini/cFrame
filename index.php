<?php
require_once('/xampp/htdocs/cFrame/app/classes/DB.class.php');
require_once('/xampp/htdocs/cFrame/app/classes/Validation.class.php');
require_once('/xampp/htdocs/cFrame/app/config/config.php');

$db = new DB(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$db->connect();
echo '<pre>';

$set                 = array();
$set['k.ID']         = 3;
$set['k.Vorname']    = 'Hans';
$ya = "'";
$db->join('bestellungen b', 'k.ID=b.Kunde_ID', 'LEFT');
$db->join('produkte p', 'b.Produkt_ID=p.ID', 'LEFT');
$db->where('k.ID', 3);
$result = $db->get('kunden k', null, 'k.Vorname, p.Produktname', 1);

var_dump($result);

echo '</pre>';

$validation = new Validation();
$rules = [
  'name' => [
    'required' => true,
  ]
]



























?>