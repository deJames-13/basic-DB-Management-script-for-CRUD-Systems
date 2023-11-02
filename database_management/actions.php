<?php
require_once "./DatabaseConfig.php";

$dbc = new DatabaseConfig();

try {
    if (isset($_POST["action"])) {
        switch ($_POST["action"]) {
            case 'Create':
                if (empty($_POST["productName"]) || empty($_POST["price"]) || empty($_POST["quantity"])) {
                    break;
                }
                $dbc->insert_into(
                    tableName: "product",
                    data: [
                        "name" => $_POST["productName"],
                        "price" => $_POST["price"],
                        "quantity" => $_POST["quantity"]
                    ]
                );
                break;

            case 'Delete':
                if (isset($_POST["id"])) {
                    $dbc->delete_from("product", where: ["id" => $_POST["id"]]);
                }
                break;
            case 'Read':
                break;
            case 'Update':
                if (isset($_POST["id"])) {
                    $dbc->update_into(
                        tableName: "product",
                        data: [
                            "name" => $_POST["productName"],
                            "price" => $_POST["price"],
                            "quantity" => $_POST["quantity"]
                        ],
                        where: [
                            "id" => $_POST["id"]
                        ]

                    );
                }
                break;

            default:
                break;
        }
    }
    header("Location: ./index.php");
} catch (Exception $e) {
    echo $e->getTraceAsString();
}
