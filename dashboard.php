<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once($_SERVER["DOCUMENT_ROOT"] . '/jetcargonew/Admin/const.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/jetcargonew/Admin/db.class.php');
//require_once($_SERVER['DOCUMENT_ROOT'] . '/jetcargonew/Admin/View/sidebar.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>dashboard</title>

  <?php include '../Layout/header.php'; ?>

</head>

<body>
<!-- user email(login) -->
<div class="content-wrapper">
<?php
if(!isset( $_SESSION['email'])){
    header("Location: login.php");
    exit();
}
?>
</div> 

<div class="my-5">
<!--Add user button -->
<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#userModal"id="btnAdd">Add User</button>
</div>

<!-- Add pop up Modal form -->
<div class="modal fade" tabindex="-1" role="dialog" id="userModal" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">

<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Location</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

    <form method="POST" id="addUser" enctype="multipart/form-data">

    <div class="modal-body">

    <div class="mb-3">
        <label class="form-label" >First Name:</label>
        <input type="text" class="form-control" name="firstname" id="firstname">
    </div>

    <div class="mb-3">
        <label class="form-label" >Last Name:</label>
        <input type="text" class="form-control" name="lastname" id="lastname">
    </div>

    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" class="form-control" name="email" id="email">
    </div>

    <div class="mb-3">
        <label class="form-label" >Password:</label>
        <input type="text" class="form-control" name="password" id="password">
    </div>

    <div class="mb-3">
        <label class="form-label">Permission group:</label>
        <input type="text" class="form-control" name="permissiongroup" id="permissiongroup">
    </div>

    <div class="mb-3">
        <label class="form-label">Company ID:</label>
        <input type="text" class="form-control" name="companyId" id="companyId">
    </div>

    <div class="mb-3">
        <label class="form-label">Agent Company:</label>
        <input type="text" class="form-control" name="agentcompany" id="agentcompany">
    </div>

    <div class="mb-3">
        <label class="form-label">Phone:</label>
        <input type="number" class="form-control" name="phone" id="phone">
    </div>

    <div class="mb-3">
        <label class="form-label">Notification:</label>
        <input type="text" class="form-control" name="notification" id="notification">
    </div>

    <div class="mb-3">
        <label class="form-label">Locked:</label>
        <input type="text" class="form-control" name="locked" id="locked">       
    </div>

    <div class="mb-3">
        <label class="form-label">Image:</label>
        <input type="file" class="form-control" name="image[]" id="image" multiple>
    </div>
    
    <div class="modal-footer">
    <button type="button" class="btn btn-secondary"  data-bs-dismiss="modal">Close</button>
    <input type="submit" class="btn btn-primary" id="save" name="adduser" value="Add">

    </div>  
  
    </form>
    </div>
    </div>
  </div>
</div>

<!-- Fetch the data from database -->
<table id="userTable" class="table">

    <thead>
        <th scope="col">Id</th>
        <th scope="col">First Name</th>
        <th scope="col">Last Name</th>
        <th scope="col">Email</th>
        <th scope="col">Password</th>
        <th scope="col">Permissiongroup</th>
        <th scope="col">CompanyId</th>
        <th scope="col">Agentcompany</th>
        <th scope="col">Phone</th>
        <th scope="col">Notification</th>
        <th scope="col">Locked</th>
        <th scope="col">Image</th>
        <th scope="col">Action</th>
       
    </thead>
    <tbody> 
    </tbody>
</table>

<!-- Edit pop up modal form --> 
<div class="modal fade" tabindex="-1" role="dialog" id="editModal" aria-hidden="false">
<div class="modal-dialog" role="document">
<div class="modal-content">

    <div class="modal-header">
      <h5 class="modal-title">Update User</h5>
    </div>

    <form method="POST" id="editUser" enctype="multipart/form-data">
        <input type="hidden" name="editId" id="editId">
        
    <div class="modal-body">
   
    <div class="mb-3">
        <label class="form-label" >First Name:</label>
        <input type="text" class="form-control" id="ufirstname" name="firstname">
    </div>

    <div class="mb-3">
        <label class="form-label" >Last Name:</label>
        <input type="text" class="form-control" name="lastname" id="ulastname">
    </div>

    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" class="form-control" name="email" id="uemail">
    </div>

    <div class="mb-3">
        <label class="form-label" >Password:</label>
        <input type="text" class="form-control" name="password" id="upassword">
    </div>

    <div class="mb-3">
        <label class="form-label">Permission group:</label>
        <input type="text" class="form-control" name="permissiongroup" id="upermissiongroup">
    </div>

    <div class="mb-3">
        <label class="form-label">Company ID:</label>
        <input type="text" class="form-control" name="companyId" id="ucompanyId">
    </div>

    <div class="mb-3">
        <label class="form-label">Agent Company:</label>
        <input type="text" class="form-control" name="agentcompany" id="uagentcompany">
    </div>
    
    <div class="mb-3">
        <label class="form-label">Phone:</label>
        <input type="number" class="form-control" name="phone" id="uphone">
    </div>

    <div class="mb-3">
        <label class="form-label">Notification:</label>
        <input type="text" class="form-control" name="notification" id="unotification">
    </div>

    <div class="mb-3">
        <label class="form-label">Locked:</label>
        <input type="text" class="form-control" name="locked" id="ulocked">       
    </div>

    <div class="mb-3">
        <label class="form-label">Image:</label>
        <input type="file" class="form-control" id="editImage" name="image[]" multiple>         
        <input type="hidden" name="oldPhoto" id="oldImage">
        <!-- <img src="" id="oldPhoto" width="100px" height="100px"> -->
        <div id="oldPhoto"></div>
    </div>
    
    <div class="modal-footer">
    <button type="button" class="btn btn-secondary"  data-bs-dismiss="modal">Close</button>
    <input type="submit" class="btn btn-primary" id="update" name="update" value="Update">
    </div>  

    </form>
    </div>
    </div>
  </div>
