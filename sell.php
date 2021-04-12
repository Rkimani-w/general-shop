<?php
include 'protect.php';
require 'connect.php';
$sql = "SELECT * FROM products";
$result = mysqli_query($con, $sql) or die( mysqli_error($con) );// executing the query
$rows = mysqli_fetch_all($result, 1);//assoc array
mysqli_close($con);//close the connection
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "style_links.php" ?>
    <title>Cart</title>
</head>
<body>
<?php include 'nav.php' ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <?php
            if(isset($_SESSION['products']))
                //$no_of_items = count($_SESSION["products"]);//can add an items more than once like in a shop.
                $no_of_items = count(array_unique($_SESSION["products"]));//ensures we have unique items only
            ?>
            <p class="text-info">You have <?= $no_of_items??0 ?> items in your cart</p>
            <a href="checkout.php" class="btn btn-outline-info btn-sm mb-1">Check Out</a>
            <table id="example" class="table table-hover">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Genre</th>
                        <th>Description</th>
                        <th>Poster</th>
                        <th>Add</th>
                    </tr>
                </thead>

                <tbody>
                <?php foreach ($rows as $product): ?>
                    <tr>
                        <td> <?= $product["title"] ?> </td>
                        <td> <?= $product["genre"] ?> </td>
                        <td> <?= $product["description"] ?> </td>
                        <td> <img src="<?=$product['poster']?>" width="60" height="60" alt=""> </td>
                        <td> <a class="btn btn-info btn-sm" href="add_to_cart.php?id=<?=$product["id"]?>">Add To Cart</a>  </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="js/jquery.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>
</body>
</html>