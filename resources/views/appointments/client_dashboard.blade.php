@extends('layout')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <!-- Header -->
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">My Appointment History</h4>
            <a href="/book" class="btn btn-primary btn-sm">Book New Appointment</a>
        </div>

        <!-- Body -->
        <div class="card-body">
            
            @if($appointments->isEmpty())
                <!-- Empty State -->
                <div class="text-center py-5">
                    <h5 class="text-muted">You have no appointments yet.</h5>
                    <p>Ready to schedule your first visit?</p>
                    <a href="/book" class="btn btn-outline-primary">Book Now</a>
                </div>
            @else
                <!-- Appointments Table -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Date & Time</th>
                                <th>Service</th>
                                <th>Staff Assigned</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appointments as $apt)
                            <tr>
                                <!-- Date Column -->
                                <td>
                                    <strong>{{ $apt->AppointmentDate }}</strong><br>
                                    <small class="text-muted">{{ $apt->AppointmentTime }}</small>
                                </td>

                                <!-- Service Column -->
                                <td>
                                    @if($apt->service)
                                        {{ $apt->service->ServiceName }}
                                        <span class="text-muted">(${{ $apt->service->Price }})</span>
                                    @else
                                        <span class="text-danger">Service No Longer Available</span>
                                    @endif
                                </td>

                                <!-- Staff Column -->
                                <td>
                                    @if($apt->staff)
                                        Dr. {{ $apt->staff->LastName }}
                                    @else
                                        <span class="text-muted font-italic">Any Available Staff</span>
                                    @endif
                                </td>

                                <!-- Status Column -->
                                <td>
                                    @if($apt->Status == 'Scheduled')
                                        <span class="badge bg-warning text-dark">Scheduled</span>
                                    @elseif($apt->Status == 'Confirmed')
                                        <span class="badge bg-success">Confirmed</span>
                                    @elseif($apt->Status == 'Canceled')
                                        <span class="badge bg-danger">Canceled</span>
                                    @elseif($apt->Status == 'Declined')
                                        <span class="badge bg-secondary">Declined</span>
                                    @else
                                        <span class="badge bg-secondary">{{ $apt->Status }}</span>
                                    @endif
                                </td>

                                <!-- Action Column (Cancel Logic) -->
                                <td>
                                    <!-- Business Rule: Can only cancel if currently Scheduled -->
                                    @if($apt->Status == 'Scheduled')
                                        <form action="/appointments/{{ $apt->AppointmentID }}/cancel" method="POST" onsubmit="return confirm('Are you sure you want to cancel this appointment?');">
                                            @csrf
                                            <button class="btn btn-sm btn-outline-danger">Cancel Booking</button>
                                        </form>
                                    @elseif($apt->Status == 'Canceled')
                                        <small class="text-muted">Canceled</small>
                                    @else
                                        <small class="text-muted">Closed</small>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection