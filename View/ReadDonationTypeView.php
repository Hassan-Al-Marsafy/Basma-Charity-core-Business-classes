<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Read Donation Type</title>
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
                        <h2>Put an ID to Read Donation Type</h2>
                    </div>
                    <p>Please fill this form and submit to read donation type from the database.</p>
                    <form action="../Controller/ReadDonationType.php" method="GET">
                        <div class="form-group">
                            <label>Donation Type ID</label>
                            <input type="text" name="id" class="form-control" maxlength="50" required>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="../View/OutputReadDonationTypeView.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
