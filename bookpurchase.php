<?php
require_once "config.php";
session_start();

$message  = "";
if ( $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
  $isbn = trim($_POST['isbn']);
  if($query = $conn->prepare("UPDATE Book SET count = count-1 WHERE isbn=?")) {
    $query->bind_param('s', $isbn);
    $result= $query->execute();
    //print_r($query);
    $tid = "T99";
    $cid = "C00";
    $eid = $_SESSION["eid"];
    if ($query->affected_rows >= 1){
      $message = "Purchase succesfull for ".$isbn;
      if ($query = $conn->prepare("SELECT count(*) AS total_transactions FROM Transactions")) {
        $query->execute();
        $row = $query->get_result();
        $row = $row->fetch_assoc();
        $tid = "T" . $row["total_transactions"];
      }
      if ($query = $conn->prepare("INSERT INTO Transactions (TID, ISBN, CID, EID, `date`) VALUES (?,?,?,?,?)")) {
        $today = date("Y-m-d");
        $query->bind_param("sssss", $tid, $isbn, $cid, $eid, $today);
        $query->execute();

      }
    }
  }
}
if($query = $conn->prepare("SELECT * FROM Book WHERE count > 0")) {
  $query->execute();
  $books = $query->get_result();
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet"
href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<script>
  function purchaseBook(isbn){
  //  alert(isbn);
    document.getElementById("isbn").value = isbn;
    document.getElementById("submitBtn").click();
  }
</script>
  </head>
  <body>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <p><?php if (!empty($message)) echo $message; ?></p>
          </div>
          <div class="col-md-12">
            <table class="table table-striped">
              <thead>
                 <tr>
                   <th>ISBN</th>
                   <th>Title</th>
                   <th>Author</th>
                   <th>Price</th>
                   <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
                while($book = $books->fetch_assoc()) {
                  echo "<tr>" .
                    "<td>" . $book["ISBN"] . "</td>" .
                    "<td>" . $book["title"] . "</td>" .
                    "<td>" . $book["Author"] . "</td>" .
                    "<td>" . $book["price"] . "</td>" .
                    "<td>" . "<button type='button' class='btn btn-primary' onclick = purchaseBook('".$book["ISBN"]."') >Purchase </button> " .  "</td>" .
                    "</tr>";

                }
                 ?>
              </tbody>
            </table>
            <form action="" method="post" name="purchaseForm" id="purchaseForm">
              <input type="hidden" name="isbn" id="isbn"/>
              <input type="submit" name="submit" class="btn btn-primary" value="Submit" style="display:none;" id="submitBtn">
            </form>
  </body>
</html>
