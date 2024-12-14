<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once($_SERVER['DOCUMENT_ROOT'] . '/jetcargonew/Admin/db.class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/jetcargonew/Admin/const.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>resetPassword</title>
    <?php include '../Layout/header.php'; ?>
</head>
<body>

<!-- reset password -->
<div class="container mt-5 pt-5">
        <div class="row justify-content-center">
            <div class="col-md-5 col-12">
                <div class="card">
                <div class="card-header h5 text-center">Reset Password</div>
                    <div class="card-body">
                   
                    <form id="resetPwdForm" method="post">

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="conPassword" id="conPassword">
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <input type="submit" class="btn btn-primary btn-block" id="btnRestPwd" name="resetPwd" value="Reset Password">
                        </div>
                    </div>
                    <div>
                    </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>        
    </div>
    </div>

<?php include 'footer.php'; ?>

<script type="text/javascript">

$(document).ready(function(){

    $('#resetPwdForm').validate({
       rules:{
        password: {
            required: true,
            minlength: 8
        },
        conPassword: {
            required: true,
            minlength: 8
        }, 
       },
       messages:{
        password: {
            required: 'Please enter Password.',
            minlength: 'Password must be at least 8 characters long.',
        },
        conPassword: {
            required: 'Please enter Password.',
            minlength: 'Password must be al least 8 characters long.'
        },
       },
       errorClass: 'error',
    });
});


</script>

</body>
</html>