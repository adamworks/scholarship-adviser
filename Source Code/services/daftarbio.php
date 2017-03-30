<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include_once 'config.php';
include_once 'fungsidb.php';
//require_once ("fungsidb.php");
// $filterdata = $_POST['filterdata'];
$username  = $_GET['user'];
$fname     = $_GET['fnama'];
$lname     = $_GET['lnama'];
$gender    = $_GET['gender'];
$birth     = $_GET['birth'];
$pend      = $_GET['pend'];
$univid     = $_GET['univ'];
$prodi     = $_GET['prodi'];



if(empty($fname) || empty($lname) || empty($univid)){
  //if(empty($nama) || empty($pass)){
  die(msg(0,"data harus diisi"));
}

// //declare kategori
//   $kategori = mysql_real_escape_string($pend);
//   if(!$jenj_id = kategori_exists($kategori)) //cek kategori ada/tidak di DB
//   {
//     die('kategori tidak ada');
//   }

//   //declare kategori
//   $program = mysql_real_escape_string($prodi);
//   if(!$prodi_id = program_exists($program)) //cek kategori ada/tidak di DB
//   {
//     die('kategori tidak ada');
//   }

$sql = mysql_query("SELECT id FROM db_user WHERE username ='$username'");
$rows = mysql_num_rows($sql);

if ($rows == 1) {
  $row=mysql_fetch_array($sql);
  // $result = mysql_query("INSERT INTO db_userd2(id_user,fnama,lnama,universitas_id,pendidikan_id,jurusan_id) 
  //           VALUES('".$row['id']."','$fname','$lname','$univid','$pend','$prodi')");
  // $result = mysql_query("INSERT INTO db_userd2(id_user,fnama,lnama,universitas_id,pendidikan_id,jurusan_id) 
  //           VALUES('".$row['id']."','$fname','$lname','$univid','$pend','$prodi')");
  $result = mysql_query("INSERT INTO db_userdetail(user_id,fnama,lnama,id_pendidikan,universitas,id_jurusan,birth,gender) 
            VALUES('".$row['id']."','$fname','$lname','$pend','$univid','$prodi','$birth','$gender')");
  // $uid = mysql_insert_id();
  // mkdir("member/$uid", 0755);
  // mkdir("member/$uid/foto", 0755);
  die(msg(1,"daftar biodata Berhasil diisi"));
}
else {
  // Registrasi gagal
  die(msg(0,"daftar gagal"));
}

function msg($status,$txt) {
  return '{"status":'.$status.',"txt":"'.$txt.'"}';
}
?>