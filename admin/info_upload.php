<?php
echo var_dump($_FILES);

$msg = null;
$alert = null;

    if(isset($_FILES['upfile']) && is_uploaded_file($_FILES['tmp_name'])){
        $old_name = $_FILES['upfile']['tmp_name'];

        $new_name = $_FILES['image']['name'];
        if(move_uploaded_file($old_name, 'imh/news/' . $new_name)){
            $msg = 'アップロードしました。';
            $alert = 'success';
        } else {
            $msg = 'アップロードできませんでした。';
            $alert = 'danger';
        }

    }



?>