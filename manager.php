<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location:signin.php');
}

include('connect.php');

$idql = $_GET['idql'];

if (!empty($_POST['submit'])) {
    $idbenh = $_POST['idbenh'];
    $idbenhnhan = $_POST['idbenhnhan'];
    $ngaybatdau = $_POST['ngayBatDau'];
    $ngayketthuc = $_POST['ngayKetThuc'];
    $nhanxet = $_POST['nhanXet'];
    $sql = "INSERT INTO `dieutri`(`nhanvien_id`, `loaibenh_id`, `benhnhan`, `ngaybatdau`, `ngayketthuc`, `nhanxet`) VALUES ('$idql','$idbenh','$idbenhnhan','$ngaybatdau','$ngayketthuc','$nhanxet')";
    $stmt = $connection->prepare($sql);
    $query = $stmt->execute();

    if ($query) {
        echo "<div class='alert alert-primary text-center' role='alert'>Thành Công</div>";
    }
}


$sql = "SELECT benhnhan.id,benhnhan.hovaten FROM benhnhan";

$stmt = $connection->prepare($sql);
$query = $stmt->execute();
$result = array();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $result[] = $row;
}

$sql = "SELECT loaibenh.id,loaibenh.tenbenh FROM loaibenh";

$stmt = $connection->prepare($sql);
$query = $stmt->execute();
$result1 = array();


while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $result1[] = $row;
}

$sql = "SELECT dieutri.id,benhnhan.hovaten,loaibenh.tenbenh,dieutri.ngaybatdau FROM dieutri INNER JOIN loaibenh on loaibenh.id = dieutri.loaibenh_id INNER JOIN benhnhan on benhnhan.id = dieutri.benhnhan";

$stmt = $connection->prepare($sql);
$query = $stmt->execute();
$result2 = array();


while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $result2[] = $row;
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
    <content class="container">
        <form action="" method="post">
            <div class="mb-3">
                <label for="idNhanVien" class="form-label">ID nhân viên</label>
                <input type="text" class="form-control" name="idNhanVien" id="idNhanVien" readonly value="<?php echo $idql; ?>" aria-describedby="helpId" placeholder="Nhập ID nhân viên">
            </div>


            <div class="mb-3">
                <label for="idbenh" class="form-label">Loại Bệnh</label>
                <select type="text" class="form-control" name="idbenh" id="idbenh" aria-describedby="helpId" placeholder="Chọn Loại Bệnh">
                    <?php foreach ($result1 as $items) : ?>
                        <option value="<?php echo $items['id'] ?>">
                            <?php echo $items['tenbenh'] ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="idbenhnhan" class="form-label">Bệnh nhân</label>
                <select type="text" class="form-control" name="idbenhnhan" id="idbenhnhan" aria-describedby="helpId" placeholder="Chọn bệnh nhân">
                    <?php foreach ($result as $items) : ?>
                        <option value="<?php echo $items['id'] ?>">
                            <?php echo $items['hovaten'] ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="ngayBatDau" class="form-label">Ngày Bắt Đầu</label>
                <input type="datetime-local" class="form-control" name="ngayBatDau" id="ngayBatDau" required aria-describedby="helpId" placeholder="Nhập ngày bắt đầu">
            </div>
            <div class="mb-3">
                <label for="ngayKetThuc" class="form-label">Ngày Kết Thúc</label>
                <input type="datetime-local" class="form-control" name="ngayKetThuc" id="ngayKetThuc" required aria-describedby="helpId" placeholder="Nhập ngày bắt đầu">
            </div>
            <div class="mb-3">
                <label for="nhanXet" class="form-label">Nhận xét</label>
                <input type="text" class="form-control" name="nhanXet" id="nhanXet" required aria-describedby="helpId" placeholder="Nhập nhận xét">
            </div>
            <input type="submit" class="btn btn-primary" name="submit" value="Thêm">
        </form>

        <div class="container">
            <div class="table-responsive table-border mt-3" style="border: 2px solid #000;">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Thứ tự</th>
                            <th scope="col">Mã Điều Trị</th>
                            <th scope="col">Họ và tên bệnh nhân</th>
                            <th scope="col">Tên Bệnh Nhân</th>
                            <th scope="col">Ngày Bắt Đầu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 1;
                        foreach ($result2 as $items) : ?>
                            <tr class="">
                                <td><?php echo $count++ ?></td>
                                <td><?php echo $items['id']; ?></td>
                                <td><?php echo $items['hovaten']; ?></td>
                                <td><?php echo $items['tenbenh']; ?></td>
                                <td><?php echo $items['ngaybatdau']; ?></td>
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

    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href)
        }
    </script>
</body>

</html>