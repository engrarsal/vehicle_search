<?php
require(__DIR__.'/Database.php');


class Vehicle{

    private $zip;
    private $distance; 
    private $latitude;
    private $longitude;
    public $listings;
    private $db;

    public function __construct($zip, $distance) {
        $this->zip = $zip;
        $this->distance = $distance;
        $this->db = new Database();
    }

    //This method will get the latitude and longitude from a given zip code
    public function getCoordinates(){
        $result = $this->db->getCoordinatesByZip($this->zip);
        if(empty($result)){
            return false;
            exit;
        }
        $this->setCoordinates($result['latitude'], $result['longitude']);
        return true;
    }

    //Set latitude and longitude in class properties so it can be get anywhere in the vehicle class
    public function setCoordinates($latitude, $longitude){
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    //Listings based on tables invovled to get all zip in a given distance in miles and relative tables data will get back to user interface
    public function getListings(){
        $this->listings = $this->db->listings($this->latitude, $this->longitude, $this->zip, $this->distance);
        return $this->listings;
    }

}
?>
