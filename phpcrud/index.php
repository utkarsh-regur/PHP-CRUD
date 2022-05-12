<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>PHP Modal CRUD</title>
</head>
<body>
<!-- Modal -->
<div class="modal fade" id="completeModal" tabindex="-1" aria-labelledby="completeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="completeModalLabel">Add a user</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form id="form">
      <div class="form-group mb-3">
        <label for="completename" class="form-label">Name</label>
        <input type="text" class="form-control" id="completename" placeholder="Enter your name">
     </div>

     <div class="form-group mb-3">
        <label for="completeemail" class="form-label">Email</label>
        <input type="email" class="form-control" id="completeemail" placeholder="Enter your email">
     </div>

     <div class="form-group mb-3">
        <label for="completemobile" class="form-label">Mobile</label>
        <input type="text" class="form-control" id="completemobile" placeholder="Enter your mobile number">
     </div>

     <div class="form-group mb-3">
        <label for="completeplace" class="form-label">Place</label>
        <input type="text" class="form-control" id="completeplace" placeholder="Enter your place">
     </div>
</form> 
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" onclick="adduser()">Save</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- Update Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateModalLabel">Update details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         
      <div class="form-group mb-3">
        <label for="updatename" class="form-label">Name</label>
        <input type="text" class="form-control" id="updatename" placeholder="Enter your name">
     </div>

     <div class="form-group mb-3">
        <label for="updateemail" class="form-label">Email</label>
        <input type="email" class="form-control" id="updateemail" placeholder="Enter your email">
     </div>

     <div class="form-group mb-3">
        <label for="updatemobile" class="form-label">Mobile</label>
        <input type="text" class="form-control" id="updatemobile" placeholder="Enter your mobile number">
     </div>

     <div class="form-group mb-3">
        <label for="updateplace" class="form-label">Place</label>
        <input type="text" class="form-control" id="updateplace" placeholder="Enter your place">
     </div>
     </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" onclick="updateDetails()">Update</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <input type="hidden" id="hiddendata">
      </div>
    </div>
  </div>
</div>


  <div class="container my-3">
      <h1 class="text-center">PHP CRUD with Modal</h1>
      <button type="button" class="btn btn-dark my-4" data-bs-toggle="modal" data-bs-target="#completeModal">
 Add new user
</button>

<div id="displayDataTable"> </div>
   
  </div>




<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

<script>

   $(document).ready(function(){
    displayData();
   });



   function displayData(){
     var displayData="true";

     $.ajax({
       url: "display.php",
       type: "post",
       data:{
         displaySend: displayData
       },
       success: function(data, status){
        $('#displayDataTable').html(data);
        $("#completeModal").modal("hide");
        $("#form")[0].reset();
       }
     });
   }

    function adduser(){
        var nameAdd = $('#completename').val();
        var emailAdd = $('#completeemail').val();
        var mobileAdd = $('#completemobile').val();
        var placeAdd = $('#completeplace').val();

            $.ajax({
        url: "insert.php",
        type: "post",
        data: {
            nameSend: nameAdd,
            emailSend: emailAdd,
            mobileSend: mobileAdd,
            placeSend: placeAdd
        },
        success: function(data, status){
            //console.log(status);
            $('#completeModal').modal('hide');
            displayData();
        }
    });
    }



    function DeleteUser(deleteid){
        $.ajax({
          url: "delete.php",
          type: "post",
          data: {
              deletesend: deleteid
     
          },
          success: function(data, status){
              //console.log(status);
              displayData();
          }
      });
    }



      function GetDetails(updateid){
        
        $('#hiddendata').val(updateid);

        $('#updateModal').modal('show');

        $.post("update.php",{updateid: updateid}, function(data,status){
           var userid = JSON.parse(data);

           $('#updatename').val(userid.name);
           $('#updateemail').val(userid.email);
           $('#updatemobile').val(userid.mobile);
           $('#updateplace').val(userid.place);
        });


      }


      function updateDetails(){
        var updatename = $('#updatename').val();
        var updateemail = $('#updateemail').val();
        var updatemobile = $('#updatemobile').val();
        var updateplace = $('#updateplace').val();
        var hiddendata = $('#hiddendata').val();

        $.post("update.php",{
          updatename: updatename,
          updateemail: updateemail,
          updatemobile: updatemobile,
          updateplace: updateplace,
          hiddendata: hiddendata
          
        }, function(data, status){
          $('#updateModal').modal('hide');
          displayData();
        });
      }

</script>

</body>
</html>