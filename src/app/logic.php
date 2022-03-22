<?php
require_once '../config/config.php';

function tambah_data_kamar_hotel($data)
{
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

    return $result;
}

function tambah_data_pelanggan($data)
{
    global $db;

    $id_pelanggan = htmlspecialchars($data["id_pelanggan"]);
    $nama_pelanggan = htmlspecialchars($data["nama_pelanggan"]);
    $jenis_kelamin = htmlspecialchars($data["jenis_kelamin"]);
    $usia = htmlspecialchars($data["usia"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $pekerjaan = htmlspecialchars($data["pekerjaan"]);
    $contact_person = htmlspecialchars($data["contact_person"]);

    $sql = "INSERT INTO pelanggan 
            (id_pelanggan_pelanggan, nama_pelanggan, jenis_kelamin, usia, alamat, pekerjaan, contact_person)
			VALUES
			('$nama_pelanggan', '$jenis_kelamin', '$usia', '$alamat', '$pekerjaan', '$contact_person');";

    $stmt = $db->prepare($sql);

    // bind parameter ke query
    $params = [
        ":id_pelanggan" => $id_pelanggan,
        ":nama_pelanggan" => $nama_pelanggan,
        ":jenis_kelamin" => $jenis_kelamin,
        ":usia" => $usia,
        ":alamat" => $alamat,
        ":pekerjaan" => $pekerjaan,
        ":contact_person" => $contact_person
    ];

    $stmt->execute($params);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}

function tambah_data_admin($data)
{
    global $db;

    $username = htmlspecialchars($data["username"]);
    $status = htmlspecialchars($data["status"]);

    $sql = "INSERT INTO admin 
            (username, status)
			VALUES
			('$username', '$status');";

    $stmt = $db->prepare($sql);

    // bind parameter ke query
    $params = [
        ":username" => $username,
        ":status" => $status
    ];

    $stmt->execute($params);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}

function tambah_data_sewa_kamar($data)
{
    global $db;

    $id_transaksi = htmlspecialchars($data["id_transaksi"]);
    $tanggal_check_in = htmlspecialchars($data["tanggal_check_in"]);
    $pelanggan = htmlspecialchars($data["pelanggan"]);
    $nama_kamar = htmlspecialchars($data["nama_kamar"]);
    $tanggal_check_out = htmlspecialchars($data["tanggal_check_out"]);
    $total_biaya_sewa = htmlspecialchars($data["total_biaya_sewa"]);

    $sql = "INSERT INTO admin 
            (id_transaksi, tanggal_check_in, pelanggan, nama_kamar, tanggal_check_out, total_biaya_sewa)
			VALUES
			($id_transaksi, '$tanggal_check_in', '$pelanggan', '$nama_kamar', '$tanggal_check_out', '$total_biaya_sewa');";

    $stmt = $db->prepare($sql);

    // bind parameter ke query
    $params = [
        ":id_transaksi" => $id_transaksi,
        ":tanggal_check_in" => $tanggal_check_in,
        ":pelanggan" => $pelanggan,
        ":nama_kamar" => $tanggal_check_in,
        ":tanggal_check_out" => $pelanggan,
        ":total_biaya_sewa" => $tanggal_check_in
    ];

    $stmt->execute($params);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}

function tampilkan_data($data, $db, $id_field)
{
    global $db;

    $result_record = htmlspecialchars($data["result_record"]);

    $sql = "";

    if ($result_record <= 10) {
        $sql = "SELECT * FROM $db ORDER BY $id_field DESC LIMIT 0, $result_record";
    } else {
        $skip = $result_record / 10;

        $sql = "SELECT * FROM $db ORDER BY $id_field DESC LIMIT $skip, $result_record";
    }

    $stmt = $db->prepare($sql);

    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}

function hapus($id)
{
    global $db;

    $id = htmlspecialchars($id);

    $sql = "DELETE FROM kamar WHERE id_kamar=:id_kamar";

    $stmt = $db->prepare($sql);

    // bind parameter ke query
    $params = [":id_kamar" => $id];

    $stmt->execute($params);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}

function ubah($data)
{
    global $db;

    $id_kamar = htmlspecialchars($data['id_kamar']);
    $nama_kamar = htmlspecialchars($data['nama_kamar']);
    $biaya_sewa = htmlspecialchars($data['biaya_sewa']);

    $sql = "UPDATE kamar SET
            id_kamar=:id_kamar,
            nama_kamar=:nama_kamar, 
            biaya_sewa=:biaya_sewa";

    $stmt = $db->prepare($sql);

    // bind parameter ke query
    $params = [
        ":id_kamar" => $id_kamar,
        ":nama_kamar" => $nama_kamar,
        ":biaya_sewa" => $biaya_sewa
    ];

    $stmt->execute($params);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}
