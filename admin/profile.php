<?php 
 include 'include/header.php';
 include '../connect.php';


if(!isset($_SESSION['type']))
{
    header("location: admin.php");
}

$query4= "select * from branch_tbl where branch_id  = '$branchId' limit 1";
$result4 = mysqli_query($con, $query4);
$user_data1 = mysqli_fetch_assoc($result4);
$adminFname = $user_data['staff_fname'];
$branchId = $user_data['staff_branch'];
$name = '';
$email = '';
$user_id = '';
 ?>

    <div class="panel panel-default" style="margin: 5%;">
        <div class="panel-heading">Edit Profile</div>
        <div class="panel-body">
            <form method="post" id="edit_profile_form">
                <span id="message"></span>
                <div class="form-group">
                    <label>Name </label>
                    <input type="text" name="user_name" id="user_name" class="form-control" value="<?php echo $name;?>" required>
                </div>
                <div class="form-group">
                    <label>Email </label>
                    <input type="email" name="user_email" id="user_email" class="form-control" required value="<?php echo $email;?>">
                </div>
                <hr/ >
                <label>Leave Password blank if you do not want to change</label>
                <div class="form-group" style="margin: 1%;">
                    <label>New Password</label>
                    <input type="password" name="user_new_password" id="user_new_password" class="form-control">
                </div>
                <div class="form-group" style="margin: 1%;">
                    <label>Re-enter Password</label>
                    <input type="password" name="user_re_enter_password" id="user_re_enter_password" class="form-control">
                    <span id="error_password"></span>
                </div>
                <div class="form-group">
                <input type="submit" name="edit_profile" id="edit_profile" value="Submit" class="btn btn-info" align="left">
                </div>

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