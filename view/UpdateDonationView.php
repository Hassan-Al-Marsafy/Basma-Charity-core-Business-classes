<!DOCTYPE html>
<html lang="en">
<?php require_once '../controller/UpdateDonationController.php'; ?>

<head>
  <meta charset="UTF-8">
  <title>Update donation</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
  <style type="text/css">
    .wrapper {
      width: 500px;
      margin: 0 auto;
    }
  </style>
</head>

<body>
  <div class="wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="page-header">
            <h2>Update donation</h2>
          </div>
          <p>Please fill this form and submit to update donation to the database.</p>
          <form action="../controller/UpdateDonationController.php" method="post">
            <div class="form-group">
              <label>id</label>
              <input type="number" name="id" class="form-control" maxlength="50" value="<?php echo $id; ?>" readonly>
            </div>
            <div class="form-group">
              <label>Date</label>
              <input type="date" name="date" class="form-control" maxlength="50" value="<?php echo $date; ?>" required>
            </div>
            <div class="form-group">
              <label>User id</label>
              <input type="number" name="user_id" class="form-control" maxlength="50" value="<?php echo $user_id; ?>"
                required>
            </div>
            <div class="form-group">
              <label>accountant id</label>
              <input type="number" name="accountant_id" class="form-control" value="<?php echo $accountant_id; ?>"
                required>
            </div>
            <div class="form-group">
              <label>Manager id</label>
              <input type="number" name="manager_id" class="form-control" value="<?php echo $manager_id; ?>"
                required>
            </div>
            <input type="submit" class="btn btn-primary" value="Submit">
            <a href="ChooseDonationCRUD.php" class="btn btn-default">Cancel</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>