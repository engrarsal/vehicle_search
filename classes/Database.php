<?php   
 

 class Database{  
      private $con;  
      public $error; 
      const ZIP_TABLE = "zip_info";
      const DEALERS_TABLE = "dealers";
      const VEHICLE_INFO = "vehicle_info";
      const DB = "vehicles";
      const HOST = "localhost";
      const USER = "root";
      const PASSWORD = "Interview2021!";


      public function __construct()  
      {  
           $this->con = new mysqli(self::HOST, self::USER, self::PASSWORD, self::DB);  
           if(!$this->con)  
           {  
                echo 'Database Connection Error ' . mysqli_connect_error($this->con); 
                exit('please solve error before continue!'); 
           }else{
           	//Database successfully connected
           } 
      }

      /*
      * This method will get data from tables based on condition and check if data already exists
      * if data already exist it will call update mthod otherwise insert method
      */
      public function update_insert($table,  $select = "*", $condition, $data){

			$query = "SELECT {$select}  from {$table} where {$condition} ";			
			if ($result = $this->con->query($query)) {
				if($result->num_rows > 0){
					$this->update($table, $condition, $data);
				}else{
					$this->insert($table, $data);
				}

			}

      }

      /*
      * A generic  method, it will get array and convert it into mysql insert statement form
      */
      public function insert($table_name, $data)  
      {  
        //Description contains some special characters like oppose trophy so removing it        
        
           $data = filterData($this->con, $data);
           $string = "INSERT INTO ".$table_name." (";            
           $string .= implode(",", array_keys($data)) . ') VALUES (';            
           $string .= "'" . implode("','", array_values($data)) . "')"; 
           if(mysqli_query($this->con, $string))  
           {  
                return true;
           }  
           else  
           { 
                  //Need to display error here 
                  //echo("Error description: " . $this->con-> error);
            return false;
           }  
      } 

      /*
      * A generic  method, it will get array and convert it into mysql update statement form
      */
      public function update($table_name, $condition, $data){

      	foreach ($data as $key => $value) {      		
                
                $value = "'$value'";
                $updates[] = "$key =".$value;
            }
    
        	  $implodeArray = implode(',', $updates);
       
		        $query = ("UPDATE ".$table_name." WHERE {$condition} SET $implodeArray ");

		        $this->con->query($query);
      } 

      /*
      * This method will get zip as param and return its latitude and longitude
      */
      public function getCoordinatesByZip($zip){

        $query = "SELECT latitude,longitude  from ".self::ZIP_TABLE." where zip = {$zip} ";
        $result = $this->con->query($query);
        $result = $result->fetch_all(MYSQLI_ASSOC);
        //We need single row here
        if(!empty($result)){
           $result = $result[0];
           return $result;
         }else{
          return [];
         }
       
        
      }

      /*
      * This method will get all zip codes that are in a given distance range and will get zip codes and join the other tables
      e.g vehicle and dealers to combine the results 
      */
      public function listings($latitude, $longitude, $zip, $distance){

        $query = "SELECT z.zip, z.state, z.city, v.make, v.model, v.year, v.price, v.vehicle_live_id,d.dealer_name, ( 3959 * acos( cos( radians(".$latitude.") ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(".$longitude.") ) + sin( radians(".$latitude.") ) * sin( radians( latitude ) ) ) ) AS distance from zip_info as z INNER JOIN vehicle_info as v ON z.zip = v.zip LEFT JOIN dealers as d ON v.dealer_number = d.dealer_number having distance <{$distance} ORDER BY distance asc";

        $result = $this->con->query($query);
        $result = $result->fetch_all(MYSQLI_ASSOC);
        return $result;
      }

      public function migration($query){
        $result = $this->con->query($query);

      }
 }  
 ?>  