<?php
include "../config/dbconnection.php";
firstStep();
if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']))
    header("location:../main.php");
else {
}
?>

<div class="createForm">
    <form>
        <div class="form-group">
            <label for="nameProd">Mã hàng hóa</label>
            <input type="text" class="form-control" id="nameProd" name="nameProd" placeholder="TT" required>
        </div>
        <div class="form-group">
            <label for="countProd">Tên hàng hóa</label>
            <input type="text" class="form-control" id="countProd" name="countProd" placeholder="Tiểu thuyết" required>
        </div>
        <button type="submit" id="Check" class="btn btn-success">Hoàn thành</button>
    </form>
</div>
<div class="createForm">
    <form>
        <div class="form-group">
            <label for="countProd">Tên hàng hóa</label>
            <?php
            echo '<select id="mlhselect" class="form-select">';
            $sql = "SELECT * FROM LoaiHangHoa";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo '<option class="'.$row["MaLoaiHang"].'" value="' . $row["MaLoaiHang"] . '">' . $row["TenLoaiHang"] . '</option>';
            }
            echo '</select>';
            ?>
        </div>
        <button type="submit" id="Delete" class="btn btn-danger">Xóa</button>
    </form>
</div>

<script type="text/javascript">
    $("#Check").on("click", function() {
        var code = $("#nameProd").val();
        var name = $("#countProd").val();
        $.ajax({
            type: "POST",
            url: "admin/process.php",
            data: {
                action: "addCate",
                cateCode: code,
                cateName: name
            }

        }).done(function(response) {
            alert(response);
        })
    })

    $("#Delete").on("click", function() {
        var code = $("#mlhselect").val();
        $.ajax({
            type: "POST",
            url: "admin/process.php",
            data: {
                action: "delCate",
                cateCode: code,
            }

        }).done(function(response) {
            alert(response);
            window.location.href="../main.php"
        })
    })
</script>