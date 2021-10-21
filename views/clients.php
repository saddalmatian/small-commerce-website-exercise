<?php
include "../config/dbconnection.php";
firstStep();
if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']))
    header("location:../main.php");
else {
    $_SESSION["show"] = "clients";
    $sql = "SELECT * FROM KHACHHANG ORDER BY LENGTH(MSKH),MSKH;";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    echo'<div class="gatherAll">';
        echo '<div class="clientHeader" style="text-align: center;margin:10px;">
        <input type="button" class="btn btn-primary" id="createClients" value="Tạo mới khách hàng">
        </div>';
        echo '<div class="listClients">
    
    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Tìm số điện thoại">

    <table id="myTable">
        <tr class="header">
            <th style="width:15%">Mã số khách hàng</th>
            <th style="width:25%">Tên khách hàng</th>
            <th style="width:30%">Tên công ty</th>
            <th style="width:20%">Số điện thoại</th>
            <th style="width:10%">Số FAX</th>
        </tr>';
        while ($row = $result->fetch_assoc()) {
            echo 
            '
                    <tr>
                    <td style="text-decoration:none;"><a href="views/clients-info.php?id='.$row["MSKH"] .'">' . $row["MSKH"] . '</a></td>
                    <td>' . $row["HoTenKH"] . '</td>
                    <td>' . $row["TenCongTy"] . '</td>
                    <td class="phone">' . $row["SoDienThoai"] . '</td>
                    <td>' . $row["SoFax"] . '</td>
                    </tr>
                    </a>';
        }
        echo
        '</table>
    </div>
    </div>';
    echo "<script>
    function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById('myInput');
        filter = input.value.toUpperCase();
        table = document.getElementById('myTable');
        tr = table.getElementsByTagName('tr');
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByClassName('phone')[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = '';
                } else {
                    tr[i].style.display = 'none';
                }
            }
        }
    }

    $('#createClients').on('click',function(){
        $('.gatherAll').css({
            'animation-name': 'leftOut',
            'animation-iteration-count': '1',
            'animation-timing-function': 'ease-out',
            'animation-duration': '1s',
        });
        setTimeout(() => {
            $('#content').load('admin/createClients.php');
        }, 800);
       
    })
</script>";
    }
    else{
        echo '<h1>Hệ thống không lấy được thông tin khách hàng!</h1>';
    }
    
}
?>