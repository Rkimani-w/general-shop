<?php

include 'protect.php';
if (isset($_REQUEST["title"])) {
//Get our form data
    $title = $_REQUEST["title"]; //$_GET $_POST
    $description = $_REQUEST["description"];
    $price = $_REQUEST["price"];
    $genre = $_REQUEST["genre"];

    $target_dir = "uploads/";
    $target_file = $target_dir . rand(1000000, 10000000) . basename($_FILES["poster"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed_types = ["png", "jpeg", "jpg", "gif"];
    $allowed = in_array($imageFileType, $allowed_types);
    if ($allowed and move_uploaded_file($_FILES["poster"]["tmp_name"], $target_file)) {
        $status = 1;
    } else {
        $status = 2;
    }


    require_once 'connect.php';
    //$sql = "INSERT INTO `products`(`id`, `title`, `poster`, `description`, `genre`, `price`)
            //     VALUES (null,'$title','$target_file','$description','$genre','$price')";
    //mysqli_query($con, $sql) or die(mysqli_error($con));// executing the query


    $stmt = mysqli_prepare($con , "INSERT INTO `products`( `title`, `poster`, `description`, `genre`, `price`) VALUES (?,?,?,?,?)");
    mysqli_stmt_bind_param($stmt , "ssssi", $title, $target_file, $description, $genre, $price);
    mysqli_stmt_execute($stmt);
    mysqli_close($con);//close the connection

}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>new product</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<?php include 'nav.php'?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-5">
            <h4>new product</h4>



            <form action="add-products.php" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" name="title" required>
                </div>

                <div class="form-group">
                    <label>Poster</label>
                    <input type="file" accept="image/*" class="form-control-file border" name="poster" required>
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label>Genre</label>
                    <select name="genre" class="form-control">
                        <option value="Thriller">Thriller movie</option>
                        <option value="Documentary">Documentary movie</option>
                        <option value="Horror">Horror movie</option>
                        <option value="Action">Action movie</option>
                        <option value="Romance">Romance movie</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>price</label>

                    <input type="number" class="form-control" name="price" required>
                </div>


                <button class="btn btn-danger">add customers</button>

            </form>
        </div>
    </div>
</div>


</body>
</html>
