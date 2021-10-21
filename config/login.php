<?php
include "dbconnection.php";
if (session_id() === '') session_start();

$name = $_POST["inputName"];
$pass = $_POST["inputPassword"];

$sql = "SELECT MSNV,HoTenNV FROM NhanVien WHERE HoTenNV='" . $name . "' LIMIT 1;";
$sql1 = "SELECT MSKH,HoTenKH FROM KhachHang WHERE HoTenKH='" . $name . "' LIMIT 1;";

$result = $conn->query($sql);
$result1 = $conn->query($sql1);
if($result->num_rows>0){
    $row = $result->fetch_assoc();
    if($row)
    if ($pass == $row["MSNV"]) {
        if (!isset($_SESSION["user"])) {
            $_SESSION["user"] = $name;
            $_SESSION["iduser"] = $row["MSNV"];
            $_SESSION["role"]="NV";
        }
        header("location: ../main.php");
}else header("location: ../index.php?id=2");
}
else if($result1->num_rows>0){
    $row1 = $result1->fetch_assoc();
    if ($pass == $row1["MSKH"]) {
        if (!isset($_SESSION["user"])) {
            $_SESSION["user"] = $name;
            $_SESSION["iduser"] = $row1["MSKH"];
            $_SESSION["role"]="KH";
        }
        header("location: ../main.php");
}else header("location: ../index.php?id=2");
} 
else {
    header("location: ../index.php?id=3");
}
?>