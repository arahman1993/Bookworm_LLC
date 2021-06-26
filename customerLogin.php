<?php
require_once "config.php";
session_start();
$error = '';

if ( $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
  $fname = trim($_POST['fname']);
  $lname = trim($_POST['lname']);
  // validate if fname is empty
  if (empty($fname)) {
    $error .= '<p class="error">Please enter your first name.</p>';
  }
  // validate if lname is empty
  if (empty($lname)) {
    $error .= '<p class="error">Please enter your last name.</p>';
  }
  if (empty($error)) {
    if($query = $conn->prepare("SELECT * FROM Customer WHERE fname = ?")) {
      $query->bind_param('s', $fname);
      $query->execute();
      $row = $query->get_result();

    //  $query->store_result();
    //  print_r($query);
    //  print_r($query->num_rows);
      //print_r($row);
      //print_r($user);

      if ($row) {
        $user = $row->fetch_assoc();
        if ($lname == $user['lname']){
          $_SESSION["cid"] = $user["CID"];

          header("location: dashboardC.php");
          exit;

        } else {
            $error .= '<p class="error">The lname is not valid.</p>';

        }
      } else {
          $error .= '<p class="error">The fname is not valid.</p>';
      }
    }
    $query->close();
  }
  // Close connection
  mysqli_close($conn);
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet"
href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  </head>
  <body>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2>Customer Login</h2>
            <p>Please fill in your first and last name.</p>
            <form action="" method="post">

              <div class="form-group">
                <label>First Name</label>
                <input type="fname" name="fname" class="form-control" required />
              </div>

              <div class="form-group">
                <label>Last Name</label>
                <input type="lname" name="lname" class="form-control" required>
              </div>

              <div class="form-group">
                <input type="submit" name="submit" class="btn btn-primary" value="Submit">
              </div>
              <p><?php if (!empty($error)) echo $error; ?></p>
            </form>
          </div>
        </div>
      </div>
  </body>
</html>
