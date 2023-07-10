<!DOCTYPE html>
<head>
        @vite('resources/js/app.js')
</head>

<body>
    <div id="app">
        <!-- <Calendar/> -->
        @foreach ($data['lessons'] as $lesson)

        <p>This date {{ \Carbon\Carbon::parse($lesson->start_at->date)->format('d-m-Y H:i') }}</p>
        
        @endforeach
        <div>
            These students for the selected class:
            @foreach ($data['students'] as $student)

            <p>Student name: {{ $student->forename }} {{ $student->surname}} </p>
            @endforeach
        </div>
    </div>
</body>