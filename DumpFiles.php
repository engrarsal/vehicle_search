<?php

/* This file is use to get arguments from CLI and validate request with file names and process file accordingly
*   This file will call classes and database to read csv and dump data in to relevant tables
*/

require(__DIR__.'/classes/FileReader.php');
require(__DIR__.'/helpers/helpers.php');

 if (count($argv) == 1 || count($argv) <2) {

    echo "Please provide csv file name from dealers.csv | listings.csv | zip_info.csv";
    exit;
 }


 //WE MUST RECEIVE CSV FILE NAMEAND TABLE NAME TO READ AND DUMP DATA FOR 
$file = $argv[1];
 if(validateFiles($file)){
    if(!file_exists($file)){
        echo "file not exists!";
        exit;
    }
    
$table = getTableFromFile($file);
$reader = new FileReader('files/'.$file, $table);
$reader->getCsv();
 }else{
    echo "wrong selection";
 }

?>
