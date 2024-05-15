<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Donation Detail</title>
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
                        <h2>Create Donation Detail</h2>
                    </div>
                    <p>Please fill this form and submit to add user to the database.</p>
                    <form action="../controller/CreateDonDetailController.php" method="post">
                        <div class="form-group">
                            <label>Donation Id</label>
                            <input type="number" name="donationId" class="form-control" maxlength="50" required>
                        </div>
                        <div class="form-group">
                            <label>Donation Type Id</label>
                            <input type="number" name="donationTypeId" class="form-control" maxlength="50" required>
                            
                        </div>
                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" name="donationquantity" class="form-control" required>
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