</div>

<?php include '../Layout/footer.php';  ?>

<!-- data table display -->
<script type="text/javascript">
$(document).ready(function(){
$('#userTable').DataTable({
    "responsive" : true,
    "processing" : true,
    "serverSide": false,
    "destroy" :true,
    "ordering" : true,
    "autoWidth" :true,
    "ajax": {
        "type" : "POST",
        "url" : "<?php echo EXEC ?>Exec_User.php?task=display",
         "dataSrc": "data",
        "error": function(xhr, status, error){
                console.error("AJAX Error:", error);
                console.log("Response Text:", xhr.responseText);
                //alert("AJAX Request Failed");
              },
            },
        "columns": [
        // {
        //     "data": null,
        //     "sortable": false,
        //     render: function(data, type, row, meta) {
        //    //return meta.row + meta.settings._iDisplayStart + 1;
        //     }
        // },
        {"data": "id"},
        {"data": "firstname"},
        {"data": "lastname"},
        {"data": "email"},
        {"data": "password"},
        {"data": "permissiongroup"},
        {"data": "companyId"},
        {"data": "agentcompany"},
        {"data": "phone"},
        {"data": "notification"},
        {"data": "locked"},
        {"data": "image"},
        {
            "data": "id",
            "render": function(data, type, row){
                let encodedId = window.btoa(data);
                return '<a href="javascript:void()" id="btnEdit" title="Edit Address" class="btn btn-primary"  data-id="' + encodedId + '"><i class="fa-regular fa-pen-to-square"></i></a><a href="javascript:void()" id="btnDelete" value="Update" title="Delete Address" class="btn btn-danger deleteBtn" data-id="' + data + '"><i class="fa-solid fa-trash"></i></a>';
                     
                    }
                }
    ]  
});

});
</script>

 <!-- Bootstrap modal Add user validation jQuery -->
 <script>
