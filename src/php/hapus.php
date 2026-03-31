<?php
    require 'functions.php'; 

    $id = $_GET['id'];


    if (count(hapusData($id)) > 0) {
        echo "
                <script>
                    alert('Berhasil meng-hapus!');
                    document.location.href = '../../public/admin/panel-admin.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Gagal meng-hapus!');
                    document.location.href = '../../public/admin/panel-admin.php';
                </script>
            ";
    }