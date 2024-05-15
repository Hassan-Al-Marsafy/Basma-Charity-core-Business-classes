<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper {
            width: 650px;
            margin: 0 auto;
        }

        .page-header h2 {
            margin-top: 0;
        }

        table tr td:last-child a {
            margin-right: 10px;
        }

        .glyphicon-plus {
            margin-right: 5px;
        }

        .glyphicon-trash {
            color: red;
        }

        .glyphicon-pencil {
            color: yellow;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>

<body>

    <div class="wrapper">
        <div class="container-fluid">
        <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Home Page</h2>
                    </div>
                    <?php
                    session_start();
                    if (isset($_SESSION['message'])) {
                        echo '<div class="alert alert-success">' . $_SESSION['message'] . '</div>';
                        unset($_SESSION['message']);
                    }
                    ?>
                    <button class="btn btn-primary" onclick="window.location.href='view/ChooseUserCRUD.php'">User</button>
                    <button class="btn btn-success" onclick="window.location.href='view/CreateDonationview.php'">Donation</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>