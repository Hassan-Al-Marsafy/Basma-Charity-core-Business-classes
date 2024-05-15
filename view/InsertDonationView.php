<!DOCTYPE html>
<html lang="en">
<?php require_once '../controller/InsertDonationController.php'; ?>
<head>
    <meta charset="UTF-8">
    <title>Add donation</title>
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
                        <h2>Add donation</h2>
                    </div>
                    <p>Please fill this form and submit to add donation to the database.</p>
                    <form action="../controller/InsertDonationController.php" method="post">
                        <div class="form-group">
                            <label>Date</label>
                            <input type="date" name="date" class="form-control" maxlength="50" required>
                        </div>
                        <div class="form-group">
                            <label>User id</label>
                            <input type="number" name="user_id" class="form-control" maxlength="50" required>
                        </div>
                        <div class="form-group">
                            <label>accountant id</label>
                            <input type="number" name="accountant_id" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Manager id</label>
                            <input type="number" name="manager_id" class="form-control" required>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="../index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>