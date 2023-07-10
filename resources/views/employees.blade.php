<!DOCTYPE html>
<head>
</head>

<body>
    <div>
    @foreach ($data['employees'] as $employee)
    @if (count($employee->classes->data) > 0)
    <p>This class employee {{ $employee->id}} {{ $employee->forename}} {{ $employee->surname }}</p>
        @foreach ($employee->classes->data as $class)
            <p>Class name   <a href="{{ route('classes', ['classesId' => $class->id]) }}">Classes</a>  {{ $class->name }}</p>
        @endforeach
    @endif
     @endforeach     
    </div>
</body>