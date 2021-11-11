<?php
include "../config/dbconnection.php";
firstStep();
if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']))
    header("location:../main.php");
else {
}
?>

<div class="createForm">
    <form action="admin/upload.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nameProd">Tên hàng hóa</label>
            <input type="text" class="form-control" id="nameProd" name="nameProd" placeholder="Tiểu thuyết mặt trăng" required>

        </div>
        <div class="form-group">
            <label for="countProd">Sô lượng hàng hóa</label>
            <input type="number" min="0" class="form-control" id="countProd" name="countProd" placeholder="12" required>
        </div>
        <div class="form-group">
            <label for="priceProd">Giá (1 sản phẩm)</label>
            <input type="number" min="0" class="form-control" id="priceProd" name="priceProd" placeholder="20000" required>
        </div>
        <div class="form-group">
            <label for="cateProd">Mã loại hàng</label>
          
            <select class="form-control" id="cateProd" name="cateProd" required>
            <?php
                $sql = "SELECT * FROM LoaiHangHoa";
                $result = $conn->query($sql);
                while($row = $result->fetch_assoc())
                    echo '<option>'.$row["TenLoaiHang"].'</option>'
            ?>
            </select>
        </div>
        <div class="form-group">
            <label for="quycachProd">Quy cách (mô tả)</label>
            <textarea class="form-control" id="quycachProd" name="quycachProd" rows="3" required></textarea>
        </div>
      
            <div class="form-group">
                <label for="imgProd">Hình ảnh đại hiện hàng hóa</label>
                <input type="file" name="fileToUpload" id="fileToUpload" required>
            </div>
   
        <button type="submit" name="submit" class="btn btn-success">Hoàn thành</button>
    </form>
</div>