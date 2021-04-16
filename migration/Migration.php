<?php 

require(__DIR__.'/../classes/Database.php');
class Migration
{
  private $db;
  
  public function __construct()
  {
    $this->db = new Database();
  }

  public function runMigration($migration){

      $this->db->migration($migration);
  }
}

  $mg = new Migration();
  echo "Migration running...".PHP_EOL;

  $migration = "CREATE DATABASE IF NOT EXISTS vehicles";
  $mg->runMigration($migration);


  $migration = "CREATE TABLE IF NOT EXISTS `zip_info` (
  `id` int(11) NOT NULL  AUTO_INCREMENT,
  `zip` varchar(25) DEFAULT NULL,
  `latitude` decimal(11,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
   KEY `zip` (`zip`),
  KEY `latitude` (`latitude`),
  KEY `longitude` (`longitude`),
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

  $mg->runMigration($migration);

  $migration = "CREATE TABLE IF NOT EXISTS `dealers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dealer_number` int(25) DEFAULT NULL,
  `dealer_name` varchar(100) DEFAULT NULL,
  `dealer_address_1` text,
   KEY `dealer_number` (`dealer_number`),
   KEY `dealer_name` (`dealer_name`),
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
$mg->runMigration($migration);

$migration = "CREATE TABLE IF NOT EXISTS `vehicle_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicle_live_id` int(50) DEFAULT NULL,
  `vin` varchar(100) DEFAULT NULL,
  `stock` varchar(100) DEFAULT NULL,
  `make` varchar(55) DEFAULT NULL,
  `model` varchar(50) DEFAULT NULL,
  `trim` varchar(50) DEFAULT NULL,
  `year` int(25) DEFAULT NULL,
  `amenities` text,
  `price` varchar(25) DEFAULT NULL,
  `miles` varchar(25) DEFAULT NULL,
  `exterior` varchar(100) DEFAULT NULL,
  `description` text,
  `certified` varchar(25) DEFAULT NULL,
  `transmission` varchar(25) DEFAULT NULL,
  `body_type` varchar(50) DEFAULT NULL,
  `speeds` varchar(55) DEFAULT NULL,
  `doors` varchar(55) DEFAULT NULL,
  `cylinders` varchar(55) DEFAULT NULL,
  `engine` varchar(100) DEFAULT NULL,
  `displacement` varchar(25) DEFAULT NULL,
  `zip` varchar(25) DEFAULT NULL,
  `phone` varchar(25) DEFAULT NULL,
  `imagefile` text DEFAULT NULL,
  `dealer_number` varchar(50) DEFAULT NULL,
  `Distance` varchar(25) DEFAULT NULL,
   KEY `zip` (`zip`),
   KEY `dealer_number` (`dealer_number`),
   KEY `vehicle_live_id` (`vehicle_live_id`),
   PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
$mg->runMigration($migration);
echo "Migration completed".PHP_EOL;
?>