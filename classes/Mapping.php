<?php
require(__DIR__.'/TableMapping.php');

class Mapping extends TableMapping{

    private $table;
    public $record; 

    public function __construct($table) {
        $this->table = $table;
    }

    //Get data from csv and map it according to its keys
    public function getMapping($data){
        
        $mapping = $this->get_mapping_signatures($this->table);
        foreach($mapping as $key => $value){
            $this->record[$key] = isset($data[$value]) ? $data[$value] : '';
        }
        return $this->record;
    }

}
?>
