<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    .search{
        padding: 10px 10px;
        margin:auto;
    }
</style>
<body>
<table border="0">
    <center><form class="search" method="post" action="#">
        From: <input type="date" name="from">
        To: <input type="date" name="to">
        <input type="submit" id="search" value="Search">
    </form></center>
    <caption><h1>Danh sách khách hàng</h1></caption>
    <tr>
        <th>STT</th>
        <th>Tên</th>
        <th>Ngày sinh</th>
        <th>Địa chỉ</th>
        <th>Ảnh</th>
    </tr>
    <?php
    /**
     * Created by PhpStorm.
     * User: thang
     * Date: 7/11/17
     * Time: 10:24 AM
     */
    function searchByDate($fromdate, $todate, $customerlist){
        $cusSearch = array();
        foreach ($customerlist as $key => $values){
            $datevalues = $values["ngaysinh"];
            if($datevalues > $fromdate && $datevalues<$todate){
                array_push($cusSearch, $key);
            }
        }

        return $cusSearch;
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $fromdate = $_POST["from"];
        $todate = $_POST["to"];

        $customerList = array(
            "1" => array("ten" => "Mai Văn Hoàn",
                "ngaysinh" => "1983-08-20",
                "diachi" => "Hà Nội",
                "anh" => "images/img1.jpg"),
            "2" => array("ten" => "Nguyễn Văn Nam",
                "ngaysinh" => "1983-08-20",
                "diachi" => "Bắc Giang",
                "anh" => "images/img2.jpg"),
            "3" => array("ten" => "Nguyễn Thái Hòa",
                "ngaysinh" => "1983-08-21",
                "diachi" => "Nam Định",
                "anh" => "images/img3.jpg"),
            "4" => array("ten" => "Trần Đăng Khoa",
                "ngaysinh" => "1983-08-22",
                "diachi" => "Hà Tây",
                "anh" => "images/img4.jpg"),
            "5" => array("ten" => "Nguyễn Đình Thi",
                "ngaysinh" => "1983-08-17",
                "diachi" => "Hà Nội",
                "anh" => "images/img5.jpg")
        );

        $cusSearch = searchByDate($fromdate, $todate, $customerList);

        if($cusSearch == null){
            echo "<tr> not found ! </tr>";
        }
        else{
            foreach ($customerList as $customer => $descripton){
                echo "<tr>";
                echo "<td>" .$customer. "</td>";
                echo "<td>" .$descripton['ten'] ."</td>";
                echo "<td>" .$descripton["ngaysinh"] ."</td>";
                echo "<td>" .$descripton["diachi"] ."</td>";
                echo "<td>" .$descripton["anh"] ."</td>";
                echo "</tr>";
            }
        }
    }
    ?>
</table>
</body>
</html>
