<?php
include "../config/dbconnection.php";
firstStep();
if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']))
    header("location:../main.php");
else {
    $_SESSION["show"] = "products";
    $sql2 = "SELECT * FROM LoaiHangHoa";
    $result2 = $conn->query($sql2);
    echo '<div style="display:flex;flex-warp:wrap;width:70%;margin:auto;justify-content:center;">';
    while ($row = $result2->fetch_assoc())
        echo '<input style="margin:5px;" class="btn btn-primary" id="' . $row["MaLoaiHang"] . '" type="button" value="' . $row["TenLoaiHang"] . '">';
    echo '</div>';
    $sql = "SELECT TenHH,Gia,SoLuongHang,MaHinh,HANGHOA.MSHH FROM HANGHOA,HINHHANGHOA WHERE HANGHOA.MSHH=HINHHANGHOA.MSHH AND SoLuongHang>0";
    #-----------------------ROLE NV-----------------------
    if ($_SESSION["role"] == "NV") {
        echo '
        <div style="display:flex;flex-warp:wrap;">
            <div class="btnCreate" style="margin:auto;width:200px;item-align:center;">
                <input id="procreate" type="button" class="btn btn-info" style="margin-top:10px;" value="Nhập sản phẩm mới"/>
            </div>
            <div class="btnCate" style="margin:auto;width:200px;item-align:center;">
                <input id="procate" type="button" class="btn btn-info" style="margin-top:10px;" value="Quản lý loại sản phẩm"/>
            </div>
        </div>';
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
        } else
            echo '<h1 style="text-align:center;">Hết Hàng</h1>';
    }
    #-----------------------ROLE KH-----------------------
    if ($_SESSION["role"] == "KH") {

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
        } else
            echo '<h1 style="text-align:center;">Hết Hàng</h1>';
    }
}
?>
<script type="text/javascript">
    $("#procreate").on("click", function() {
        $("#content").load("admin/createProducts.php");
    })
    $("#procate").on("click", function() {
        $("#content").load("admin/createCategory.php");
    })
    <?php
    $sql2 = "SELECT * FROM LoaiHangHoa";
    $result2 = $conn->query($sql2);
    while ($row = $result2->fetch_assoc()) {
        echo '$("#' . $row["MaLoaiHang"] . '").on("click",function(){
                 $.ajax({
                    type:"POST",
                    url:"admin/process.php",
                    data:{
                        action:"changeView",
                        id:"' . $row["MaLoaiHang"] . '"
                    }

             }).done(function(response){
                document.getElementById("listproducts").innerHTML=response;
                // $("#listproducts").load(response)
             })
            }) 
             ';
    }
    ?>
</script>