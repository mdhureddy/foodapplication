<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Food Name</th>
            <th>Restaurant Name</th>
            <!-- Add other columns as needed -->
            <th>Distance (in km)</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->food_name }}</td>
                <td>{{ $item->restaurant_name }}</td>
                <!-- Add other columns as needed -->
                <td>{{ $item->distance }} km</td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>