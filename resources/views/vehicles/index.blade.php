<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Vehicle</title>
</head>
<body>
    <h1>My Vehicles</h1>
    <table>
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
            <td>{{ $vehicle->name }}</td>
            <td>{{ $vehicle->brand }}</td>
            <td>{{ $vehicle->model }}</td>
            <td>{{ $vehicle->year }}</td>
            <td>{{ $vehicle->licence_plate }}</td>
            <td>{{ $vehicle->initial_odometer }}</td>
        </tr>
    @endforeach
    </table>

</body>
</html>