<?php

$connection = pg_connect("host=ec2-54-204-39-43.compute-1.amazonaws.com port=5432 dbname=d81dleaen1vbni user=drdiyyyftejdwq password=8db03c903e0b77bb659a7e91e908f404e7346fc4fb304d33306faf483269df53");  
 if(!$connection) {
     die("Database connection failed");
 }
 ?>
