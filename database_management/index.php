<?php

require_once "./DatabaseConfig.php";

$dbc = new DatabaseConfig();



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple CRUD</title>

    <!-- bootstrap 5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.min.js"></script>

    <!-- styles -->
    <link rel="stylesheet" href="./style.css">
</head>

<body>

    <main class="center">
        <h1 class="text-center">
            <a href="./index.php">
                Connected to:
                <?php
                echo $dbc->getDatabaseName()
                ?>
            </a>
        </h1>
        <div class="left">
            <h2>Product</h2>
            <form action="./actions.php" method="post">
                <?php

                if (isset($_GET["prod_id"]) && !empty($_GET["prod_id"])) {
                    $prod_id = $_GET["prod_id"];
                    $row = $dbc->select("product", where: ["id" => $prod_id])[0];
                }


                ?>
                <input type="hidden" name="id" value="<?php echo !empty($row) ?  $row["id"] : "" ?>">
                <div class="input-pane">
                    <label for="productName">Name</label>
                    <input type="text" name="productName" id="productName" value="<?php echo !empty($row) ?  $row["name"] : "" ?>">
                </div>
                <div class="input-pane">
                    <label for="price">Price</label>
                    <input type="text" name="price" id="price" value="<?php echo !empty($row) ? $row["price"] : "" ?>">
                </div>
                <div class="input-pane">
                    <label for="quantity">Quantity</label>
                    <input type="text" name="quantity" id="quantity" value="<?php echo !empty($row) ? $row["quantity"] : "" ?>">
                </div>

                <!-- CRUD -->
                <div class="actions-pane">

                    <input type="submit" value="Create" class="btn btn-success" name="action">
                    <input type="submit" value="Update" class="btn btn-success" name="action">
                    <input type="submit" value="Read" class="btn btn-info" name="action">
                    <input type="submit" value="Delete" class="btn btn-danger" name="action">

                </div>
            </form>
        </div>
        <div class="right">
            <h3>Selected Row:
                <span id="selectedRowID" name="selectedRowID">
                    <?php echo !empty($row) ?  $row["id"] : "" ?>
                </span>
            </h3>
            <div class="table-pane">
                <table class="table table-primary table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        try {
                            $res = $dbc->select("product");
                        } catch (Exception $e) {
                        }
                        ?>

                        <?php foreach ($res as $i => $row) : ?>
                            <tr scope="row" id="<?php echo $row["id"] ?>" onclick="rowClicked(this)">
                                <?php foreach ($row as $col => $val) : ?>
                                    <td><?php echo $val ?></td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
        <p>
            Log
            <br>
            <?php


            ?>
        </p>
    </main>
    <script src="./index.js"></script>
</body>

</html>