$(document).ready(function(){
$("#addUser").validate({
    rules:{
        firstname:{
            required :true,
        },
        lastname:{
            required :true,
        },
        email:{
            required :true,
            email : true,
        },
        password:{
            required: true,
            minlength: 8
        },
        permissiongroup:{
            required: true,
        },
        companyId:{
            required: true,
        },
        agentcompany:{
            required: true,
        },
        phone:{
            required: true,
            minlength : 10,
        },
        notification:{
            required: true,
        },
        locked:{
            required: true,
        },
        image:{
            required: true,
        },
    },
    messages:{
        firstname:{
            required: 'Please enter First Name.',
        },
        lastname:{
            required: 'Please enter Last Name.',
        },
        email:{
            required: 'Please enter Email Address.',
        },
        password:{
            required: 'Please enter Password.',
            minlength: 'Password must be at least 8 characters long.',
        },
        permissiongroup:{
            required: 'Please enter Permission group.',
        },
        companyId:{
            required: 'Please enter Company ID.',
        },
        agentcompany:{
            required: 'Please enter Agent Company.',
        },
        phone:{
            required: 'Please enter Phone.',
            minlength: 'Password must be at least 10 characters long.',
        },
        notification:{
            required: 'Please enter Notification.',
        },
        locked:{
            required: 'Please enter Locked.',
        },
        image:{
            required: 'Please Upload Image.',
        },
    },
    errorClass: 'text-danger',
    
});

// Edit user validation jquery  
$('#editUser').validate({
    rules:{
        ufirstname:{
            required :true,
        },
        ulastname:{
            required :true,
        },
        uemail:{
            required :true,
            email : true,
        },
        upassword:{
            required: true,
            minlength: 8
        },
        upermissiongroup:{
            required: true,
        },
        ucompanyId:{
            required: true,
        },
        uagentcompany:{
            required: true,
        },
        uphone:{
            required: true,
            minlength : 10,
        },
        unotification:{
            required: true,
        },
        ulocked:{
            required: true,
        },
    },
    messages:{
        ufirstname:{
            required: 'Please enter First Name.',
        },
        ulastname:{
            required: 'Please enter Last Name.',
        },
        uemail:{
            required: 'Please enter Email Address.',
        },
        upassword:{
            required: 'Please enter Password.',
            minlength: 'Password must be at least 8 characters long.',
        },
        upermissiongroup:{
            required: 'Please enter Permission group.',
        },
        ucompanyId:{
            required: 'Please enter Company ID.',
        },
        uagentcompany:{
            required: 'Please enter Agent Company.',
        },
        uphone:{
            required: 'Please enter Phone.',
            minlength: 'Password must be at least 10 characters long.',
        },
        unotification:{
            required: 'Please enter Notification.',
        },
        ulocked:{
            required: 'Please enter Locked.',
        },
    },
    errorClass: 'text-danger',
});

// Add Modal open when button(add_user)click
$(document).ready(function(){
$('#btnAdd').on('click',function(){
    $('#userModal').modal('show');

// Insert data into db
$(document).on('click','#save',function(e){
            e.preventDefault();
            let isValid = $("#addUser").valid();

            if (isValid) {
                let data = new FormData($("#addUser")[0]);
                
                $.ajax({
                    url: "<?php echo EXEC ?>Exec_User.php?task=add",
                    type: "POST",
                    dataType: "JSON",
                    data: data,
                    cache: false,
                    async: true,
                    processData: false,
                    contentType: false,
                    success: function(result){
                        if(result.statusCode == 200){
                            Swal.fire(
                                'Good job!',
                                '' + result.message + '',
                                'success'
                            )
                            $('#userModal').modal('hide');
                            $("#userTable").DataTable().ajax.reload();
                        }
                    }                    
                })
            }
        });
    });
});

// Edit Modal open when update button click
$(document).on('click', '#btnEdit', function () {
 
    let id = $(this).attr("data-id");
    
    // Fetch old data using AJAX
    $.ajax({
      url: "<?php echo EXEC ?>Exec_User.php?task=getsingledata",  
        type: "POST",
        dataType: "JSON",
        cache: false,
        data: { 
            id: id
         },
        success: function(response){

            $('#editId').val(response.data.id);
            $('#ufirstname').val(response.data.firstname);
            $('#ulastname').val(response.data.lastname);
            $('#uemail').val(response.data.email);
            $('#upassword').val(response.data.password);
            $('#upermissiongroup').val(response.data.permissiongroup);
            $('#ucompanyId').val(response.data.companyId);
            $('#uagentcompany').val(response.data.agentcompany);
            $('#uphone').val(response.data.phone);
            $('#unotification').val(response.data.notification);
            $('#ulocked').val(response.data.locked); 
        
            var myArray = response.data.image;
            $.each(myArray, function(index, img){
            $('#oldPhoto').append(`  
            <div class="d-inline-block me-2 image-container">
            <img src="<?php echo base_url?>/image/${img}" class="img-thumbnail" "width="100px">
            <a href="javascript:void(0);" class="badge badge-danger" id="deleteImage" data-id="${index}" data-uid="${response.data.id}">Delete</a>
            </div>`);
});
        // Show the modal
        $('#editModal').modal('show');
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error:', status, error);
        },
    });
});

// update data using ajax 
$('#update').on('click',function(e){

   e.preventDefault();
    let isValid = $('#editUser').valid();
    if(isValid){

    let data = new FormData($("#editUser")[0]);

        $.ajax({
           url: "<?php echo EXEC ?>Exec_User.php?task=edit",
           type:"POST",
           dataType : "JSON",
           data : data,
            cache : false,
            async : true,
            processData : false,
            contentType :false,
            success : function(response){
              
              if(response.statusCode == 200){
                Swal.fire(
                    'Good job!'+response.message + '',
                    'success'
                )
                $('#editModal').modal('hide');
                $('#userTable').DataTable().ajax.reload();
              }
            }
        });
}
});

// Delete Data using ajax
$(document).on('click','.deleteBtn',function(){
    
     let id = $(this).data('id');
   
            Swal.fire({     
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                           
            }).then((result) => {
                if (result.isConfirmed) {
                    
                    $.ajax({
                        url: "<?php echo EXEC ?>Exec_User.php?task=delete",
                        type: "POST",
                        data: {
                            id: id
                        },
                        dataType: "JSON",
                        success: function(data){
                            console.log(data);
                            if (data.statusCode == 200) {
                                Swal.fire('Deleted!', 'Your data has been deleted.', 'success');
                                $("#userTable").DataTable().ajax.reload();
                            }
                        }
                    });
                }
            })
        });
});

// Multiple Images Delete button
$(document).on('click', '#deleteImage', function(){
  
    let imgId = $(this).data('id');
    console.log(imgId); 
    let uid = $(this).attr('data-uid');
    console.log(uid);

    let imgContainer = $(this).closest('.image-container'); 

        $.ajax({
            url: "<?php echo EXEC ?>Exec_User.php?task=deleteImage",
            type: 'POST',
            dataType : "JSON",
            data:{ 
                imgId: imgId,
                uid : uid,
            },
            success: function(response){
                //alert('open');
         
                if (response.statusCode == 200){
                               
                    imgContainer.fadeOut(300,function(){
                        $(this).remove();
                    });

                    $('#userTable').DataTable().ajax.reload();
                    console.log(response.message);

                }else{
                    console.log('Failed to delete image!');
                }
   
            }
        });
});


        
</script>
</body>
</html>
