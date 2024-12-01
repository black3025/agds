@section('page-style')
  <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core/main.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid/main.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid/main.css" rel="stylesheet" />
    <style>
        #calendar-container {
          font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
          font-size: 14px;
        }
        .fc-event-title{
         color: white;
         cursor: pointer;
        }
        .fc-header-toolbar {
          /*
          the calendar will be butting up against the edges,
          but let's scoot in the header's buttons
          */
          padding-top: 1em;
          padding-left: 1em;
          padding-right: 1em;
        }
    </style>
@endsection
@section('page-script')  
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
  <script> 
            document.addEventListener('DOMContentLoaded', function () {
                var calendarEl = document.getElementById('calendar');
                
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    timeZone: 'UTC',
                    initialView: 'dayGridMonth',
                    contentHeight: 'auto',
                    height: '100%',
                    events: @json($events),
                   
                });
                calendar.render();
            });
  </script>

@endsection
{{-- timeGridWeek --}}
{{--  eventClick: function(info) {
                      $('#EventCourse').text(info.event.title);
                      var Month= ["January","Februray","March","April","May","June","July","August","September","October","November","December"]
                      var dstart =  new Date(info.event.start);
                      var dend =  new Date(info.event.end);
                      
                      $('#EventDate').text(Month[dstart.getMonth()] + " " + dstart.getDate() +", " + (dstart.getYear() + 1900) );

                      //try to get details
                      $.get('{{route("getCourse")}}',{},function(data){
                          $('#all_course').html(data.result);
                      },'json');
        }

                      // change the border color just for fun
                      info.el.style.borderColor = 'red';
                    }alert('Event: ' + info.event.title);
                      alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
                      alert('View: ' + info.view.type); --}}
<div id='calendar-container'>
      <button hidden name="show" id= "show"
        type="button"
        class="btn btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#eventDetails">
                                
      </button>
  <div id="calendar">
  </div>
 @include('content/calendar/eventDetail')

</div>