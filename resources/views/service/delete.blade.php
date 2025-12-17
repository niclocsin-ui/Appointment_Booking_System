<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Service</title>
</head>
<body>
    <p>Are you sure you want to delete this service "<strong>{{ $serviceEntry[0]->service_name }}</strong>"?</p>
    <a href="{{ url('service/'.$serviceEntry[0]->id.'/destroy') }}">Yes</a>
    <a href="{{ url('service') }}">No</a>
</body>
</html>