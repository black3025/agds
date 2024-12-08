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
        .fc-eventTextColor{
          color: white;
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
                var colors=['#429de3','#ae52e3']
                var index= 0;
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    timeZone: 'UTC',
                    initialView: 'dayGridMonth',
                    contentHeight: 'auto',
                    height: '100%',
                    events: @json($events),
                    eventBackgroundColor: '#ae52e3'
                });
                calendar.render();
                 
            });
           
  </script>

@endsection
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