<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once($_SERVER["DOCUMENT_ROOT"] . '/jetcargonew/Admin/const.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/jetcargonew/Admin/db.class.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>loginForm</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js" integrity="sha512-KFHXdr2oObHKI9w4Hv1XPKc898mE4kgYx58oqsc/JqqdLMDI4YjOLzom+EMlW8HFUd0QfjfAvxSL6sEq/a42fQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <style type="text/css">
    label.error {
      font-size: 14px;
      color: red;
    };
  </style>

</head>

<body>
  <!-- Login Form -->
  <div class="container mt-5 pt-5">
    <div class="row justify-content-center">
      <div class="col-md-5 col-12">
        <div class="card">
          <div class="card-body">

            <form id="loginForm" method="POST">

              <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email">
              </div>

              <div class="mb-3 ">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="passwprd">
              </div>

              <div class="mb-3">
                <input type="submit" class="btn btn-primary" id="btnlogin" value="Login" name="login">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js" integrity="sha512-KFHXdr2oObHKI9w4Hv1XPKc898mE4kgYx58oqsc/JqqdLMDI4YjOLzom+EMlW8HFUd0QfjfAvxSL6sEq/a42fQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  
  <!-- Login form validation using javascript -->
  <script type="text/javascript">
    $(document).ready(function() {
      $('#loginForm').validate({
        rules: {
          email: {
            required: true,
            email: true
          },
          password: {
            required: true,
            minlength: 8
          },
        },
        messages: {
          email: {
            required: 'Please enter Email Address.',
            email: 'Please enter a valid Email Address.',
          },
          password: {
            required: 'Please enter Password.',
            minlength: 'Password must be at least 8 characters long.',
          },
        },
        errorClass: 'error',
        submitHandler: function(form, event) {
        event.preventDefault();

         // let isValid = $("#loginForm").valid();
         // if (isValid) {
            let data = new FormData($("#loginForm")[0]);
            //console.log('data: ',data);
            //alert('jquery successfull');
            
            $.ajax({
              type: "POST",
              dataType: "JSON",
              url: "<?php echo EXEC ?>loginCheck.php?login",
              data: data,
              processData: false,
              contentType: false,
            
              success: function(result) {

                console.log("AJAX Response:", result);
                alert('success');
                if (result.StatusCode === 200) {
                  window.location.href = "./View/dashboard.php";
                  
                } else {
                  alert(result.message);
                }
              },
              error: function(xhr, status, error) {
                console.error("AJAX Error:", error);
                console.log("Response Text:", xhr.responseText);
                //alert("AJAX Request Failed");
              }
            });


          }
        });
      });
    
    // });
  </script>

</body>

</html>
