<?php
$nameErr ="";
$phoneErr = "";
$emailErr = "";
/**
 * Created by PhpStorm.
 * User: thang
 * Date: 7/12/17
 * Time: 4:11 PM
 */
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $flag = true;
    if(empty($name)){
        $nameErr = "Tên đăng nhập không được để trống";
        $flag = false;
    }
    if(empty($phone)){
        $phoneErr = "Số điện thoại không được để trống";
        $flag = false;
    }
    if(empty($email)){
        $emailErr = "Email không được để trống";
        $flag = false;
    } else {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $emailErr = "Email không đúng định dạng (xxx@xxx.xxx.xxx)";
            $flag = false;
        }
    }

    if($flag == true){
        if(saveDataJSON("users.json", $name, $email, $phone)){
            echo "save successfull!";
        }
        else{
            echo "fail!!";
        }
    }
}

function saveDataJSON($filename, $name, $email, $phone){
    try{
        $contact= array(
                'name' => $name,
                'email' => $email,
                'phone' => $phone
        );
        $jsondata = file_get_contents($filename);
        $arr_data = json_decode($jsondata, true);
        array_push($arr_data, $contact);
        $jsondata = json_encode($arr_data, JSON_PRETTY_PRINT);
        file_put_contents($filename, $jsondata);
//        foreach ($arr_data as $value){
//            echo $value['name'];
//            echo $value['email'];
//            echo $value['phone'];
//        }
        return true;
    }catch(Exception $e){
        echo "Lỗi: " , $e->getMessage(), "\n";
        return false;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>.error {color: #FF0000;}</style>
</head>
<body>
<h2>Registration</h2>
<p><span class="error">* required field.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Name: <input type="text" name="name">
    <span class="error">* <?php echo $nameErr;?></span>
    <br><br>
    E-mail: <input type="text" name="email">
    <span class="error">* <?php echo $emailErr;?></span>
    <br><br>
    Phone: <input type="text" name="phone">
    <span class="error">*<?php echo $phoneErr;?></span>
    <br><br>
    <input type="submit" name="submit" value="Submit">
</form>
</body>
</html>
