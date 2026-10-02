<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Vehicle</title>
</head>
<body style="background-color: #121212; color: #e0e0e0; font-family: Arial, sans-serif;">
    <h1>My Vehicles</h1>
    <a href="{{ route ('vehicles.create') }}" class="text-white hover:underline"> Add </a>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>Name</th>
            <th>Brand</th>
            <th>Model</th>
            <th>Year</th>
            <th>Licence Plate</th>
            <th>Initial Odometer</th>
        </tr>
    @foreach ($vehicles as $vehicle)
        <tr>
            <td>
                <a href="{{ route ('vehicles.show', $vehicle) }}"> {{ $vehicle->name }} </a>
            </td>
            <td>{{ $vehicle->brand }}</td>
            <td>{{ $vehicle->model }}</td>
            <td>{{ $vehicle->year }}</td>
            <td>{{ $vehicle->license_plate }}</td>
            <td>{{ $vehicle->initial_odometer }}</td>
        </tr>
    @endforeach
    </table>
</body>
</html>