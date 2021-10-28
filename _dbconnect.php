<?php
$con=mysqli_connect("localhost", "root","", "mycanteen");
//where localhost is the server, root is the user, password is blank and 
//mycanteen is the database name
if(mysqli_connect_errno()){
echo "Connection Fail ".mysqli_connect_error();
}
?>