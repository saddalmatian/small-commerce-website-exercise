<?php
include "../config/dbconnection.php";
firstStep();
function UnsetAll()
{
    unset($_POST["name"]);
    unset($_POST["phone"]);
    unset($_POST["company"]);
    unset($_POST["FAX"]);
    unset($_POST["add1"]);
    unset($_POST["add2"]);
    unset($_POST["add3"]);
}
if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']))
    header("location:../main.php");
else {
    if ($_POST["action"] == "clientAdd") {
        if ($_POST["name"] == "" && $_POST["phone"] == "") {

            echo 1;
            UnsetAll();
            return;
        } else
    if ($_POST["name"] == "") {

            echo 2;
            UnsetAll();
            return;
        } else
    if ($_POST["phone"] == "") {

            echo 3;
            UnsetAll();
            return;
        } else
    if ($_POST["add1"] == "" && $_POST["add2"] == "" && $_POST["add3"] == "") {

            echo 4;
            UnsetAll();
        } else {
            $sql = 'SELECT MSKH FROM KHACHHANG';
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $count = 1;
                while ($row = $result->fetch_assoc()) {
                    $count += 1;
                }
                $MSKH = "KH" . $count;
            }
            if ($_POST["company"] == "")
                $_POST["company"] = 'null';
            else
                $_POST["company"] = "\"" . $_POST["company"] . "\"";

            if ($_POST["FAX"] == "")
                $_POST["FAX"] = 'null';
            else
                $_POST["FAX"] = "\"" . $_POST["FAX"] . "\"";
            $sql = 'INSERT INTO KHACHHANG VALUES("' . $MSKH . '","' . $_POST["name"] . '",' . $_POST["company"] . ',"' . $_POST["phone"] . '",' . $_POST["FAX"] . ',"' . $_POST["pass"] . '");';

            if ($conn->query($sql) === TRUE) {
                $addCount = 0;
                if ($_POST["add1"] != "")
                    $addCount += 1;
                if ($_POST["add2"] != "")
                    $addCount += 1;
                if ($_POST["add3"] != "")
                    $addCount += 1;
                for ($i = 1; $i <= $addCount; $i++) {
                    $sql1 = 'INSERT INTO DIACHIKH VALUES("' . $MSKH . 'DC' . $i . '","' . $_POST["add" . $i . ""] . '","' . $MSKH . '");';
                    echo $sql1;
                    if ($conn->query($sql1) === FALSE) {
                        echo 7;
                        UnsetAll();
                        return;
                    }
                }
                echo 5;
            } else {

                echo $sql;
                echo 6;
                UnsetAll();
            }
        }
    } else if ($_POST["action"] == "addCart") {
        if (!isset($_SESSION["cartList"])) {
            $_SESSION["cartList"] = [];
        }
        if (!array_key_exists($_POST["productID"], $_SESSION["cartList"])) {
            $_SESSION["cartList"][$_POST["productID"]] = 1;
            echo '2';
        } else
            echo '1';
    } else if ($_POST["action"] == "removeFromCart") {
        unset($_SESSION["cartList"][$_POST["prodID"]]);
        echo '1';
    } else if ($_POST["action"] == "checkCart") {
        $sentDate = $_POST["currentDate"];
        $takeDate = date('Y-m-d', strtotime($sentDate . ' + 3 days'));
        $sql = "SELECT * FROM DATHANG WHERE MSKH=\"" . $_SESSION["iduser"] . "\"";
        $result = $conn->query($sql);
        $count = 1;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc())
                $count += 1;
        } else
            $count = 1;
        $MSDH = "DH" . $count . $_SESSION["iduser"];
        $TT = "Chưa xác nhận";
        $sql = 'INSERT INTO DATHANG VALUES(\'' . $MSDH . '\',\'' . $_SESSION['iduser'] . '\',NULL,\'' . $sentDate . '\',\'' . $takeDate . '\',\'' . $TT . '\',"' . $_POST["address"] . '")';
        if ($conn->query($sql)) {
            foreach ($_SESSION["cartList"] as $item => $quantity) {
                $sql1 = 'SELECT Gia FROM HANGHOA WHERE MSHH="' . $item . '";';

                $result = $conn->query($sql1);
                $row = $result->fetch_assoc();
                $total = $row["Gia"] * $quantity;

                $sql2 = 'INSERT INTO ChiTietDatHang VALUES("' . $MSDH . '","' . $item . '","' . $quantity . '","' . $total . '","0")';
                $sql4 = "SELECT SoLuongHang From Hanghoa where MSHH='" . $item . "' ;";
                $result4 = $conn->query($sql4);
                $row4 = $result4->fetch_assoc();
                $slht = $row4["SoLuongHang"] - $quantity;
                $sql3 = 'UPDATE HANGHOA SET SoLuongHang=' . $slht . ' WHERE MSHH="' . $item . '";';

                if (!$conn->query($sql2) || !$conn->query($sql3)) {
                    echo 3;
                    return;
                }
            }
            unset($_SESSION["cartList"]);
            $_SESSION["show"] = "personal";
            echo 2;
        } else echo $sql;
    } else if ($_POST["action"] == "updateQuantity") {
        $_SESSION["cartList"][$_POST["prodID"]] = $_POST["quantity"];
    } else if ($_POST["action"] == "logout") {
        session_destroy();
    } else if ($_POST["action"] == "confirmReceipt") {
        $sql = "UPDATE DATHANG SET TrangThaiDH='Đã xác nhận', MSNV='" . $_SESSION["iduser"] . "' WHERE SoDonDH='" . $_POST["id"] . "';";
        if ($conn->query($sql))
            echo 1;
        else echo 2;
    } else if ($_POST["action"] == "delProd") {
        $sql = "DELETE FROM HANGHOA WHERE MSHH='" . $_POST["productID"] . "';";
        $sql1 = "SELECT mahinh FROM HINHHANGHOA WHERE MSHH='" . $_POST["productID"] . "';";
        $result = $conn->query($sql1);
        $row = $result->fetch_assoc();
        if ($conn->query($sql)) {

            if (file_exists("../imgs/" . $row["mahinh"])) {
                unlink("../imgs/" . $row["mahinh"]);
                echo 1;
            }
        } else echo 2;
    } else if ($_POST["action"] == "upProd") {
        $sql = "UPDATE HANGHOA SET TenHH='" . $_POST["name"] . "', Gia='" . $_POST["price"] . "',QuyCach='" . $_POST["qualify"] . "'  WHERE MSHH='" . $_POST["productID"] . "';";
        if ($conn->query($sql)) {
            echo 1;
        } else echo 2;
    } else if ($_POST["action"] == "upClients") {
        $sdt = $_POST["sdt"];
        $pass = $_POST["pass"];
        $company = $_POST["company"];
        $fax = $_POST["fax"];
        $address = $_POST["address"];
        $sql1 = "select SoDienThoai from khachhang where mskh='" . $_SESSION["iduser"] . "';";
        $result = $conn->query($sql1);
        $row = $result->fetch_assoc();
        if (!$row["SoDienThoai"] == $sdt) {

            $sql = "UPDATE KHACHHANG SET SoDienThoai='" . $sdt . "',Pass='" . $pass . "',TenCongTy='" . $company . "',SoFax='" . $fax . "';";
            if ($conn->query($sql)) {
                $count = 1;
                $sql1 = "select * from DiaChiKH where mskh='" . $_SESSION["iduser"] . "';";
                $result = $conn->query($sql1);
                if ($address == "")
                    echo 1;
                else {
                    $sql1 = "select * from DiaChiKH where mskh='" . $_SESSION["iduser"] . "';";
                    $result = $conn->query($sql1);
                    while ($row = $result->fetch_assoc()) {
                        $count += 1;
                    }
                    $MADC = $_SESSION["iduser"] . "DC" . $count;
                    $sql1 = "INSERT INTO DIACHIKH VALUES('" . $MADC . "','" . $address . "','" . $_SESSION["iduser"] . "');";
                    if ($conn->query($sql1))
                        echo 1;
                    else echo $conn->error;
                }
            } else echo $conn->error;
        } else {
            $sql = "UPDATE KHACHHANG SET Pass='" . $pass . "',TenCongTy='" . $company . "',SoFax='" . $fax . "' WHERE MSKH='" . $_SESSION["iduser"] . "';";
            if ($conn->query($sql)) {
                $count = 1;
                if ($address == "")
                    echo 1;
                else {
                    $sql1 = "select * from DiaChiKH where mskh='" . $_SESSION["iduser"] . "';";
                    $result = $conn->query($sql1);
                    while ($row = $result->fetch_assoc()) {
                        $count += 1;
                    }
                    $MADC = $_SESSION["iduser"] . "DC" . $count;
                    $sql1 = "INSERT INTO DIACHIKH VALUES('" . $MADC . "','" . $address . "','" . $_SESSION["iduser"] . "');";
                    if ($conn->query($sql1))
                        echo 1;
                    else echo $conn->error;
                }
            } else echo $conn->error;
        }
    } else if ($_POST["action"] == "addCate") {
        $name = $_POST["cateCode"];
        $code = $_POST["cateName"];
        if(($_POST["cateCode"])=="" || ($_POST["cateName"])=="")
        echo "Vui lòng nhập đầy đủ thông tin";
        else{
        $sql = "INSERT INTO LOAIHANGHOA VALUES('" . $name . "','" . $code . "')";
        if ($conn->query($sql))
            echo "Thêm thành công";
        else
            echo "Tồn tại mã loại hàng này";
        }     
    } 

    else if ($_POST["action"] == "delCate") {
        $code = $_POST["cateCode"];
        $sql = "DELETE FROM LoaiHangHoa WHERE MaLoaiHang='".$code."';";
        if ($conn->query($sql))
            echo "Xóa thành công";
        else
            echo "Không xóa được loại hàng";
        }     
    
    else if ($_POST["action"] == "changeView") {
        $id = $_POST["id"];
        $sql = "SELECT * FROM HANGHOA,HINHHANGHOA WHERE HANGHOA.MaLoaiHang='" . $id . "' and HINHHANGHOA.MSHH=HANGHOA.MSHH";
        $result = $conn->query($sql);
        $card = "";
        while ($row = $result->fetch_assoc()) {
            echo '
        <div class="cardProduct">
            <a href="views/products-info.php?id=' . $row["MSHH"] . '" style="text-decoration:none;">
                <img src="imgs/' . $row["mahinh"] . '" class="cardImg" alt="Card image cap">
                <div class="cardContent ">
                    <h5>' . $row["TenHH"] . '</h5>
                    <h4>' . $row["Gia"] . 'đ</h4>
                    <hr class="border-top border-secondary">
                    <h4>Số lượng còn lại: ' . $row["SoLuongHang"] . '</h4>
                </div>
            </a>
        </div>';
        }
        if($result->num_rows == 0)
            echo "
            <h1>Chưa có mặt hàng nào thuộc loại hàng này</h1>";
    }       
}
