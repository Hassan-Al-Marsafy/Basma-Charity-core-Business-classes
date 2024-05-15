<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Donation Type</title>
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
                        <h2>Delete Donation Type</h2>
                    </div>
                    <form action="../controller/DeleteDonationType.php" method="post">
                        <div class="form-group">
                            <label for="id">Donation Type ID:</label>
                            <input type="text" id="id" name="id" class="form-control" required>
                        </div>
                        <div class="alert alert-danger">
                            <p>Are you sure you want to delete this donation type?</p>
                            <p>
                                <input type="submit" value="Yes" class="btn btn-danger">
                                <a href="../home.php" class="btn btn-default">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>

