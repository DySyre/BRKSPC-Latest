<!DOCTYPE html>
<style>
    .fc-event-title-container{
        text-align:center;
    }
    .fc-event-title.fc-sticky{
        font-size:2em;
    }
</style>
<?php 
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "login_db";

$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
$sql = "SELECT * FROM login_db";

$appointments = $con->query("SELECT * FROM `appointment_list` where `status` in (0,1) and date(schedule) >= '".date("Y-m-d")."' ");
$appoinment_arr = [];
while($row = $appointments->fetch_assoc()){
    if(!isset($appoinment_arr[$row['schedule']])) $appoinment_arr[$row['schedule']] = 0;
    $appoinment_arr[$row['schedule']] += 1;
}

?>

<div class="content py-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-outline card-primary rounded-0 shadow">
                <div class="card-header rounded-0">
                        <h4 class="card-title">Appointment Availablity</h4>
                </div>
                <div class="card-body">
                   <div id="appointmentCalendar"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var calendar;
    var appointment = ('$.parseJSON ($appointment_arr)' ) || {};

    (function(){
        start_loader();
        var date = new Date()
        var d    = date.getDate(),
            m    = date.getMonth(),
            y    = date.getFullYear()
        var Calendar = FullCalendar.Calendar;

        calendar = new Calendar(document.getElementById('appointmentCalendar'), {
            headerToolbar: {
                left  : false,
                center: 'title',
            },
            selectable: true,
            themeSystem: 'bootstrap',
            //Random default events
            events: 
            
            [
                {
                    daysOfWeek: [0,1,2,3,4,5,6], // these recurrent events move separately
                    title:'<? $_settings->info("max_appointment") ?>',
                    allDay: true,
                    }
            ],
            eventClick: function(info) {
                   console.log(info.el)
                   if($(info.el).find('.fc-event-title.fc-sticky').text() > 0)
                    uni_modal("Set an Appointment","add_appointment.php?schedule="+info.event.startStr,"mid-large")
                },
            validRange:{
                start: moment(date).format("YYYY-MM-DD"),
            },
            eventDidMount:function(info){
                // console.log(appointment)
                if(!!appointment[info.event.startStr]){
                    var available = parseInt(info.event.title) - parseInt(appointment[info.event.startStr]);
                     $(info.el).find('.fc-event-title.fc-sticky').text(available)
                }
                end_loader()
            },
            editable  : true
        });

    calendar.render();
    })
</script>