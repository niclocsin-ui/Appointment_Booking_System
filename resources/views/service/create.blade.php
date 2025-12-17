@extends('layout')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h4 class="mb-0">Book an Appointment</h4>
            </div>
            <div class="card-body">
                <form action="/book" method="POST">
                    @csrf
                    
                    <!-- 1. Client ID (Simulating Login) -->
                    <div class="mb-3">
                        <label class="form-label">Your Client ID</label>
                        <input type="number" name="ClientID" class="form-control" placeholder="Enter your ID (e.g. 1)" required>
                        <small class="text-muted">Since we don't have login yet, enter the ID of a client in your DB.</small>
                    </div>

                    <!-- 2. Select Service -->
                    <div class="mb-3">
                        <label class="form-label">Select Service</label>
                        <select name="ServiceID" class="form-select" required>
                            <option value="">-- Choose a Service --</option>
                            @foreach($services as $service)
                                <option value="{{ $service->ServiceID }}">
                                    {{ $service->ServiceName }} (${{ $service->Price }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- 3. Optional Staff -->
                    <div class="mb-3">
                        <label class="form-label">Preferred Staff ID (Optional)</label>
                        <input type="number" name="StaffID" class="form-control" placeholder="Enter Staff ID">
                    </div>

                    <!-- 4. Date & Time -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Date</label>
                            <input type="date" name="AppointmentDate" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Time</label>
                            <input type="time" name="AppointmentTime" class="form-control" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Book Now</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection