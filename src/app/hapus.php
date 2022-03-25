<?php
session_start();

if (!isset($_SESSION['key'])) {
	header("Location: login.php");
	exit;
}

require_once 'logic/logic.php';

$id = $_GET["id"];
$db_name = $_GET['param1'];
$field_name = $_GET['param2'];

if (hapus($id, $db_name, $field_name) > 0) {
	echo "
		<script>
			alert('data berhasil dihapus!');
			document.location.href = 'kamar_hotel.php';
		</script>
	";
} else {
	echo "
		<script>
			alert('data gagal ditambahkan!');
			document.location.href = 'kamar_hotel.php';
		</script>
	";
}
