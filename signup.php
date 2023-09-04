
<!DOCTYPE html>
<html>
    <head>
        <title>Signup</title>
        
        <div class="logo">
    <img src="img/22.jpg" alt="" style="opacity: 0.6; height: 100vh; width: 100%; object-fit: cover;">
    </div>
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/login3.css">
        <link rel="stylesheet" href="css/signup.css">

    </head>
    <body >
      
        
        <div id="logo"  class="col-md-12" >
        
               
                
          <style>
            #logo{
              text-align: center;
              }
          </style>
 
 
        <div class="container col-md-12" >
          
          <style>
            .container {
              margin : 0 ;
              width: 0;
              padding:0;}

          </style>
            <div class="row col-md-12">
              <style>
                #logintext{
                  font-size:2rem !important;

                }
                  
              </style>
              
        <form id="signUpForm" class="login col-md-12" method="post" enctype="multipart/form-data" >
            <div class="title">Signup</div>

            <input id="last_name" type="text" name="last_name" placeholder="e.g. Dela Cruz"  pattern="[A-Za-z]{1,}" required="required">
            <input id="user_name" type="text" name="user_name" placeholder="e.g. Pedro"  pattern="[A-Za-z]{1,}" required="required">
            
            <input id="email" type="email" name="email" placeholder="e.g. pedrodelacruz@gmail.com"required="required" >
            <input id="password_validation" type="password" name="password" placeholder="Password" min="8" required="required">
            <div class="password_required">
              <ul>
                <li class="lowercase"><span></span>One lower case letter</li>
                <li class="capital"><span></span>One Capital Letter</li>
                <li class="number"><span></span>One number</li>
                <li class="special"><span></span>One Special Character</li>
                <li class="eight_characters"><span></span>At least 8 Characters</li>
              </ul>
              <style>
                .password_required{
                  display: none;
                }
                .password_required ul{
                  padding: 0;
                  margin: 0 0 15px;
                  list-style: none;
                }
                .password_required ul li{
                  margin-bottom: 8px;
                  color: red;
                  font-weight: 700;
                  text-align: left;
                }
                .password_required ul li.active{
                  color: #02af02;
                  background-color: transparent;
                }
                .password_required ul li span:before{
                  content: "X  "; 
                }
                .password_required ul li.active span:before{
                  content: "✅"; 
                }

                
              </style>
            </div>
            <input id="text"type="password" name="confirmPassword" placeholder="Confirm Password" >

            <!-- <a href="">click here to login</a> -->

            <div class="dropdown">
                <!-- <div class="select">
                    <span class="selected" name="selected">Branch</span>
                    
                    <div class="caret"></div>
                </div>
                <ul class="menu">
                    <li value="Marilao">Marilao</li>
                    <li value="Balagtas">Balagtas</li>
                    
                </ul><br/> -->
                <input type="hidden" name="branch" value="0">
            <!-- <select class="select" name="branch">
                        <option class="menu" value="">Branch</option>
                        <option value="Marilao">Marilao</option>
                        <option value="Balagtas">Balagtas</option>
                    </select>  -->
            </div>
            <button id="" type="submit" class="btn active">Submit</button>


            <style>
              .btn{
                pointer-events: none;
              }
              .btn.active{
                pointer-events: auto;
              }
            </style>
            <br>
            Have an Account?<a href="login.php" class="fs-6"> Click here to Login</a>
    
          
           
            
            </form>
                
            </div>
            
        </div>
           

        </div>

  
        <script src="java/signup.js"></script>
    </body>
    <!-- modal -->

    <div class="modal fade" id="verificationModal" role="dialog" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-l" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Verify Account</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id='verifyCode' method="POST"  enctype="multipart/form-data">

             

              <!-- LNAME  -->
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">Enter Verification Code<i class="bookNowRequired">*</i></span>
                </div>
                <input type="text" class="form-control" id="vericode" name="vericode" required>
              </div>
          <div class="row mt-3">
                        <div class="col-sm-12 col-md-12" align="center">
                          <button type="submit" name="btnSave" value="submit" id="submit" class="btn btn-primary">SUBMIT</button>
                        </div>
          </div>
        
              

            </form>
          </div>
        </div>
      </div>


    </div>

   

<!-- <script src="./js/bootstrap.bundle.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
    <script src="js/jquery-3.5.1.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap5.min.js"></script>
    <script src="java/validation.js"></script>
    <script src="js/script.js"></script>
    <script type="text/javascript">

    
    $(document).on('submit', '#signUpForm', function(e) {
    e.preventDefault();
    var form = $('#signUpForm')[0];
    var formdata = new FormData(form);
    $.ajax({
    type: 'POST',
    url:'register.php',
    data: formdata,
    contentType: false,
    processData: false,
   success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
            $('#registerModal').modal('hide');
            $('#verificationModal').modal('show');
            
            }
            else if (status == 'already') {
              
             swal("Error", "Email Already Exist", "error");


            }
            
             else if (status == 'passnotmacth') {
              
              swal("Error", "Password Not Match", "error");
            }

          }
        
    
  });
  });
 
 




    $(document).on('submit', '#verifyCode', function(e) {
    e.preventDefault();
    var form = $('#verifyCode')[0];
    var formdata = new FormData(form);
    $.ajax({
    type: 'POST',
    url:'verifyCode.php',
    data: formdata,
    contentType: false,
    processData: false,
   success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
            $('#verificationModal').modal('hide');
            
                  window.location.href = "dashboard.php";

            }
            
            
            else if (status == 'veriWrong') {
              
             swal("Error", "Wrong Verification Code", "error");


            }
            
            
            else if (status == 'false') {
              
             swal("Error", "Register error", "error");


            }
            
          }
    
  });
  });
    </script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</html>
<!-- modal -->
