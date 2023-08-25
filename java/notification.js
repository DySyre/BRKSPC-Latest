$(document).ready(function (){

    $('.notification').load('Ajax/Notification.php');
    $('.counter').text('0').hide();

    var counter = 0;

    $('#form-submit').on('submit', function(event){
        event.preventDefault();
        
        var subject = $('#subject').val().trim();
        var comment = $('#comment').val().trim();

        $('#sub-error').text('');
        $('#com-error').text('');

        if(subject != '' && comment != ''){
            
            $.ajax({
                type: "POST",
                url: "Ajax/Ins_notification.php",
                data: { 'subject' : subject, 'comment' : comment },
                success: function (response) {
                    var status = JSON.parse(response);
                    if(status.status == 101){
                        counter++;
                        $('.counter').text(counter).show();
                        $('.notification').load('Ajax/Notification.php');
                        $("#form-submit").trigger("reset");
                        console.log(status.msg);
                    }
                    else{
                       console.log(status.msg);
                    }
                }
            });

        }
        else{
        
            if(subject == ''){
                $('#sub-error').text("Please Enter Subject");
            }
            if(comment == ''){
                $('#com-error').text("Please Enter Comment");
            }
        }

    });

    $('#noti_count').on('click',function (){
        counter = 0;
        $('.counter').text('0').hide();
    });

});
