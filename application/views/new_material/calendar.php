<link href='<?php echo base_url('css/fullCalendar/fullcalendar.min.css'); ?>' rel='stylesheet'/>
<link href='<?php echo base_url('css/fullCalendar/fullcalendar.print.min.css'); ?>' rel='stylesheet' media='print'/>
<script src='<?php echo base_url('js/fullCalendar/moment.min.js'); ?>'></script>
<script src='<?php echo base_url('js/fullCalendar/jquery.min.js'); ?>'></script>
<script src='<?php echo base_url('js/fullCalendar/fullcalendar.min.js'); ?>'></script>
<script>

    $(document).ready(function () {

        $('#calendar').fullCalendar({
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            events: [
                {
                    title: 'All Day Event',
                    start: '2018-04-01'
                },
                {
                    title: 'Long Event',
                    start: '2018-04-07',
                    end: '2018-04-10'
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: '2018-04-09T16:00:00'
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: '2018-04-16T16:00:00'
                },
                {
                    title: 'Conference',
                    start: '2018-04-11',
                    end: '2018-04-13'
                },
                {
                    title: 'Meeting',
                    start: '2018-04-12T10:30:00',
                    end: '2018-04-12T12:30:00'
                },
                {
                    title: 'Lunch',
                    start: '2018-04-12T12:00:00'
                },
                {
                    title: 'Meeting',
                    start: '2018-04-12T14:30:00'
                },
                {
                    title: 'Happy Hour',
                    start: '2018-04-12T17:30:00'
                },
                {
                    title: 'Dinner',
                    start: '2018-04-12T20:00:00'
                },
                {
                    title: 'Birthday Party',
                    start: '2018-04-13T07:00:00'
                },
                {
                    title: 'Click for Google',
                    url: 'http://google.com/',
                    start: '2018-04-28'
                }
            ]
        });

    });

</script>
<style>

    /*body {*/
        /*margin: 40px 10px;*/
        /*padding: 0;*/
        /*font-family: "Lucida Grande", Helvetica, Arial, Verdana, sans-serif;*/
        /*font-size: 14px;*/
    /*}*/

    #calendar {
        max-width: 900px;
        margin: 0 auto;
    }

</style>


<div id='calendar'></div>



