<style>
    .ajs-cancel{
        display: none;
    }
</style>
<script>

    // today Meeting Count

    $(document).ready(function () {
        today_meeting_count()

        today_follow_up_count()
    })
    function today_meeting_count() {
        $.ajax({
            url: "{{ route('property_manager.today_meeting_count',Helpers::user_login_route()['panel']) }}",
            type: "GET",
            dataType: "json",
            success: function (data) {
                if(data.status == 'success'){
                    todayMeetingCountAlert(data.count,data.id)
                }
            },
        });
    }
    function today_follow_up_count() {
        $.ajax({
            url: "{{ route('property_manager.today_follow_up_count',Helpers::user_login_route()['panel']) }}",
            type: "GET",
            dataType: "json",
            success: function (data) {
                if(data.status == 'success'){
                    todayMeetingCountAlert(data.count,data.id)
                }
            },
        });
    }
    function todayMeetingCountAlert(count,id){
        playAudio();
        alertify.confirm('Reminder', 'You Have '+count+' Today.', function(){
            $.ajax({
                url: "{{ route('property_manager.today_count_read',['panel' => Helpers::user_login_route()['panel']]) }}?id="+id,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    console.log(data);
                    return;
                },
            });
        }, function(){
            $.ajax({
                url: "{{ route('property_manager.check_count_read',['panel' => Helpers::user_login_route()['panel']]) }}?id="+id,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    console.log(data.status);
                    if(data.status == 'success'){
                        todayMeetingCountAlert(data.count,data.id);
                    }
                },
            });
        }).set('closable', false);
        pauseAudio();
    }

    // Meeting Schedual Alerts
    setInterval(function () {
        $.ajax({
            url: "{{ route('property_manager.meeting_alert',Helpers::user_login_route()['panel']) }}",
            type: "GET",
            dataType: "json",
            success: function (data) {
                if(data.status == 'success'){
                    meetingAlert(data.time,data.id);
                }
            },
        });
    }, 30000);
    function meetingAlert(time,id){
        playAudio();
        alertify.confirm('Reminder', 'You Have A Meeting at '+time+'. ', function(){
            $.ajax({
                url: "{{ route('property_manager.sale.lead.meetingread',['panel' => (new App\Helpers\Helpers)->user_login_route()['panel']]) }}?id="+id,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    console.log(data);
                    return;
                },
            });
        }, function(){
            $.ajax({
                url: "{{ route('property_manager.sale.lead.isread',['panel' => (new App\Helpers\Helpers)->user_login_route()['panel']]) }}?id="+id,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    console.log(data.status);
                    if(!data.status){
                        meetingAlert(data.time,data.id);
                    }
                },
            });
        }).set('closable', false);
        pauseAudio();
    }
</script>
