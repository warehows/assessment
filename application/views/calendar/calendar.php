<link href='../css/fullCalendar/fullcalendar.min.css' rel='stylesheet' />
<link href='../css/fullCalendar/fullcalendar.print.min.css' rel='stylesheet' media='print' />
<script src='../js/fullCalendar/moment.min.js'></script>
<script src='../js/fullCalendar/fullcalendar.min.js'></script>

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

    .filterOptions {
        margin-right: 20px;
    }

    .offset-right-1 {
        margin-right: 8.33333333%;
    }

    .filterForm {
        margin-bottom: 15px;
    }

    .btn {
        border-radius: 50px;
    }
</style>

<div class="wrapper">
    <div class="container">
        <div class="row">
            <div class="form-inline filterForm">
                <?php if ( $logged_in['su'] === '1' ) : ?>
                    <label class="control-label col-sm-1 col-md-offset-1">Filter by:</label>
                    <div class="form-group filterOptions">
                        <select class="form-control" id="teacher">
                            <option value="">Select teacher</option>
                            <?php foreach ($teachers as $key => $value) { ?>
                                <option value="<?php echo $value['uid']; ?>"><?php echo $value['first_name']." ".$value['last_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group filterOptions">
                        <select class="form-control" id="grade">
                            <option value="">Select grade</option>
                            <?php foreach ($grades as $key => $value) { ?>
                                <option value="<?php echo $value['lid']; ?>"><?php echo (strlen($value['level_name']) > 1 ? "" : "Grade ").$value['level_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group filterOptions">
                        <select class="form-control" id="section">
                            <option value="">Select section</option>
                            <?php foreach ($section as $key => $value) { ?>
                                <option value="<?php echo $value['gid']; ?>"><?php echo $value['group_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group filterOptions">
                        <select class="form-control" id="subject">
                            <option value="">Select subject</option>
                            <?php foreach ($subject as $key => $value) { ?>
                                <option value="<?php echo $value['cid']; ?>"><?php echo $value['category_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <button type="button" class="btn btn-success" id="reset">
                        <span class="glyphicon glyphicon-repeat"></span>
                    </button>
                <?php endif; ?>
                <a href="calendar/create" class="btn btn-primary pull-right offset-right-1"><span class="glyphicon glyphicon-plus"></span> Add event</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
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

                if (!confirm("Are you sure you want to change event schedule?")) {
                    revertFunc();
                } else {
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

                if (!confirm("Are you sure you want to change event schedule?")) {
                    revertFunc();
                } else {

                    $.post('calendar/update', {dateFrom: dateFrom,dateTo: dateTo, calendar_id: calendar_id}, function(data, textStatus, xhr) {
                        console.log(data);
                    });
                }
            },
            eventRender: function(event, element, view) {
                if (view.name == 'listDay') {
                    element.find(".fc-list-item-time").append("<span class='closeon pull-right tiptool'><span>X</span class='tiptooltext'><span>Delete</span></span>");
                } else {
                    element.find(".fc-content").prepend("<span class='closeon pull-right tiptool'><span>X</span><span class='tiptooltext'>Delete</span></span>");
                }
                element.find(".closeon").on('click', function() {
                    if (confirm("Are you sure you want to delete this schedule?")) {
                        $.post('calendar/delete', {id: event.id}, function(data, textStatus, xhr) {
                            $('#calendar').fullCalendar('removeEvents',event._id);
                        });
                    }
                });
            },
            eventClick: function(calEvent, jsEvent, view) {
                console.log(calEvent);
            }
        });//end

        $('.filterOptions select').change(function(event) {
            var teacher = $('#teacher').val();
            var grade = $('#grade').val();
            var section = $('#section').val();
            var subject = $('#subject').val();

            $.post('calendar/getEvents', {filter: true,teacher: teacher, grade: grade, section: section, subject: subject}, function(data, textStatus, xhr) {
                $('#calendar').fullCalendar('removeEvents');
                $('#calendar').fullCalendar('addEventSource', JSON.parse(data))
            });
        });

        $('#reset').click(function(event) {
            $('#teacher').val("");
            $('#grade').val("");
            $('#section').val("");
            $('#subject').val("");

            $('#calendar').fullCalendar('removeEvents');

            $('#calendar').fullCalendar('addEventSource',{url: 'calendar/getEvents'})
        });

    });
</script>
