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
 <!-- dataTable CSS -->
 <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" /> -->
<!-- bootstrap -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.1.8/datatables.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css" rel="stylesheet">

<!-- jquery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/v/dt/dt-2.1.8/datatables.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js" integrity="sha512-KFHXdr2oObHKI9w4Hv1XPKc898mE4kgYx58oqsc/JqqdLMDI4YjOLzom+EMlW8HFUd0QfjfAvxSL6sEq/a42fQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>
<body>
<!-- user email(login) -->
<!-- <div class="content-wrapper">
    <h6>Welcome , <?php print_r($_SESSION['email'])?></h6>
</div>  -->

<div class="my-5">
<!--Add user button -->
<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#userModal"id="btnAdd">Add User</button>
</div>

<!-- Add pop up Modal form -->
<div class="modal fade" tabindex="-1" role="dialog" id="userModal">
<div class="modal-dialog" role="document">
<div class="modal-content">

<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Location</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

    <form method="POST" id="addUser">

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
        <th scope="col">Action</th>
       
    </thead>
    <tbody> 
    </tbody>
</table>

<!-- Edit pop up modal form --> 
<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
<div class="modal-dialog" role="document">
<div class="modal-content">

    <div class="modal-header">
      <h5 class="modal-title">Update User</h5>
    </div>

    <form method="POST" id="editUser">
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
    
    <div class="modal-footer">
    <button type="button" class="btn btn-secondary"  data-bs-dismiss="modal">Close</button>
    <input type="submit" class="btn btn-primary" id="update" name="update" value="Update">
    </div>  

    </form>
    </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.1.8/datatables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js" integrity="sha512-KFHXdr2oObHKI9w4Hv1XPKc898mE4kgYx58oqsc/JqqdLMDI4YjOLzom+EMlW8HFUd0QfjfAvxSL6sEq/a42fQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.14.5/sweetalert2.min.js" integrity="sha512-JCDnPKShC1tVU4pNu5mhCEt6KWmHf0XPojB0OILRMkr89Eq9BHeBP+54oUlsmj8R5oWqmJstG1QoY6HkkKeUAg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- data table display -->
<script type="text/javascript">
$(document).ready(function(){

$('#userTable').DataTable({
    "responsive" : true,
    "processing" : true,
    "serverSide": true,
    "destroy" :true,
    "ordering" : true,
    "autoWidth" :true,
    "ajax": {
        "type" : "POST",
        "url" : "<?php echo EXEC ?>Exec_User.php?task=display",
         "dataSrc": "data",
        "error": function(xhr, status, error) {
                console.error("AJAX Error:", error);
                console.log("Response Text:", xhr.responseText);
                alert("AJAX Request Failed");
              },
            },
        "columns": [
        {
            "data": null,
            "sortable": false,
            render: function(data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
            }
        },
       //{"data": "id"},
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
        {
            "data": "id",
            "render": function(data, type, row) {
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
   
});

// Insert data into db
$(document).on('click','#save',function(e) {
            e.preventDefault();
            let isValid = $("#addUser").valid();
            if (isValid) {
                let data = new FormData($("#addUser")[0]);
                
                alert('ndjck');
                $.ajax({
                    url: "<?php echo EXEC ?>Exec_User.php?task=add",
                    type: "POST",
                    dataType: "JSON",
                    cache: false,
                    async: true,
                    processData: false,
                    contentType: false,
                    data: data,
                    success: function(data) {
                        alert('jdkf');
                        if(data.statusCode == 200) {
                            console.log('success');
                            Swal.fire(
                                'Good job!',
                                '' + data.message + '',
                                'success'
                            )
                            $('#location').val("");
                            $('#userModal').modal('hide');
                        }
                    }                    
                })
            }
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

        success: function (response) {
            //console.log('Response:', response);
            
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
    //console.log(id);
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


        
</script>

</body>
</html>
