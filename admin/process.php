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
            $sql = 'INSERT INTO KHACHHANG VALUES("' . $MSKH . '","' . $_POST["name"] . '",' . $_POST["company"] . ',"' . $_POST["phone"] . '",' . $_POST["FAX"] . ');';

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
        $sql = 'INSERT INTO DATHANG VALUES(\'' . $MSDH . '\',\'' . $_SESSION['iduser'] . '\',NULL,\'' . $sentDate . '\',\'' . $takeDate . '\',\'' . $TT . '\')';
        if ($conn->query($sql)) {
            foreach ($_SESSION["cartList"] as $item => $quantity) {
                $sql1 = 'SELECT Gia FROM HANGHOA WHERE MSHH="' . $item . '";';

                $result = $conn->query($sql1);
                $row = $result->fetch_assoc();
                $total = $row["Gia"] * $quantity;

                $sql2 = 'INSERT INTO ChiTietDatHang VALUES("' . $MSDH . '","' . $item . '","' . $quantity . '","' . $total . '","0")';
                if (!$conn->query($sql2)) {
                    echo 3;
                    return;
                }
            }
            unset($_SESSION["cartList"]);
            echo 2;
        } else echo 1;
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
    }
    else if ($_POST["action"] == "upProd") {
        $sql = "UPDATE HANGHOA SET TenHH='".$_POST["name"]."', Gia='" . $_POST["price"] . "',QuyCach='".$_POST["qualify"]."'  WHERE MSHH='" . $_POST["productID"] . "';";
        if ($conn->query($sql)) {
                echo 1;
            }
        else echo 2;
    }


}