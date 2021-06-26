<?php
require_once "config.php";
session_start();

$message  = "";
if ( $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addInventory'])) {
  $isbn = trim($_POST['ISBN']);
  $title = trim($_POST['Title']);
  $author = trim($_POST['Author']);
  $publisher = trim($_POST['Publisher']);
  $edition = trim($_POST['Edition']);
  $price = trim($_POST['Price']);
  $count = trim($_POST['Count']);
  $genre = trim($_POST['Genre']);

  if($query = $conn->prepare("INSERT INTO Book VALUES (?,?,?,?,?,?,?,?)")) {
    $query->bind_param('ssssssss', $isbn, $title, $author, $publisher, $edition, $price, $count, $genre );
    $result = $query->execute();
    print_r($result);
    if (empty($result)){
      $error = "Invalid Data";
    }
    else{
      $message = "Created new inventory succesfully!";
    }

  }
}

if ( $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editCount'])) {
  $isbn = trim($_POST['isbn']);
  $count = trim($_POST['count']);

  $error = "Update Failed";

  if($query = $conn->prepare("UPDATE Book SET count = $count WHERE isbn=?")) {
    $query->bind_param('s', $isbn);
    $result= $query->execute();

    if (empty($result)){
      $error = "Update Failed";
    }
    else{
      $error="";
      $message = "Count update succefully!";
    }

  }
}

if($query = $conn->prepare("SELECT * FROM Book")) {
  $query->execute();
  $books = $query->get_result();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <link rel="stylesheet"
href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<script>
  function editCount(isbn, count){
    var count=prompt("Please enter new count.", count);
    // alert(isbn);
    document.getElementById("isbn").value = isbn;
    document.getElementById("count").value = count;
    document.getElementById("editCountSubmitBtn").click();
  }
</script>
  </head>
  <body>
      <div class="container">
          <form action="" method="post" name="addInventoryForm">
          <!-- <div class="col-md-8"> -->
            <!-- <h2>Login</h2>
            <p>Please fill in your email and password.</p> -->
            <div class="form-row">

              <div class="form-group col-md-4">
                <label>ISBN</label>
                <input type="ISBN" name="ISBN" class="form-control" required />
              </div>

              <div class="form-group col-md-4">
                <label>Title</label>
                <input type="Title" name="Title" class="form-control" required>
              </div>

              <div class="form-group col-md-4">
                <label>Author</label>
                <input type="Author" name="Author" class="form-control" required>
              </div>

              <div class="form-group col-md-4">
                <label>Publisher</label>
                <input type="Publisher" name="Publisher" class="form-control" required>
              </div>

              <div class="form-group col-md-4">
                <label>Edition</label>
                <input type="Edition" name="Edition" class="form-control" required>
              </div>

              <div class="form-group col-md-4">
                <label>Price</label>
                <input type="Price" name="Price" class="form-control" required>
              </div>

              <div class="form-group col-md-4">
                <label>Count</label>
                <input type="Count" name="Count" class="form-control" required>
              </div>

              <div class="form-group col-md-4">
                <label>Genre</label>
                <input type="Genre" name="Genre" class="form-control" required>
              </div>

              <div class="form-group col-md-4">
                <label> </br></br> </label>
                <input type="submit" name="addInventory" style="margin-top:25px;" class="btn btn-primary" value="Submit">
              </div>
              <p><?php if (!empty($error)) echo $error; ?></p>
          </div>
        </form>

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
                   <th>Publisher</th>
                   <th>Edition</th>
                   <th>Price</th>
                   <th>Count</th>
                   <th>Genre</th>
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
                    "<td>" . $book["Publisher"] . "</td>" .
                    "<td>" . $book["Edition"] . "</td>" .
                    "<td>" . $book["price"] . "</td>" .
                    "<td>" . $book["count"] . "</td>" .
                    "<td>" . $book["genre"] . "</td>" .
                    "<td>" . "<button type='button' class='btn btn-primary' onclick = editCount('".$book["ISBN"]."',".$book["count"].") >Edit Count </button> " .  "</td>" .
                    "</tr>";

                }
                 ?>
              </tbody>
            </table>
          </div>
            <form action="" method="post" name="editCountForm" id="editCountForm">
              <input type="hidden" name="isbn" id="isbn"/>
              <input type="hidden" name="count" id="count"/>
              <input type="submit" name="editCount" class="btn btn-primary" value="Submit" style="display:none;" id="editCountSubmitBtn">
            </form>
  </body>
</html>
