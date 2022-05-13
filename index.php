<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Document</title>
</head>
<?php
    //mysqli_connect
    $db = mysqli_connect("localhost", "root", "", "deneme");
    if (!$db) {
        die("Bağlantı Hatası: " . mysqli_connect_error());
    }
    $sql = "SELECT id, ad, soyad, tel, cinsiyet, sehir FROM users";
    $result = mysqli_query($db, $sql); 
?>
<body>
    </br>
    <div class="container">
        <div class="row">
            <h2>Kullanıcı Bilgileri</h2>
            <form action="<?php $PHP_SELF ?>" method="POST">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="isim">Ad:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="isim" placeholder="Adınız" name="isim" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="soyad">Soyad:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="soyad" placeholder="Soyadınız" name="soyad" required>
                    </div>
                </div> 
                <div class="form-group">
                    <label class="control-label col-sm-2" for="tel">Telefon:</label>
                    <div class="col-sm-6">
                        <input type="number" class="form-control" id="tel" placeholder="0000000000" name="tel" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="cinsiyet">Cinsiyet:</label> 
                    <div class="col-sm-6">
                        <input type="radio" id="cinsiyet" name="cinsiyet" value="Kadın" required>Kadın
                        <input type="radio" id="cinsiyet" name="cinsiyet" value="Erkek">Erkek
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="tel">Şehir:</label> 
                    <div class="col-sm-6">
                    <select name="sehir" class="form-select" required> 
                        <option value="İstanbul">İstanbul</option>
                        <option value="Ankara">Ankara</option>
                        <option value="İzmir">İzmir</option>
                        </select>
                    </div>
                </div>
                </br>
                <div class="form-group">        
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" name="btn-ekle" class="btn btn-primary">Ekle</button>
                    </div>
                </div>
            </form>
        </div>
        <?php 
            if(isset($_POST['btn-ekle'])){
                $isim = $_POST['isim'];
                $soyad = $_POST['soyad'];
                $tel = $_POST['tel'];
                $cinsiyet = $_POST['cinsiyet'];
                $sehir = $_POST['sehir'];
                $sql = "INSERT INTO users (ad, soyad, tel, cinsiyet, sehir) VALUES ('$isim', '$soyad', '$tel', '$cinsiyet', '$sehir')";
                
                if (mysqli_query($db, $sql)) {
                    header('Location: index.php');
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($db);
                }
            } 
        ?>
        </br></br>
        <div class="row">
            <h2>Eklenen Bilgiler</h2>
            <table class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Ad</th>
                    <th scope="col">Soyad</th>
                    <th scope="col">Telefon</th>
                    <th scope="col">Cinsiyet</th>
                    <th scope="col">Şehir</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <th scope="row"><?php echo $row["id"]; ?></th>
                                <td><?php echo $row["ad"]; ?></td>
                                <td><?php echo $row["soyad"]; ?></td>
                                <td><?php echo $row["tel"]; ?></td> 
                                <td><?php echo $row["cinsiyet"]; ?></td>
                                <td><?php echo $row["sehir"]; ?></td>
                            </tr>
                        <?php }
                    }else{ ?>
                        <tr>
                            <th scope="row">0</th>
                            <td colspan="6">Kayıt Yok</td>
                        </tr> 
                    <?php } ?> 
            </tbody>
            </table>
        </div> 
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>