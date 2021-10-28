<?php
include "../config/dbconnection.php";
firstStep();
if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']))
    header("location:../main.php");
else {
    if (isset($_POST["outsource"]))
        if ($_POST["outsource"] == "outside")
            $_SESSION["show"] = "home";
    $_SESSION["show"] = "carts";

    if ($_SESSION["role"] == "KH") {

        echo '<div class="listSelected border">
    <div class="leftSelect border-right">';
        if (isset($_SESSION["cartList"])) {
            if (count($_SESSION["cartList"]) == 0)
                echo '<h1 style="text-align:center;">Giỏ hàng trống</h1>';
            else
                foreach ($_SESSION["cartList"] as $proID => $quantity) {
                    $sql = "SELECT * FROM HANGHOA,HINHHANGHOA WHERE HINHHANGHOA.MSHH=HANGHOA.MSHH and HANGHOA.MSHH=\"" . $proID . "\" ;";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        echo '<div class="itemSelect border-bottom">
            <div class="infoSelect">
                <img src="imgs/' . $row["mahinh"] . '" style="max-width: 50px;max-height:50px;">
                <span>' . $row["TenHH"] . '</span>
            </div>
            <div class="priceSelect">
                <label for="count" style="display: none;" id="label' . $row["MSHH"] . '">' . $row["Gia"] . '</label>
                <label for="count' . $row["MSHH"] . '" style="margin:0px 5px;">Số lượng</label>
                <input class="toCount" type="number" id="count' . $row["MSHH"] . '" min="1" max="' . $row["SoLuongHang"] . '" style="width: 50px;" value="1" onchange="checkCount(\'' . $row["MSHH"] . '\')">
                <label for="total' . $row["MSHH"] . '" style="margin:0px 10px;">Thành tiền</label>
                <input class="toPrice" type="number" id="total' . $row["MSHH"] . '" disabled style="width: 90px;" value="' . $row["Gia"] . '">đ
                <input type="button" class="btn btn-danger" onclick="removeCart(\'' . $row["MSHH"] . '\')" value="Xóa" style="margin-left: 50px;"/>
            </div>
        </div>';
                    }
                }
        } else {
            echo '<h1 style="text-align:center;">Giỏ hàng trống</h1>';
        }
        $sql = 'SELECT HoTenKH,SoDienThoai FROM KHACHHANG WHERE MSKH="' . $_SESSION["iduser"] . '";';
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        echo '</div>
    <div class="rightSelect">
        <form>
            <div class="total">
                <script type="text/javascript">
                    function updateCost() {
                        var totalCount = 0;
                        var list = $(".toCount").map((_, te) => te.value).get();
                        for (i = 0; i < list.length; i++)
                            totalCount += parseInt(list[i]);
                        document.getElementById("totalCount").innerHTML = totalCount;
                        var totalPrice = 0;
                        var list1 = $(".toPrice").map((_, te) => te.value).get();
                        for (i = 0; i < list1.length; i++)
                            totalPrice += parseInt(list1[i]);
                        document.getElementById("totalPrice").innerHTML = totalPrice;
                    }
                    updateCost();
                </script>
                <h5>' . $row["HoTenKH"] . '</h5>
                <h5>' . $row["SoDienThoai"] . '</h5>
                <select type="select" id="addressSelect" class="form-control">
                                <option selected>Chọn địa chỉ</option>';
                $sql = "SELECT * FROM DIACHIKH WHERE MSKH='" . $_SESSION["iduser"] . "';";
                $result = $conn->query($sql);

                while ($row = $result->fetch_assoc()) {
                    echo '<option value ="'.$row["DiaChi"].'">' . $row["DiaChi"] . '</option>';
                }
                echo 
                ' </select>
                <hr>
                <h4>Tổng số sản phẩm: <span id="totalCount"></span></h4>
                <h4>Tổng tiền: <span id="totalPrice"></span>
                    <p style="display: inline;"> đ</p>
                </h4>
            </div>
        </form>
        <input style="margin-left:280px;" type="button" id="btnDat" value="Đặt hàng" class="btn btn-success">
    </div>
    </div>
    <script type="text/javascript">
        $("#btnDat").on("click", function() {
            var money = document.getElementById("totalPrice").innerHTML;
            var currentDate = new Date().toJSON().slice(0, 10).replace(/-/g, "-");
            money = parseInt(money);    
            var address=$("#addressSelect").val();
            if(address=="Chọn địa chỉ"){
            alert("Vui lòng nhập địa chỉ");
            return;}
            if(money!=0){
            $.ajax({
                type: "POST",
                url: "admin/process.php",
                data: {
                    action: "checkCart",
                    money: money,
                    address: address,
                    currentDate: currentDate
                }
            }).done(function(response) {
                if(response=="1")
                    alert("Lỗi thêm thông tin đặt hàng");
                if(response=="2"){
                    alert("Đặt hàng thành công");
                    window.location = "../main.php";}
                if(response=="3")
                    alert("Lỗi thêm thông tin chi tiết đặt hàng");
            })}
            else
                alert("Giỏ hàng trống");
        })
    
        function removeCart(id) {
            $.ajax({
                    type: "POST",
                    url: "admin/process.php",
                    data: {
                        action: "removeFromCart",
                        prodID: id
                    }
                })
                .done(function() {
                    alert("Xóa thành công");
                    window.location = "../main.php";
                })
        }
    
        function checkCount(countid) {
            var count = document.getElementById("count" + countid).value;
            if (count == "")
                document.getElementById("count" + countid).value = 1;
            else {
                count = parseInt(count);
                var maxCount = document.getElementById("count" + countid).getAttribute("max");
                maxCount = parseInt(maxCount);
                if (count > maxCount)
                    document.getElementById("count" + countid).value = maxCount;
                else if (count < 1)
                    document.getElementById("count" + countid).value = 1;
            }
            document.getElementById("total" + countid).value = parseInt(document.getElementById("label" + countid).innerHTML) * document.getElementById("count" + countid).value;
            var quantity=document.getElementById("count" + countid).value;
            $.ajax({
                type:"POST",
                url:"admin/process.php",
                data:{
                    action:"updateQuantity",
                    prodID: countid,
                    quantity:quantity
                }
            })
            updateCost();
        }
    </script>';
    }
}
if ($_SESSION["role"] == "NV") {
    echo '<div class="receipt">
            <div class="btnLog" style="margin-left: auto;margin-right:auto;width:100px;">
                <input type="button" class="btn btn-danger" value="Đăng xuất" id="btnLogOut" style="margin-top: 20px;margin-bottom:10px;">
            </div>
            <div class="listRecepit">
                <div class="receipt border-bottom">
                <table class="table">
          <thead>
            <tr>
              <th scope="col" style="width:10%;">Mã đơn hàng</th>
              <th scope="col" style="width:20%;">Mã nhân viên xác nhận</th>
              <th scope="col" style="width:20%;">Ngày đặt hàng</th>
              <th scope="col" style="width:20%;">Ngày giao hàng</th>
              <th scope="col" style="width:30%;">Trạng thái đặt hàng</th>
            </tr>
          </thead>
          <tbody>';
    $sql = "SELECT * FROM DATHANG";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        echo '  <tr>
                <th scope="row">' . $row["SoDonDH"] . '</th>
                <td>' . $row["MSNV"] . '</td>
                <td>' . $row["NgayDH"] . '</td>
                <td>' . $row["NgayGH"] . '</td>
                <td id="TTDH">' . $row["TrangThaiDH"] . '
                ';
        if ($row["TrangThaiDH"] == "Chưa xác nhận")
            echo '
                <input id="btn' . $row["SoDonDH"] . '" type="button" class="btn btn-success" value="Xác nhận" onclick="confirm(\'' . $row["SoDonDH"] . '\')" style="width:100px;height:50px; margin-left:20px;"></td>';
        echo '</tr>';
    }
    echo
    '</tbody>
        </table>
        </div>
        </div>
        </div>';
}
echo'<script type="text/javascript">
function confirm(id) {
    $.ajax({
        type: "POST",
        url: "admin/process.php",
        data: {
            action: "confirmReceipt",
            id: id
        }
    }).done(function(response) {
        if (response == "1")
            $("#btn" + id).css({
                "display": "none"
            });
            document.getElementById("TTDH").innerHTML="Đã xác nhận";
        if (response == "2")
            alert(response);
    })
}

$("#btnLogOut").on("click", function() {
    $.ajax({
        type: "POST",
        url: "admin/process.php",
        data: {
            action: "logout"
        }
    }).done(function() {
        window.location.replace("../index.php");
    })


})
</script>';
?>
