
<?php
include('connect.php');
echo $_GET['comp_code'];
$sql = "select * from member WHERE compcode=".$_GET['comp_code'];
$query = mysqli_query($conn, $sql);
 
$json = array();
while($result = mysqli_fetch_assoc($query)) {    
    array_push($json, $result);
}
echo json_encode($json);
?>