
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Delete User</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <style type="text/css">
            .wrapper{
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
                            <h1>Delete User</h1>
                        </div>
                        <form action="../controller/DeleteUserController.php" method="post">
                            <div class="alert alert-danger fade in">
                                <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                                <p>Are you sure you want to delete this User?</p><br>
                                <p>
                                    <input type="submit" value="Yes" class="btn btn-danger">
                                    <a href="ChooseUserCRUD.php" class="btn btn-default">No</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>        
            </div>
        </div>
    </body>
</html>