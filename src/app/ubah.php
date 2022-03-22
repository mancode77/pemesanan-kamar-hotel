<?php
session_start();

if (!isset($_SESSION['key'])) {
    header("Location: login.php");
    exit;
}

require_once 'logic.php';
require_once '../config/config.php';

// ambil data di URL
$id = $_GET["id"];

$sql = "SELECT * FROM kamar WHERE id_kamar=:id_kamar";

$stmt = $db->prepare($sql);

// bind parameter ke query
$params = [":id_kamar" => $id];

$stmt->execute($params);

$record = $stmt->fetch(PDO::FETCH_ASSOC);

if ($record < 0) {
    echo "
			<script>
				alert('data tidak ditemukan!');
				document.location.href = 'kamar_hotel.php';
			</script>
		";
}

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {

    // cek apakah data berhasil diubah atau tidak
    if (ubah($_POST) > 0) {
        echo "
			<script>
				alert('data berhasil diubah!');
				document.location.href = 'kamar_hotel.php';
			</script>
		";
    } else {
        echo "
			<script>
				alert('data gagal diubah!');
				document.location.href = 'kamar_hotel.php';
			</script>
		";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah data</title>
</head>

<body>
    <div class="container mt-3">
        <form action="" method="post">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                tambah data
            </button>

            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">ubah data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <?php foreach ($record as $key => $value) : ?>
                                <div class="input-group mb-3">
                                    <input type="text" name="<?= $key; ?>" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="<?= str_replace("_", " ", $key); ?>" required>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" name="submit" class="btn btn-primary">tambah</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>