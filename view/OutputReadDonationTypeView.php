<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Donation Type</title>
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
                        <h1>View Donation Type</h1>
                    </div>
                    <?php

                    if (isset($_GET['id']) && isset($_GET['type'])) {
                        $id = htmlspecialchars($_GET['id']);
                        $type = htmlspecialchars($_GET['type']);
                    ?>
                        <div class="form-group">
                            <label>Donation Type ID</label>
                            <p class="form-control-static"><?php echo $id; ?></p>
                        </div>
                        <div class="form-group">
                            <label>Donation Type Name</label>
                            <p class="form-control-static"><?php echo $type; ?></p>
                        </div>
                    <?php
                    } else {
                        echo '<div class="alert alert-danger">Error: Donation Type details not found.</div>';
                    }
                    ?>
                    <p><a href="ReadDonationTypeView.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>