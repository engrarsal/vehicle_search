Migrations

Run cron php migration/Migration.php
This cron will run all tables migrations and create schema for dealers, zip_info, vehicle_info
This will create indexing 
zip, latitude, longitude in zip_info table.
zip, dealer_number in vehicle_info table.
dealer_number in dealers table.

Read files

Run cron php DumpFiles.php
please choose filename between dealers.csv | listings.csv | zip_info.csv as i have saved these files in files directory
User will show validation if no file is selected or wrong selected

Reader will read all data row by row from dealers.csv and dump into the dealers table.
Reader will read all data row by row from listings.csv and dump into the vehicle_info table.
Reader will read all data row by row from zip_info.csv and dump into the zip_info table.

* installed screen on centos to perform this activity as we are reading complete file in one go

Now we have all inventory we can search vehicles from user interface

User interface

By default user interface will show on root directory http://interviewcandidatea4.vinaudit.com

There are two fields, an input for zip code and dropdown with two distances 50 and 100 miles

user will enter any zip code and distance then first we will fetch latitude and longitude from zip_info based on given zip code
we will get all the zip codes ranging in given distance (let's say 50 miles) and combine tables with below relation

zip_infor will combine vehicle_info based on all matching zip codes in a given distance range
vehicle_info will combine dealers based on dealer_number for above zip codes matched

there is a join in all above three tables to get data and show data into data tables in user interface.

Data tables have options for sorting, pagination, search (built in functionality ).

Here is sample actions to perform

1. php migration/Migration.php 
2. php DumpFiles.php dealers.csv
2. php DumpFiles.php listings.csv
2. php DumpFiles.php zip_info.csv

go to browser and hit http://interviewcandidatea4.vinaudit.com

Test cases

1. keep input zip field as empty
select distance by default its 50 miles 100 miles
hit search button
it should return Please enter valid zip code and distance! validation error


2. input zip any dummy number like 12345
select distance by default its 50 miles or 100 miles
hit search button
it should return Zip code that does not exist validation error because we don't have such zip code information in our zip_info table


3.input zip (any zip code let's say 85705
select distance by default its 50 miles
hit search button
Output will show in data table below the search form if there is any data matched otherwise no data found 

NOTE: I have run migration and dump files cron so if you will run again that crons then no effect on migration and data will start to update against each row in all tables.