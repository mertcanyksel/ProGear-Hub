<?php 
$db_host = "db";
$db_user = "mariadb";   /*if we use root ,it should cause some vulnerabilities so we open the db and user management and we gave some responsibilities for mariadb*/
$db_password = "mariadb";
$db_name = "progear_hub";

$connection = mysqli_connect($db_host,$db_user,$db_password,$db_name);

if(!$connection) {
    echo "connection failed";
    die();
}
?>