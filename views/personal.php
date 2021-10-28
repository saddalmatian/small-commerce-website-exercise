<?php
include "../config/dbconnection.php";
firstStep();
if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || session_id() === "")
    header("location:../main.php");
else {
    echo '     <div class="btnLog" style="margin-left: auto;margin-right:auto;width:100px;">
    <input type="button" class="btn btn-danger" value="Đăng xuất" id="btnLogOut" style="margin-top: 20px;margin-bottom:10px;">
</div>';
    $sql = "SELECT * FROM khachhang WHERE MSKH=\"" . $_SESSION["iduser"] . "\";";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();
        if ($row["TenCongTy"] == NULL)
            $company = "Không có";
        else $company = $row["TenCongTy"];

        if ($row["SoFax"] == NULL)
            $FAX = "Không có";
        else $FAX = $row["SoFax"];

        echo '<div class="clients-info">
        <div class="clientsImg">
            <img class="climg" src="../imgs/profile.jpg" alt="">
        </div>
        <div class="clientsInfo">
            <hr>
            <p><h3 style="font-weight: bolder;">Tải khoản khách hàng:</h3>
            <h5>' . $row["HoTenKH"] . '</h5>
            <hr>
            <p><h3 style="font-weight: bolder;">Tên công ty:</h3>
            <h5>' . $company . '</h5>
            <hr>
            <p><h3 style="font-weight: bolder;">Số điện thoại:</h3>
            <h5>' . $row["SoDienThoai"] . '</h5>
            <hr>
            <p><h3 style="font-weight: bolder;">Số FAX:</h3>
            <h5>' . $FAX . '</h5>
            <hr>
            <p><h3 style="font-weight: bolder;">Địa chỉ:</h3>';
        $sql2 = "SELECT * FROM DiaChiKH WHERE MSKH=\"" . $_SESSION["iduser"] . "\";";
        $result2 = $conn->query($sql2);
        if ($result2->num_rows > 0) {
            $count = 1;
            while ($row = $result2->fetch_assoc()) {
                echo '<h6>Địa chỉ ' . $count . ': ' . $row["DiaChi"] . '';
                $count += 1;
            }
        }
        echo '<hr>
    <form action="admin/editInfo.php" method="POST">
        <button type="submit" class="btn btn-info">Sửa thông tin</button>
    </form>
        </div>
    </div>';
    }
    $_SESSION["show"] = "personal";

    $sql = 'SELECT * FROM DATHANG WHERE MSKH="' . $_SESSION["iduser"] . '"';
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo '<div class="receipt">
       
            <div class="listRecepit">
                <div class="receipt border-bottom">
                <table class="table">
          <thead>
            <tr>
              <th scope="col">Mã đơn hàng</th>
              <th scope="col">Mã nhân viên xác nhận</th>
              <th scope="col">Ngày đặt hàng</th>
              <th scope="col">Ngày giao hàng</th>
              <th scope="col">Trạng thái đặt hàng</th>
            </tr>
          </thead>
          <tbody>';
        while ($row = $result->fetch_assoc()) {
            echo '  <tr>
                <th scope="row">' . $row["SoDonDH"] . '</th>
                <td>' . $row["MSNV"] . '</td>
                <td>' . $row["NgayDH"] . '</td>
                <td>' . $row["NgayGH"] . '</td>
                <td>' . $row["TrangThaiDH"] . '</td>
              </tr>';
        }
        echo
        '</tbody>
        </table>
        </div>
        </div>
        </div>';
    } else
        echo '
        <div style="width:50%;margin:auto;text-align:center;">
        <h4>Chưa có đơn hàng nào</h4>
        </div>
        ';
}
?>


<script type="text/javascript">
    $("#btnLogOut").on('click', function() {
        $.ajax({
            type: "POST",
            url: 'admin/process.php',
            data: {
                action: "logout"
            }
        }).done(function() {
            window.location.replace("../index.php");
        })
    })
</script>