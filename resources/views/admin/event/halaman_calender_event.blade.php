@extends('admin.layouts2.master')
@section('title', 'Kalender Event')
@section('content')

    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" /> --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    </head>

    <body>

        <div class="container">
            <div class="panel panel-primary">
                <div class="panel-body">
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </body>
    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var calendar = $('#calendar').fullCalendar({
                editable: true,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    // right: 'month,agendaWeek,agendaDay'
                    right: 'month'

                },
                events: '/jscalender'
            });
            calendar.render();
        });
    </script>
@endsection
