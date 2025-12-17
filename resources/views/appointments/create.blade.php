@extends('layout')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card p-4">
            <div class="card-body">
                <div class="text-center mb-4">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex p-3 mb-3">
                        <i class="bi bi-calendar-plus fs-3"></i>
                    </div>
                    <h4 class="fw-bold">Book Appointment</h4>
                    <p class="text-muted small">Select a service and time below</p>
                </div>

                <form action="/book" method="POST">
                    @csrf
                    
                    <!-- Service Selection -->
                    <div class="mb-3">
                        <label class="form-label small text-muted fw-bold text-uppercase">Service</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0"><i class="bi bi-scissors"></i></span>
                            <select name="ServiceID" class="form-select border-0 bg-light" required>
                                <option value="">Select a Service...</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->ServiceID }}">
                                        {{ $service->ServiceName }} (${{ $service->Price }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Staff Selection -->
                    <div class="mb-3">
                        <label class="form-label small text-muted fw-bold text-uppercase">Preferred Staff (Optional)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0"><i class="bi bi-person"></i></span>
                            <input type="number" name="StaffID" class="form-control border-0 bg-light" placeholder="Staff ID (e.g. 1)">
                        </div>
                    </div>

                    <!-- Date & Time -->
                    <div class="row g-2 mb-4">
                        <div class="col-6">
                            <label class="form-label small text-muted fw-bold text-uppercase">Date</label>
                            <input type="date" name="AppointmentDate" class="form-control border-0 bg-light" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label small text-muted fw-bold text-uppercase">Time</label>
                            <input type="time" name="AppointmentTime" class="form-control border-0 bg-light" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2 rounded-3 shadow-sm">
                        Confirm Booking <i class="bi bi-arrow-right ms-2"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection