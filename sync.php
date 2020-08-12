
<?php
include('connect.php');
$memberID =  $_GET['memberID'];
$userID =  $_GET['userID'];
$sql = "update member set lineid = '".$_GET['userID']."' WHERE m_code='".$_GET['memberID']."'";
$query = mysqli_query($conn, $sql);
mysqli_close($conn);
// $json = array();
// while($result = mysqli_fetch_assoc($query)) {    
//     array_push($json, $result);
// }
// echo json_encode($json);
?>