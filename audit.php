<?php
require_once "config.php";
session_start();

if ( $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['generateReport'])) {
  $month = trim($_POST['monthDropDown']);

  if($query = $conn->prepare("SELECT t.*, b.price FROM Transactions AS t JOIN Book AS b ON t.ISBN = b.ISBN WHERE DATE_FORMAT(t.date,'%M, %Y')='$month'")) {
    $query->execute();
    $transactions = $query->get_result();
  }
}

if($query = $conn->prepare("SELECT DISTINCT DATE_FORMAT(date,'%M, %Y') AS m FROM Transactions")) {
  $query->execute();
  $months = $query->get_result();
}
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
      <form action="" method="post" name="addInventoryForm">
        <div class="form-row">
          <div class="form-group col-md-6">

            <label>Select Month</label>
            <select name="monthDropDown" class="form-control">
              <?php
              while($month = $months->fetch_assoc()) {
                echo "<option>" . $month["m"] .

                  "</option>";

              }
               ?>
            </select>

          </div>
          <div class="form-group col-md-6">
            <label> </br></br> </label>
            <input type="submit" name="generateReport" style="margin-top:25px;" class="btn btn-primary" value="Generate Report">
          </div>
        </div>
      </form>
      <div class="row">
        <div class="col-md-12">
          <table class="table table-striped">
            <thead>
               <tr>
                 <th>TID</th>
                 <th>ISBN</th>
                 <th>CID</th>
                 <th>EID</th>
                 <th>Date</th>
                 <th>Price</th>
                 <th></th>
              </tr>
            </thead>
            <tbody>
              <?php
              $total = 0;
              if (isset($transactions)){

                while($t = $transactions->fetch_assoc()) {
                  echo "<tr>" .
                    "<td>" . $t["TID"] . "</td>" .
                    "<td>" . $t["ISBN"] . "</td>" .
                    "<td>" . $t["CID"] . "</td>" .
                    "<td>" . $t["EID"] . "</td>" .
                    "<td>" . $t["date"] . "</td>" .
                    "<td>" . $t["price"] . "</td>" .
                    "</tr>";

                    $total += $t["price"];

                }
                echo "<tr><td colspan=5>Total</td><td>$total</td></tr>";
            }
            else{
              echo "Please select a month and generate a report";
            }
               ?>
            </tbody>
          </table>
        </div>
        <div class="col-md-12">


        </div>
      </div>
    </div>

  </body>
</html>
