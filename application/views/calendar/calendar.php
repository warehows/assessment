<link href='../css/fullCalendar/fullcalendar.min.css' rel='stylesheet' />
<link href='../css/fullCalendar/fullcalendar.print.min.css' rel='stylesheet' media='print' />
<script src='../js/fullCalendar/moment.min.js'></script>
<script src='../js/fullCalendar/jquery.min.js'></script>
<script src='../js/fullCalendar/fullcalendar.min.js'></script>
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



<style>

    body {
        margin: 40px 10px;
        padding: 0;
        font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
        font-size: 14px;
    }

    #calendar {
        max-width: 900px;
        margin: 0 auto;
    }

    .closeon {
        height: 8px;
        width: 8px;
        padding: 2px;
        background-color: white;
        border-radius: 90px;
        font-size: 6pt;
        top: 1.5px;
        position: absolute;
        right: 1px;
        line-height: 8px;
    }
    .closeon span {
        margin-left: 1.5px;
        color: black;
        font-weight: 900;
    }
    /*.closeon:after {
        content: '×'; 
    }*/

    /*.tooltip {
    position: relative;
    display: inline-block;
    border-bottom: 1px dotted black;
    }*/

    .tiptool .tiptooltext {
        visibility: hidden;
        width: 120px;
        background-color: #555;
        color: #fff;
        text-align: center;
        border-radius: 6px;
        padding: 5px 0;
        position: absolute;
        z-index: 1;
        bottom: 125%;
        left: 50%;
        margin-left: -60px;
        opacity: 0;
        transition: opacity 1s;
    }

    .tiptool .tiptooltext::after {
        content: "";
        position: absolute;
        top: 100%;
        left: 50%;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: #555 transparent transparent transparent;
    }

    .tiptool:hover .tiptooltext {
        visibility: visible;
        z-index: 1000;
        opacity: 1;
    }



</style>

<div class="wrapper">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12">
            <div class="two wizard">
                <a href="calendar/create" class="btn btn-info btn-md">Add event</a>
                <div id='calendar'></div>

            </div>
        </div>
    </div>
</div>

<div class="footer-clean">
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-lg-offset-9 col-md-3 col-md-offset-9 item social">
                    <p class="copyright">Powered by Click Innovation © 2017</p>
                </div>
            </div>
        </div>
    </footer>
</div>


<script>
    $(document).ready(function() {

        var d = new Date()
        var curr_day = d.getDate().toString().length == 1 ? "0"+d.getDate(): d.getDate();
        var curr_month = d.getMonth().toString().length == 1 ? "0"+d.getMonth(): d.getMonth();
        var curr_year = d.getFullYear()

        var today = curr_year+"-"+curr_month+"-"+curr_day;

        $('#calendar').fullCalendar({
            events: 'calendar/getEvents',
            editable: true,
            displayEventTime: false,
            defaultDate: '2017-07-17',
            eventResize: function(event, delta, revertFunc) {
                var df = new Date(event.start.format());
                var df_year = df.getFullYear();
                var df_month = df.getMonth() + 1;
                var df_day = df.getDate();
                var dateFrom = df_year+"-"+df_month+"-"+df_day;

                var dt = new Date(event.end.format());
                var dt_year = dt.getFullYear();
                var dt_month = dt.getMonth() + 1;
                var dt_day = dt.getDate() - 1;
                var dateTo = dt_year+"-"+dt_month+"-"+dt_day;

                var calendar_id = event.id

                if (!confirm("is this okay?")) {
                    revertFunc();
                } else {
                    console.log(dateFrom+" === "+dateTo)
                    $.post('calendar/update', {dateFrom: dateFrom,dateTo: dateTo, calendar_id: calendar_id}, function(data, textStatus, xhr) {
                        console.log(data);
                    });
                }
            },
            eventDrop: function(event, delta, revertFunc) {

                var df = new Date(event.start.format());
                var df_year = df.getFullYear();
                var df_month = df.getMonth() + 1;
                var df_day = df.getDate();
                var dateFrom = df_year+"-"+df_month+"-"+df_day;

                var dt = new Date(event.end.format());
                var dt_year = dt.getFullYear();
                var dt_month = dt.getMonth() + 1;
                var dt_day = dt.getDate() - 1;
                var dateTo = dt_year+"-"+dt_month+"-"+dt_day;

                var calendar_id = event.id

                if (!confirm("is this okay?")) {
                    revertFunc();
                } else {
                    console.log(dateFrom+" === "+dateTo)
                    
                    $.post('calendar/update', {dateFrom: dateFrom,dateTo: dateTo, calendar_id: calendar_id}, function(data, textStatus, xhr) {
                        console.log(data);
                    });
                }
            },
            eventRender: function(event, element, view) {
                if (view.name == 'listDay') {
                    element.find(".fc-list-item-time").append("<span class='closeon pull-right tiptool'><span>X</span class='tiptooltext'><span>this text</span></span>");
                } else {
                    element.find(".fc-content").prepend("<span class='closeon pull-right tiptool'><span>X</span><span class='tiptooltext'>this text</span></span>");
                }
                element.find(".closeon").on('click', function() {
                    if (confirm("Are you sure you want to delete this schedule?")) {
                        $.post('calendar/delete', {id: event.id}, function(data, textStatus, xhr) {
                            $('#calendar').fullCalendar('removeEvents',event._id);
                        });
                    }
                });
            }
        });//end








        $('#grade').change(function(event) {
            $.post('calendar/getSection', {grade: $('#grade').val()}, function(data, textStatus, xhr) {
                $('#section').html("<option>Select section</option>");
                $.each(JSON.parse(data), function(index, val) {
                    var option = "<option value='"+val.gid+"'>"+val.group_name+"</option>";

                    $("#section").append(option);
                });

                $.post('calendar/getLessons', {grade: $('#grade').val()}, function(data, textStatus, xhr) {
                $('#subject').html("<option>Select lesson</option>");
                $.each(JSON.parse(data), function(index, val) {
                    var option = "<option value='"+val.id+"'>"+val.lesson_name+"</option>";

                    $("#subject").append(option);
                });
            });
            });
        });

        $('#submit').click(function(){

        });
    });
</script>
