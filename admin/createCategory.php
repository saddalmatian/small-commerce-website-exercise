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
<script type="text/javascript">
$("#Check").on("click",function(){
    var code=$("#nameProd").val();
    var name=$("#countProd").val();
    $.ajax({
        type:"POST",
        url:"admin/process.php",
        data:{
            action:"addCate",
            cateCode: code,
            cateName: name
        }

    }).done(function(response){
        alert(response);
    })
})
</script>