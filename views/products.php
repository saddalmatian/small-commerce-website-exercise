<?php
include "../config/dbconnection.php";
firstStep();
if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']))
    header("location:../main.php");
else {

    $_SESSION["show"] = "products";
    $sql = "SELECT TenHH,Gia,SoLuongHang,MaHinh,HANGHOA.MSHH FROM HANGHOA,HINHHANGHOA WHERE HANGHOA.MSHH=HINHHANGHOA.MSHH AND SoLuongHang>0";
    if($_SESSION["role"]=="NV"){
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo '
        <div style="display:flex;flex-warp:wrap;">"
            <div class="btnCreate" style="margin:auto;width:200px;item-align:center;">
            <input id="procreate" type="button" class="btn btn-info" style="margin-top:10px;" value="Nhập sản phẩm mới"/>
            </div>
            <div class="btnCate" style="margin:auto;width:200px;item-align:center;">
            <input id="procate" type="button" class="btn btn-info" style="margin-top:10px;" value="Nhập loại sản phẩm mới"/>
            </div>
            </div>';
        echo '<div class="listProducts">';
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
    } else
        echo '<h1 style="text-align:center;">Hết Hàng</h1>';
    }
    if($_SESSION["role"]=="KH"){
        
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '
                <div class="btnCreate" style="margin:auto;width:200px;item-align:center;">
                </div>';
            echo '<div class="listProducts">';
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
        } else
            echo '<h1 style="text-align:center;">Hết Hàng</h1>';
        }
    
}
?>
<script type="text/javascript">
    $("#procreate").on("click",function(){
        $("#content").load("admin/createProducts.php");
    })
    $("#procate").on("click",function(){
        $("#content").load("admin/createCategory.php");
    })
</script>