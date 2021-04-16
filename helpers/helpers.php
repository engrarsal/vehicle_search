<?php

//This function will take file name as params and validate it
function validateFiles($name){
	
	$files = ["dealers.csv", "listings.csv", "zip_info.csv"];
	if(in_array($name, $files)){
		return true;
	}
}

//This function will take file name as param and return table name that need to map with csv
function getTableFromFile($name){
	
	$files = ["dealers.csv" => "dealers", "listings.csv" => "vehicle_info", "zip_info.csv"=>"zip_info"];
	return $files[$name];
}

//This function will take table name and returns key that we need to check if data already exists in table for updation or insertion
function getTableKey($table){
	
	$files = ["dealers" => "dealer_number", "vehicle_info" => "vehicle_live_id", "zip_info"=>"zip"];
	return $files[$table];
}

//This function is used to skip special characters to insert in mysql table
function filterData($conn, $data){

	if(isset($data['description'])){
          $data['description'] = mysqli_real_escape_string($conn,$data['description']);
        } 
        if(isset($data['dealer_name'])){
          $data['dealer_name'] = mysqli_real_escape_string($conn,$data['dealer_name']);
        } 
        if(isset($data['dealer_address_1'])){
          $data['dealer_address_1'] = mysqli_real_escape_string($conn,$data['dealer_address_1']);
        } 
        return $data;
}
?>
