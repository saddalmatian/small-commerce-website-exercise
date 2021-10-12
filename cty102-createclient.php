<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thông tin sản phẩm</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/cty102-createclient.css" rel="stylesheet" type="text/css">
    <link href="css/fontawesome/css/all.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/fontawesome/css/all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <?php
    include 'dbconnection.php';
    ?>

    <?php
    function convertEmpty($input)
    {
        if ($input == "")
            return "NULL";
        else
            return $input;
    }
    function alert($msg)
    {
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }
    if (!isset($_POST["name"]) or !isset($_POST["phone"])) {
        echo ' <div class="content">
        <form action="cty102-createclient.php" method="POST">
            Nhập họ tên khách hàng:<input type="text" name="name" required>
            <hr>
            Nhập tên công ty:<input type="text" name="company">
            <hr>
            Nhập số FAX:<input type="number" name="FAX">
            <hr>
            Nhập số điện thoại khách hàng:<input type="number" name="phone" required>
            <hr>
            Nhập địa chỉ khách hàng:<input type="text" name="address">
            <hr>
            <input type="submit" value="Hoàn thành">
        </form>
    </div>';
    } else {
        $sql = "SELECT SoDienThoai from KhachHang where SoDienThoai=\"" . $_POST["phone"] . "\"";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            alert("Số điện thoại này đã được đăng ký !");
            echo '<div class="content">
            <form action="cty102-createclient.php" method="POST">
                Nhập họ tên khách hàng:<input type="text" name="name" required value="' . $_POST["name"] . '">
                <hr>
                Nhập tên công ty:<input type="text" name="company" value="' . $_POST["company"] . '">
                <hr>
                Nhập số FAX:<input type="number" name="FAX" value="' . $_POST["FAX"] . '">
                <hr>
                Nhập số điện thoại khách hàng:<input type="number" name="phone" required>
                <hr>
                Nhập địa chỉ khách hàng:<input type="text" name="address" required value="' . $_POST["address"] . '">
                <hr>
                <input type="submit" value="Hoàn thành">
            </form>
        </div>';
        } else {
            $sql = "SELECT MSKH from KhachHang  ";
            $result = $conn->query($sql);
            $count = 1;

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {
                    $count += 1;
                }
                $MSKH = "KH" . strval($count);
                $sql = "INSERT INTO KhachHang (MSKH, HoTenKH, TenCongTy, SoDienThoai, SoFax)
                VALUES ('" . $MSKH . "','" . $_POST["name"] . "'," . convertEmpty($_POST["FAX"]) . ",'" . $_POST["phone"] . "'," . convertEmpty($_POST["FAX"]) . ")";

                if ($conn->query($sql) === TRUE) {

                    $sql1 = "SELECT * from diachikh where MSKH=\"" . $MSKH . "\"";
                    $result1 = $conn->query($sql1);
                    $MaDC = $MSKH . "DC1";
                    $sql = "INSERT INTO DiaChiKH
                    VALUES('" . $MaDC . "','" . $_POST['address'] . "','" . $MSKH . "')";
                    if ($conn->query($sql) === TRUE) {
                        alert("Thành công");                       
                    }
                } else {
                    alert($conn->error);
                    echo ' <div class="content">
                    <form action="cty102-createclient.php" method="POST">
                        Nhập họ tên khách hàng:<input type="text" name="name" required>
                        <hr>
                        Nhập tên công ty:<input type="text" name="company">
                        <hr>
                        Nhập số FAX:<input type="number" name="FAX">
                        <hr>
                        Nhập số điện thoại khách hàng:<input type="number" name="phone" required>
                        <hr>
                        Nhập địa chỉ khách hàng:<input type="text" name="address">
                        <hr>
                        <input type="submit" value="Hoàn thành">
                    </form>
                </div>';
                }
            }
        }
    }

    ?>



</body>

</html>