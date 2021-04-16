<?php

require(__DIR__.'/Mapping.php');
require(__DIR__.'/Database.php');

class FileReader {

    private $file; 
    public $db;
    private $table;
    const ZIP_INFO = 'zip_info';

    public function __construct($filename, $table) {
        $this->file = $filename;
        $this->db = new Database();
        $this->table = $table;
    }

    public function getCsv() {

        $csv = [];
        //We don't have heading for zip csv so we are not skipping first row
        $skip = true;
        if($this->table ==self::ZIP_INFO){
            $skip = false;
        }
        $mapping = new Mapping($this->table);

        if (($handle = fopen($this->file, "r")) !== FALSE) {         
            while (($data = fgetcsv($handle)) !== FALSE) {
               if($skip) { $skip = false; continue; }
                $map_data = $mapping->getMapping($data);
                $this->saveData($map_data);  
                unset($map_data); 
                unset($data);         
                 }
            fclose($handle);
        }


        return $csv;
    } 

    private function saveData($map_data ){
                $tableKey = getTableKey($this->table);
                $condition=$tableKey." = ".$map_data[$tableKey];
                echo "saving record ".$tableKey." = ".$map_data[$tableKey].PHP_EOL;               
                $result =  $this->db->update_insert($this->table, "id", $condition, $map_data);
    }

}
?>
