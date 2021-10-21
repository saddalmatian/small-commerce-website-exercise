<?php
include "../config/dbconnection.php";
firstStep();
if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || session_id()==="")
    header("location:../main.php");
else {
    $_SESSION["show"] = "personal";

    $sql = 'SELECT * FROM DATHANG WHERE MSKH="' . $_SESSION["iduser"] . '"';
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo '<div class="receipt">
            <div class="btnLog" style="margin-left: auto;margin-right:auto;width:100px;">
                <input type="button" class="btn btn-danger" value="Đăng xuất" id="btnLogOut" style="margin-top: 20px;margin-bottom:10px;">
            </div>
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
                <th scope="row">'.$row["SoDonDH"].'</th>
                <td>'.$row["MSNV"].'</td>
                <td>'.$row["NgayDH"].'</td>
                <td>'.$row["NgayGH"].'</td>
                <td>'.$row["TrangThaiDH"].'</td>
              </tr>';
        }
        echo 
        '</tbody>
        </table>
        </div>
        </div>
        </div>';
    } else
        echo '<h1>Chưa có đơn hàng nào</h1>';
}
?>
<script type="text/javascript">
$("#btnLogOut").on('click',function(){
    $.ajax({
        type:"POST",
        url:'admin/process.php',
        data:{
            action:"logout"
        }
    }).done(function(){
        window.location.replace("../index.php");
    })
})
</script>
