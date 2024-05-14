<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create User</title>
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
                        <h2>Update Donation Type</h2>
                    </div>
                    <p>Please fill this form and submit to Updatet donation type to the database.</p>
                    <form action="../controller/UpdateDonationType.php" method="POST">
                        <div class="form-group">
                            <label>ID</label>
                            <input type="id" name="id" class="form-control" maxlength="50" required>
                        </div>
                        <div class="form-group">
                            <label> Update Donation Type ID</label>
                            <input type="type" name="type" class="form-control" maxlength="50" required>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="../home.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
