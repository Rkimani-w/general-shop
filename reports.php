<?php
include 'protect.php';
require 'connect.php';
$sql = "SELECT customers.names AS customer, products.title, products.price, sales,date_sold, users.names AS user
FROM customers
JOIN sales ON customer_id = sales.customer_id
JOIN products ON product_id = sales.product_id
JOIN users ON user_id = sales.user_id ORDER BY sales.date_sold DESC";

if (isset($_GET["start_date"])    and isset($_GET["end_date"]) )
{
  $start = $_GET ["start_date"];
  $end = $_GET["end_date"];
    $sql = "SELECT customers.names AS customer, products.title, products.price, sales,date_sold, users.names AS user
FROM customers
JOIN sales ON customer_id = sales.customer_id
JOIN products ON product_id = sales.product_id
JOIN users ON user_id = sales.user_id 
WHERE sales.date_sold BETWEEN '$start' AND '$end'
ORDER BY sales.date_sold DESC";



}
$result = mysqli_query($con, $sql) or die( mysqli_error($con) );// executing the query
$rows = mysqli_fetch_all($result, 1);//assoc array
mysqli_close($con);//close the connection
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "style_links.php" ?>
    <title>report</title>
</head>
<body>
<?php include 'nav.php' ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <form action="reports.php" method="get" class="form-inline mt-2 mb-2">
            <div class="form-group">
                <label>start date</label>
                <input type="date" max="<?=date("y-m-d")?>" value="2021-01-01" class="form-control" name="start_date">
            </div>
                <div class="form-group">
                    <label>end date</label>
                    <input type="date" max="<?=date("y-m-d")?>" value="<?=date("y-m-d")?>" class="form-control" name="end_date">
                </div>
                <button class="btn btn-info ml-3">filter</button>

            </form>

            <table id="example" class="table table-hover">
                <thead>
                <tr>
                    <th>customer</th>
                    <th>title</th>
                    <th>cost</th>
                    <th>user</th>
                    <th>date</th>
                </tr>
                </thead>

                <tbody>
                <?php foreach ($rows as $product): ?>
                    <tr>
                        <td> <?= $product ["customer"]  ?> </td>
                        <td> <?= $product  ["title"]  ?> </td>
                        <td> <?= $product ["price"]  ?> </td>
                        <td> <?=$product ["user"]  ?> </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                <tr>




                </tr>


                </tfoot>


            </table>
        </div>
    </div>
</div>
<script src="js/jquery.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.24/api/sum().js"></script>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
     } );
    // $('#example').DataTable( {
    //     drawCallback: function () {
    //         var api = this.api();
    //         $( api.table().footer() ).html(
    //             api.column( 2, {page:'current'} ).data().sum()
    //         );
    //     }
    // } );

</script>
</body>
</html>
