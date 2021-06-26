<?php
require_once "config.php";
session_start();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <link rel="stylesheet"
href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  </head>
  <body>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h3> Welcome </h3><br>
            <p><a href="bookpurchase.php">Purchase Book</a></p>
            <p><a href="searchoption.html">Search</a></p>
            <p><a href="inventory.php">Inventory</a></p>
            <p><a href="audit.php">Audit</a></p>
            <p><a href="employees.php">Employee's</a></p>

          </div>
  </body>
</html>
