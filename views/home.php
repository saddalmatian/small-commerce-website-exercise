<?php
include "../config/dbconnection.php";
firstStep();


if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']))
    header("location:../main.php");
else {
    $_SESSION["show"] = "home";
    echo '<div class="home">
    <img src="imgs/wallpaper.jpg" style="width: 100%;">
    </div>';
   
    echo ' <div style="width:50%;margin:auto;text-align:center">
    <h1>Một vài sản phẩm của shop</h1>
</div>';
    $sql = "SELECT TenHH,Gia,SoLuongHang,MaHinh,HANGHOA.MSHH FROM HANGHOA,HINHHANGHOA WHERE HANGHOA.MSHH=HINHHANGHOA.MSHH AND SoLuongHang>0  ORDER BY RAND ( )  LIMIT 3 ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo '<div class="listProducts" id="listproducts">';
        while ($row = $result->fetch_assoc()) {
            $card = '
        <div class="cardProduct">
        <a href="views/products-info.php?id=' . $row["MSHH"] . '" style="text-decoration:none;">
    <img src="imgs/' . $row["MaHinh"] . '" class="cardImg" alt="Card image cap">
    <div class="cardContent ">
        <h5>' . $row["TenHH"] . '</h5>
        <h4>' . $row["Gia"] . 'đ</h4>
        <hr class="border-top border-secondary">
        <h4>Số lượng còn lại: ' . $row["SoLuongHang"] . '</h4>
    </div>
    </a>
</div>';
            echo $card;
        }
        echo '</div>';
    }
}
