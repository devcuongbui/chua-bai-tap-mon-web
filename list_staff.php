<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location:signin.php');
}

include('connect.php');
if (empty($_POST['submit'])) {
    $sql = "SELECT * FROM `hienthinhanvien`";
    $stmt = $connection->prepare($sql);
    $query = $stmt->execute();
    $result = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $result[] = $row;
    }
} else {
    $search = $_POST['timkiem'];
    $sql = "SELECT * FROM `hienthinhanvien` WHERE hovaten LIKE '%$search%'";
    $stmt = $connection->prepare($sql);
    $query = $stmt->execute();
    $result = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $result[] = $row;
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
    <link rel="stylesheet" href="./css/style.css">

</head>

<body>
    <?php include('./components/header.php'); ?>
    <content>
        <div class="container">

            <form method="post">
                <div class="mb-3">
                    <label for="" class="form-label">Tìm Kiếm</label>
                    <input type="text" class="form-control" name="timkiem" id="" aria-describedby="helpId" placeholder="Nhập tên nhân viên để tìm kiếm">
                    <input type="submit" name="submit" value="Tìm Kiếm" class="btn btn-primary mt-3">
                </div>

            </form>
            <div class="table-responsive">
                <table class="table table-primary">
                    <thead>
                        <tr>
                            <th scope="col">Mã nhân viên</th>
                            <th scope="col">Tên Khoa</th>
                            <th scope="col">Họ Và Tên</th>
                            <th scope="col">Điện Thoại</th>
                            <th scope="col">Năm Ký hợp động</th>
                            <th scope="col">Link</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($result as $items) : ?>
                            <tr class="">
                                <td><?php echo $items['id']; ?></td>
                                <td><?php echo $items['ten']; ?></td>
                                <td><?php echo $items['hovaten']; ?></td>
                                <td><?php echo $items['dienthoai']; ?></td>
                                <td><?php echo $items['namkyhopdong']; ?></td>
                                <td><a href="manager.php?idql=<?php echo $items['id']; ?>" class="btn btn-danger">Quản Lý</a></td>
                            </tr>
                    </tbody>
                <?php endforeach ?>
                </table>
            </div>
        </div>

    </content>
    <?php include('./components/footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>