<?php
session_start();

if (!isset($_SESSION['key'])) {
    header("Location: login.php");
    exit;
}

require_once 'logic/logic.php';
require_once '../config/config.php';

$global_db_name = null;
$global_field_name = null;
$global_id_field = null;

function data($db_name, $field_name, $id_field)
{
    global $db;
    global $global_db_name;
    global $global_field_name;
    global $global_id_field;

    $global_db_name = $db_name;
    $global_field_name = $field_name;
    $global_id_field = $id_field;

    $sql = "SELECT * FROM $db_name WHERE $field_name=:$field_name";

    $stmt = $db->prepare($sql);
    // bind parameter ke query
    $params = [":$field_name" => $id_field];

    $stmt->execute($params);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result < 0) {
        echo "
			<script>
				alert('data tidak ditemukan!');
				document.location.href = 'pelanggan.php';
			</script>
		";
    }

    return $result;
}

if (isset($_GET['id'])) {
    $record = data($_GET['param1'], $_GET['param2'], $_GET['id']);
}

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {

    // cek apakah data berhasil diubah atau tidak
    if (ubah($_POST, $global_db_name, $global_field_name, $global_id_field) > 0) {
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

switch ($_COOKIE['r']) {
    case 'admin':
        require_once '../templates/header-admin/header.php';
        break;

    case 'guest':
        require_once '../templates/header-guest/header.php';
        break;

    case 'resepsionis':
        require_once '../templates/header-resepsionis/header.php';
        break;
}

?>

<div class="container mt-3 d-flex justify-content-center">
    <form action="" method="post">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            ubah data
        </button>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">ubah data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php foreach ($record as $key => $value) : ?>
                        <div class="input-group mb-3">
                            <input type="text" name="<?= $key; ?>" class="form-control"
                                aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                                placeholder="<?= str_replace("_", " ", $key); ?>" value="<?= $value; ?>" required>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="submit" class="btn btn-primary">ubah</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<?php require_once '../templates/footer.php'; ?>