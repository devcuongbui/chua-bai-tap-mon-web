<?php
session_start();


include('connect.php');


if(!empty($_POST['submit'])){

    $username = $_POST['text_username'];
    $password = $_POST['text_password'];
    
    $sql = "SELECT * FROM `user` WHERE username = '$username' and matkhau = '$password'";
    $stmt = $connection->prepare($sql);
    $query = $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if(!$row) {
        echo "Đăng nhập thất bại";
    }
    else {
        $_SESSION['username'] = $username;
        header("location:index.php");
    }
}


?>



<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
    <form method="post">
        <div class="mb-3">
            <label for="text_username" class="form-label">Tài Khoản</label>
            <input type="text" class="form-control" name="text_username" id="text_username" aria-describedby="helpId" placeholder="Nhập tên đăng nhập">
        </div>
        <div class="mb-3">
            <label for="text_password" class="form-label">Mật Khẩu</label>
            <input type="password" class="form-control" name="text_password" id="text_password" aria-describedby="helpId" placeholder="Nhập mật khẩu">
        </div>
        <input type="submit" class="btn btn-primary" name="submit" value="Đăng Nhập">
    </form>


    



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>