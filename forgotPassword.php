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
    <title>Forgot Password</title>

    <?php include '../Layout/header.php'; ?>
    
</head>
<body>
    <!-- forgot password form -->
    <div class="container mt-5 pt-5">
        <div class="row justify-content-center">
            <div class="col-md-5 col-12">
                <div class="card">
                <div class="card-header h5 text-center">Forgot Password</div>
                    <div class="card-body">
                    <span class="alert alert-success" id="green-alert" style="display:none;" role="alert"></span>
                    <span class="alert alert-danger" id="red-alert" style="display:none;" role="alert"></span>

                    <br>
                    <form id="forgotPwdForm" method="post"> 
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email">
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" id="btnForgotPwd" class="btn btn-primary btn-block" name="forgotPwd">Forgot Password</button>
                        </div>
                    </div>
                    <div>
                    </div>
                    </form>
                    <p class="mt-3 mb-1">
                    <a href="login.php">Login</a>
                    </p>
                    </div>
                </div>
            </div>
        </div>        
    </div>
    </div>

<!-- OTP modal -->
<div class="modal fade" id="otpModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header justify-content-center">
        <h5 class="modal-title" id="exampleModalLabel">Enter the OTP</h5>
      </div>
       
      <form id="otpForm" method="POST">
      <div class="modal-body">

      <span class="alert alert-success" id="green-alert" style="display:none;" role="alert"></span>
      <span class="alert alert-danger" id="red-alert" style="display:none;" role="alert"></span>
      <br>

    <div class="form-group mb-3 text-center">
    <label class="form-label">Please check your email for OTP</label>
    <input type="text" class="form-control text-center" id="otp" name="otp" maxlength="4" placeholder="One Time Password">
  </div>
     </div>
      </form>
     
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" value="Submit" id="btnSubmit"> 
      </div>
    </div>
  </div>
</div>

<?php include '../Layout/footer.php'; ?>

 <!-- forgot password validation using javascript -->
<script type="text/javascript">
$(document).ready(function(){
    $('#forgotPwdForm').validate({
        rules:{
            email:{
                required : true,
                email : true
            },
        },
        messages:{
            email: {
            required: 'Please enter Email Address.',
            email: 'Please enter a valid Email Address.'
          },
        },
        errorClass: 'text-danger',
    });

// OTP form validation using javascript 
$(document).ready(function(){
    $('#otpForm').validate({
        rules:{
            otp:{
                required:true
            }, 
        },
        message:{
            otp:{
                required: 'Please enter your OTP',
            },
        },
    });
});    

// forgot_password button  
$(document).on('click','#btnForgotPwd',function(e){
    e.preventDefault();
  
    let mail = $('#email').val();
    console.log(mail);
  
    $.ajax({
        url: "<?php echo EXEC ?>Exec_User.php?task=userCheck",
        type:'POST',
        dataType:'JSON',
        data: {
            mail : mail
        },
        success : function(response){
        
        if(response.StatusCode == 200){

        $('#otpModal').modal('show');

        $.ajax({
        url: "<?php echo EXEC ?>otpVerification.php?submit",
        type: 'post',
        dataType:'JSON',
        data : {
            otp : otp
        },
        success : function(response){

            console.log('res: ',response);

          if(response.statusCode == 200){

            setTimeout(function(){ 
                  window.location.href = "./resetPassword.php";
                  },1000);

                  $('#green-alert').css('display','block');
                  $('#green-alert').html(response.message);

          }else

            $("#red-alert").css('display','block');
            $("#red-alert").html(response.message);
            setTimeout(function(){
                $("#red-alert").css('display','none');
            },3000);
          } 
         
          
        });


            //     setTimeout(function(){
            //     // window.location.href = "../sendMail.php"; 
            //     $('#otpModal').modal('show');
            //     $("#green-alert").css('display','none');
            //     },3000);

            //     $('#green-alert').css('display','block');
            //     $('#green-alert').html(response.message);
                
            // }else{
            //     $("#red-alert").css('display','block');
            //     $("#red-alert").html(response.message);

            //     setTimeout(function(){
            //       $("#red-alert").css('display','none');
            //     },3000);
                
            }
            }
    });
});

// OTP modal
// $(document).on('click','#btnSubmit',function(){
    
//     let otp = $('#otp').val();
//     console.log(otp);

//     $.ajax({
//         // url: "<?php echo EXEC ?>otpVerification.php?submit",
//         type: 'post',
//         dataType:'JSON',
//         data : {
//             otp : otp
//         },
//         success : function(response){

//             console.log('res: ',response);

//           if(response.statusCode == 200){

//             setTimeout(function(){ 
//                   window.location.href = "./resetPassword.php";
//                   },1000);

//                   $('#green-alert').css('display','block');
//                   $('#green-alert').html(response.message);

//           }else

//             $("#red-alert").css('display','block');
//             $("#red-alert").html(response.message);
//             setTimeout(function(){
//                 $("#red-alert").css('display','none');
//             },3000);
//           } 
         
          
//         });
//     });

});


</script>
    
</body>
</html>