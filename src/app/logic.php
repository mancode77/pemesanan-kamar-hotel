<?php

require_once '../config/config.php';

function store($data) {
	global $db;

	$id_kamar = htmlspecialchars($data["id_kamar"]);
	$nama_kamar = htmlspecialchars($data["nama_kamar"]);
	$biaya_sewa = htmlspecialchars($data["biaya_sewa"]);

    $sql = "INSERT INTO kamar 
            (id_kamar, nama_kamar, biaya_kamar)
			VALUES
			('$id_kamar', '$nama_kamar', '$biaya_sewa');";

    $stmt = $db->prepare($sql);

    // bind parameter ke query
    $params = [
        ":id_kamar" => $id_kamar,
        ":nama_kamar" => $nama_kamar,
        ":biaya_sewa" => $biaya_sewa
    ];

    $stmt->execute($params);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

	return mysqli_affected_rows($result);
}