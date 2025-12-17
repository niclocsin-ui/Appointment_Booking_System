<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Service</title>
</head>
<body>
    <h2>Edit Service</h2>

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

    <form action="{{ url('service/'.$serviceEntry[0]->id.'/update') }}" method="post">
        @csrf

        <label>Service Name:</label><br>
        <input type="text" name="service_name" value="{{ $serviceEntry[0]->service_name }}" required><br><br>

        <label>Description:</label><br>
        <input type="text" name="description" value="{{ $serviceEntry[0]->description }}" required><br><br>

        <label>Duration:</label><br>
        <input type="text" name="duration" value="{{ $serviceEntry[0]->duration }}" required><br><br>

        <label>Price:</label><br>
        <input type="number" name="price" value="{{ $serviceEntry[0]->price }}" step="0.01" required><br><br>

        <button type="submit">Update Service</button>
    </form>

    <br>
    <a href="{{ url('service') }}">Back to Service List</a>
</body>
</html>