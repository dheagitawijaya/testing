<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "project";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) { //cek koneksi
    die("Tidak bisa terkoneksi ke database");
}
$no         = "";
$surat      = "";
$ayat       = "";
$sukses     = "";
$error      = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if($op == 'delete'){
    $id         = $_GET['id'];
    $sql1       = "delete from inputan where id = '$id'";
    $q1         = mysqli_query($koneksi,$sql1);
    if($q1){
        $sukses = "Berhasil hapus data";
    }else{
        $error  = "Gagal melakukan delete data";
    }
}
if ($op == 'edit') {
    $id              = $_GET['id'];
    $sql1            = "select * from inputan where id = '$id'";
    $q1              = mysqli_query($koneksi, $sql1);
    $r1              = mysqli_fetch_array($q1);
    $no              = $r1['no'];
    $surat           = $r1['surat'];
    $ayat            = $r1['ayat'];

    if ($no == '') {
        $error = "Data tidak ditemukan";
    }
}
if (isset($_POST['simpan'])) { //untuk create
    $no               = $_POST['no'];
    $surat            = $_POST['surat'];
    $ayat             = $_POST['ayat'];

    if ($no && $surat && $ayat) {
        if ($op == 'edit') { //untuk update
            $sql1       = "update inputan set no = '$no',surat='$surat',ayat = '$ayat'";
            $q1         = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error  = "Data gagal diupdate";
            }
        } else { //untuk insert
            $sql1   = "insert into inputan (no,surat,ayat) values ('$no','$surat','$ayat')";
            $q1     = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses     = "Berhasil memasukkan data baru";
            } else {
                $error      = "Gagal memasukkan data";
            }
        }
    } else {
        $error = "Silakan masukkan semua data";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>checklist</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <style>
        .mx-auto {
            width: 800px
        }

        .card {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="mx-auto">
        <!-- untuk memasukkan data -->
        <div class="card">
            <div class="card-header">
                Create / Edit Bacaan
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                    header("refresh:5;url=catatan.php");//5 : detik
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php
                    header("refresh:5;url=catatan.php");
                }
                ?>
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="no" class="col-sm-2 col-form-label">NO</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="no" name="no" value="<?php echo $no ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="surat" class="col-sm-2 col-form-label">SURAT</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="surat" name="surat" value="<?php echo $surat ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="ayat" class="col-sm-2 col-form-label">AYAT</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="ayat" name="ayat" value="<?php echo $ayat ?>">
                        </div>
                    </div>
        
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
                        <!-- <input type="submit" name="home" value="Home" class="btn btn-primary"/> <a href="index.html"></a> -->
                       <button class="btn btn-primary" type="button" ><a style="color: #FFFFFF; text-decoration: none;" href="index.html">Home</a></button>

                    </div>
                </form>
            </div>
        </div>

        <!-- untuk mengeluarkan data -->
        <div class="card">
            <div class="card-header text-white bg-secondary">
                Data Bacaan
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">NO</th>
                            <th scope="col">SURAT</th>
                            <th scope="col">AYAT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql2   = "select * from inputan order by id desc";
                        $q2     = mysqli_query($koneksi, $sql2);
                        $urut   = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id             = $r2['id'];
                            $no             = $r2['no'];
                            $surat          = $r2['surat'];
                            $ayat           = $r2['ayat'];

                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $no ?></td>
                                <td scope="row"><?php echo $surat ?></td>
                                <td scope="row"><?php echo $ayat ?></td>
                                <td scope="row">
                                    <a href="catatan.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                    <a href="catatan.php?op=delete&id=<?php echo $id?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="btn btn-danger">Delete</button></a>            
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>
</body>

</html>in