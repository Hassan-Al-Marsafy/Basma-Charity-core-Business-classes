<!DOCTYPE html>
<html lang="en">
<?php require_once '../controller/UpdateUserController.php'; ?>

<head>
    <meta charset="UTF-8">
    <title>Update User</title>
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
                        <h2>Update User</h2>
                    </div>
                    <p>Please fill this form and submit to update user to the database.</p>
                    <form action="../controller/UpdateUserController.php" method="post">
                        <div class="form-group">
                            <label>ID</label>
                            <input type="number" name="id" class="form-control" maxlength="50" value="<?php echo $id; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" maxlength="50" value="<?php echo $name; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="user_name" class="form-control" maxlength="50" value="<?php echo $user_name; ?>" required>
                            <?php
                            if (isset($_SESSION['message'])) {
                                echo '<p class="alert alert-danger">' . $_SESSION['message'] . '</p>';
                                unset($_SESSION['message']);
                            }
                            ?>
                        </div>
                        <div class="form-group">
                            <label>Type</label>
                            <select class="form-control" name="user_type" value="<?php echo $user_type; ?>" required>
                                <option value="admin">Admin</option>
                                <option value="logged_user">Logged User</option>
                                <option value="beneficiary">Beneficiary</option>
                            </select>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="ChooseUserCRUD.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>