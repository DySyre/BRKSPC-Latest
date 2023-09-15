<?php 


include 'include/header.php';
include '../connect.php';


// if(!isset($_SESSION['type']))
// {
//     header("location: admin.php");
// }

$query4= "select * from staff_tbl where staff_id  = '$branchId' limit 1";
$result4 = mysqli_query($con, $query4);
$user_data1 = mysqli_fetch_assoc($result4);
$adminFname = $user_data['staff_fname'];
$branchId = $user_data['staff_branch'];
$name = '';
$email = $user_data['staff_email'];
$user_id = '';
 ?>

    <div class="panel panel-default" style="margin: 5%;">
        <div class="panel-heading" align="center" style="font-weight: bold; font-size: 1.2rem;">Edit Profile</div>
        <?php 
            if(isset($_SESSION['successMsg']))
            {
                ?> 
                <p style="color: green;"><?php echo $_SESSION['successMsg'];?></p>
            
            <?php
                unset($_SESSION['successMsg']);
            }
            if(isset($_SESSION['errorMsg']))
            {
                ?>
                <p style="color:#ff0000;"> <?php echo $_SESSION['errorMsg'] ; ?></p>
            <?php
                unset($_SESSION['errorMsg']);
            }            
        ?>
        <div class="panel-body">
            <form method="post" id="edit_profile_form">
                <span id="message"></span>

                <div class="form-group mt-4">
                    <label for="">Name </label>
                    <input type="text" name="user_name" id="user_name" class="form-control" value="<?php echo $adminFname;?>" required>
                </div>

                <div class="col-md-12">
                   <div class="form-group">
                      <label style="font-size: 1rem;" for="fname">Branch</label>
                       <select class="form-control" name="branchId">
                      <?php
                      $queryBranch = "select * from branch_tbl where branch_isactive = '1' and branch_id != '3'";
                        $resqueryBranch = mysqli_query($con, $queryBranch);

                        while($rowBranch = mysqli_fetch_assoc($resqueryBranch))
                        {
                           
                            ?>
                           
                                <option value="<?php echo $rowBranch['branch_id'] ?>"><?php echo $rowBranch['branch_name'] ?></option>
                          
                            <?php

                        }
                      ?>
                        </select>
                      
                       
                  </div>
              </div>

                <div class="form-group">
                    <label for="email">Email </label>
                    <input type="email" name="user_email" id="user_email" class="form-control" required value="<?php echo $email;?>">
                </div>
                <div class="form-group mt-4">
                <input type="submit" name="edit_profile" id="edit_profile" value="Submit" class="btn btn-info" align="left">
                </div>

                <hr/>
                <label>Leave Password blank if you do not want to change</label>
                <form action="" name="chngpwd" method="post" onsubmit="return valid();">
                <div class="form-control mt-5 mb-8">
                    <h1 align="center">Change Password</h1>
                <table align="center">
                        <tr height="50">
                            <td>Email ID:</td>
                            <td><input class="form-control" type="text" name="useremail" id="useremail" placeholder="" required></td>
                        </tr>
                        <tr height="50">
                            <td>Old Password:</td>
                            <td><input class="form-control" type="password" name="opwd" id="opwd" required></td>
                        </tr>
                        <tr height="50">
                            <td>New Password:</td>
                            <td><input class="form-control" type="password" name="npwd" id="npwd" required>
                            
                            </td>
                            
                        </tr>
                        <tr height="50">
                            <td>Confirm Password:</td>
                            <td><input class="form-control" type="password" name="cpwd" id="cpwd" required></td>
                        </tr>
                        <tr height="50">
                            <td><a href="admin.php" id="bth" class="form-control" style="text-decoration: none;">Back to home</a></td>
                            <td><input class="form-control" id="btn" type="submit" name="Submit" value="Change Password" style="cursor: pointer;"></td>
                        </tr>
                    </table>
                    <style>
                        #btn:hover{
                            background-color: #008CBA;
                            color: white;
                            }
                        #bth:hover{
                            background-color: #f44336;
                            color: white;
                        }
                    </style>
                </div>
                
                </form>

            </form>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('edit_profile_form').on('submit', function(event){
                event.preventDefault();
                if($('#user_new_password').val() !='')
                {
                    if($('#user_new_password').val() != $('#user_re_enter_password').val())
                    {
                        $('#error_password').html('label class="text-danger">Password not Match</label>');
                    }
                    else{
                        $('#error_password').html('');
                    }
                }
                $('#edit_profile').attr('disabled', 'disabled');
                var form_data = $(this).serialize();
                $.ajax({
                    url:"edit_profile.php",
                    method: "POST",
                    data: form-data,
                    success:function(data)
                    {
                        $('#edit_profile').attr('disabled', false);
                        $('#user_new_password').val('');
                        $('#user_re_enter_password').val('');
                        $('message').html(data);
                    }
                })
            });
        });
    </script>