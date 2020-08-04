<?php
session_start();
require_once("LineLoginLib.php");
 
// กรณีต้องการตรวจสอบการแจ้ง error ให้เปิด 3 บรรทัดล่างนี้ให้ทำงาน กรณีไม่ ให้ comment ปิดไป
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 
// กรณีมีการเชื่อมต่อกับฐานข้อมูล
//require_once("dbconnect.php");
 
/// ส่วนการกำหนดค่านี้สามารถทำเป็นไฟล์ include แทนได้
define('LINE_LOGIN_CHANNEL_ID','1654566118');
define('LINE_LOGIN_CHANNEL_SECRET','9727dc1c160c724390c648c7710f2a8c');
define('LINE_LOGIN_CALLBACK_URL','https://line-inac.herokuapp.com/login_uselib_callback.php');
 
$LineLogin = new LineLoginLib(
    LINE_LOGIN_CHANNEL_ID, LINE_LOGIN_CHANNEL_SECRET, LINE_LOGIN_CALLBACK_URL);
     
if(!isset($_SESSION['ses_login_accToken_val'])){    
    $LineLogin->authorize(); 
    exit;
}
 
$accToken = $_SESSION['ses_login_accToken_val'];
// Status Token Check
if($LineLogin->verifyToken($accToken)){
    echo $accToken."<br><hr>";
    echo "Token Status OK <br>";  
}
 
 
echo "<pre>";
// Status Token Check with Result 
//$statusToken = $LineLogin->verifyToken($accToken, true);
//print_r($statusToken);
 
 
//////////////////////////
echo "<hr>";
// GET LINE USERID FROM USER PROFILE
//$userID = $LineLogin->userProfile($accToken);
//echo $userID;
 
//////////////////////////
echo "<hr>";
// GET LINE USER PROFILE 
$userInfo = $LineLogin->userProfile($accToken,true);
if(!is_null($userInfo) && is_array($userInfo) && array_key_exists('userId',$userInfo)){
    print_r($userInfo);
}
 
//exit;
echo "<hr>";
 
if(isset($_SESSION['ses_login_userData_val']) && $_SESSION['ses_login_userData_val']!=""){
    // GET USER DATA FROM ID TOKEN
    $lineUserData = json_decode($_SESSION['ses_login_userData_val'],true);
    // print_r($lineUserData); 
    // connect DB
    $con= mysqli_connect("203.150.202.108","root","Icon@2020","cm_uat") or die("Error: " . mysqli_error($con));
    mysqli_query($con, "SET NAMES 'utf8' ");

    //2. query ข้อมูลจากตาราง: 
    $query = "SELECT * FROM company ORDER BY company_id asc" or die("Error:" . mysqli_error()); 
    //3. execute the query. 
    $result = mysqli_query($con, $query); 
    //4 . แสดงข้อมูลที่ query ออกมา: 
    
    //ใช้ตารางในการจัดข้อมูล
    // echo "<table border='1' align='center' width='500'>";
    //หัวข้อตาราง
    // echo "<tr align='center' bgcolor='#CCCCCC'><td>รหัส</td><td>Uername</td><td>ชื่อ</td><td>นามสกุล</td><td>อีเมล์</td><td>แก้ไข</td><td>ลบ</td></tr>";
    echo "<select>";
    while($row = mysqli_fetch_array($result)) { 
        echo "<option value=".$row["compcode"].">".$row["company_name"] ."</option>";
    // // echo "<tr>";
    // echo "<td>" .$row["compcode"] .  "</td> "; 
    // echo "<td>" .$row["company_name"] .  "</td> ";  
    // //แก้ไขข้อมูลส่่ง member_id ที่จะแก้ไขไปที่ฟอร์ม
    // echo "<td><a href='userupdateform.php?compcode=$row[0]'>edit</a></td> ";
    
    // //ลบข้อมูล
    // echo "<td><a href='UserDelete.php?compcode=$row[0]' onclick=\"return confirm('Do you want to delete this record? !!!')\">del</a></td> ";
    // // echo "</tr>";
    }
    
    echo "</select>";
    // echo "</table>";
    //5. close connection
    mysqli_close($con);
    // Close DB
    echo "<hr>";
    echo "Line UserID: ".$lineUserData['sub']."<br>";
    echo "Line Display Name: ".$lineUserData['name']."<br>";
    echo '<img style="width:100px;" src="'.$lineUserData['picture'].'" /><br>';
}
 
 
echo "<hr>";
if(isset($_SESSION['ses_login_refreshToken_val']) && $_SESSION['ses_login_refreshToken_val']!=""){
    echo '
    <form method="post">
    <button type="submit" name="refreshToken">Refresh Access Token</button>
    </form>   
    ';  
}
if(isset($_SESSION['ses_login_refreshToken_val']) && $_SESSION['ses_login_refreshToken_val']!=""){
    if(isset($_POST['refreshToken'])){
        $refreshToken = $_SESSION['ses_login_refreshToken_val'];
        $new_accToken = $LineLogin->refreshToken($refreshToken); 
        if(isset($new_accToken) && is_string($new_accToken)){
            $_SESSION['ses_login_accToken_val'] = $new_accToken;
        }       
        $LineLogin->redirect("line_uselib.php");
    }
}
// Revoke Token
//if($LineLogin->revokeToken($accToken)){
//  echo "Logout Line Success<br>";   
//}
//
// Revoke Token with Result
//$statusRevoke = $LineLogin->revokeToken($accToken, true);
//print_r($statusRevoke);
?>
<?php
echo "<hr>";
if($LineLogin->verifyToken($accToken)){
?>
<form method="post">
<button type="submit" name="lineLogout">LINE Logout</button>
</form>
<?php }else{ ?>
<form method="post">
<button type="submit" name="lineLogin">LINE Login</button>
</form>   
<?php } ?>
<?php
if(isset($_POST['lineLogin'])){
    $LineLogin->authorize(); 
    exit;   
}
if(isset($_POST['lineLogout'])){
    unset(
        $_SESSION['ses_login_accToken_val'],
        $_SESSION['ses_login_refreshToken_val'],
        $_SESSION['ses_login_userData_val']
    );  
    echo "<hr>";
    if($LineLogin->revokeToken($accToken)){
        echo "Logout Line Success<br>";   
    }
    echo '
    <form method="post">
    <button type="submit" name="lineLogin">LINE Login</button>
    </form>   
    ';
    $LineLogin->redirect("line_uselib.php");
}
?>