<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Service</title>
</head>
<body>
    <h2>Add New Service</h2>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <br>
    @endif

    <form action="{{ url('service/create') }}" method="post">
        @csrf

        <label>Service Name:</label><br>
        <input type="text" name="service_name" required><br><br>

        <label>Description:</label><br>
        <input type="text" name="description" required><br><br>

        <label>Duration:</label><br>
        <input type="text" name="duration" required><br><br>

        <label>Price:</label><br>
        <input type="number" name="price" step="0.01" required><br><br>

        <button type="submit">Add Service</button>
    </form>

    <br>
    <a href="{{ url('service') }}">Back to Service List</a>
</body>
</html>