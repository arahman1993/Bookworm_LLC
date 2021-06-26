<?php
require_once "config.php";
session_start();

$message  = "";
if ( $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addEmployee'])) {
  $eid = trim($_POST['EID']);
  $fname = trim($_POST['firstName']);
  $lname = trim($_POST['lastName']);
  $type = trim($_POST['type']);
  $salary = trim($_POST['salary']);
  $phone = trim($_POST['Phone']);
  $bid = trim($_POST['BID']);

  if($query = $conn->prepare("INSERT INTO Employee VALUES (?,?,?,?,?,?,?)")) {
    $query->bind_param('sssssss', $eid, $fname, $lname, $type, $salary, $phone, $bid );
    $result = $query->execute();
    print_r($result);
    if (empty($result)){
      $error = "Invalid Data";
    }
    else{
      $message = "Added new employee succesfully!";
    }

  }
}


if($query = $conn->prepare("SELECT * FROM Employee WHERE type='M' OR type='B'")) {
  $query->execute();
  $employees = $query->get_result();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Employee</title>
    <link rel="stylesheet"
href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  </head>
  <body>
      <div class="container">
          <form action="" method="post" name="addEmployeeForm">
          <!-- <div class="col-md-8"> -->
            <!-- <h2>Login</h2>
            <p>Please fill in your email and password.</p> -->
            <div class="form-row">

              <div class="form-group col-md-4">
                <label>EID</label>
                <input type="EID" name="EID" class="form-control" required />
              </div>

              <div class="form-group col-md-4">
                <label>First Name</label>
                <input type="firstName" name="firstName" class="form-control" required>
              </div>

              <div class="form-group col-md-4">
                <label>Last Name</label>
                <input type="lastName" name="lastName" class="form-control" required>
              </div>

              <div class="form-group col-md-4">
                <label>Type(M or B)</label>
                <input type="type" name="type" class="form-control" required>
              </div>

              <div class="form-group col-md-4">
                <label>Salary</label>
                <input type="salary" name="salary" class="form-control" required>
              </div>

              <div class="form-group col-md-4">
                <label>Phone</label>
                <input type="Phone" name="Phone" class="form-control" required>
              </div>

              <div class="form-group col-md-4">
                <label>BID</label>
                <input type="BID" name="BID" class="form-control" required>
              </div>

              <div class="form-group col-md-4">
                <label> </br></br> </label>
                <input type="submit" name="addEmployee" style="margin-top:25px;" class="btn btn-primary" value="Submit">
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
                   <th>EID</th>
                   <th>First Name</th>
                   <th>Last Name</th>
                   <th>Type</th>
                   <th>Salary</th>
                   <th>Phone</th>
                   <th>BID</th>
                   <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
                while($employee = $employees->fetch_assoc()) {
                  echo "<tr>" .
                    "<td>" . $employee["EID"] . "</td>" .
                    "<td>" . $employee["fname"] . "</td>" .
                    "<td>" . $employee["lname"] . "</td>" .
                    "<td>" . $employee["type"] . "</td>" .
                    "<td>" . $employee["salary"] . "</td>" .
                    "<td>" . $employee["phone"] . "</td>" .
                    "<td>" . $employee["BID"] . "</td>" .
                    "</tr>";

                }
                 ?>
              </tbody>
            </table>
          </div>

  </body>
</html>
