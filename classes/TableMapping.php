<?php

/**
 * This class is used to map all csv file keys with respect to keys of tables we have in database
 */
class TableMapping 
{

	public $mapping;
	
	function get_mapping_signatures($table)
	{
	
		//Dealers table mapping
		$this->mapping['dealers'] = array(

		'dealer_number' => 0,
		'dealer_name' =>1,
		'dealer_address_1' =>2

		);

		//Zip code information table mapping
		$this->mapping['zip_info'] = array(

		'zip' => 0,
		'code' =>1,
		'latitude' =>2,
		'longitude' =>3,		
		'city' =>4,
		'state' =>5,

		);

		//Vehicle information table mapping
		$this->mapping['vehicle_info'] = array(

		'vehicle_live_id' => 0,
		'vin' =>1,
		'stock' =>2,
		'make' =>3,
		'model' =>4,
		'trim' =>5,
		'year' =>6,
		'amenities' =>7,
		'price' =>8,
		'miles' =>9,
		'exterior' =>10,
		'description' =>11,
		'certified' =>12,
		'transmission' =>13,
		'body_type' =>14,
		'speeds' =>15,
		'doors' =>16,
		'cylinders' =>17,
		'engine' =>18,
		'displacement' =>19,
		'zip' =>20,
		'phone' =>21,
		'imagefile' =>22,
		'dealer_number' =>23,
		'Distance' =>24

		);

		return $this->mapping[$table];
	}
}

?>
