@extends('layout')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Appointment Dashboard</h4>
        <span class="badge bg-primary">Staff View</span>
    </div>
    <div class="card-body">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Client</th>
                    <th>Service</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $apt)
                <tr>
                    <td>{{ $apt->AppointmentDate }}</td>
                    <td>{{ $apt->AppointmentTime }}</td>
                    
                    <!-- Using the relationships we defined in Models -->
                    <td>ID: {{ $apt->ClientID }}</td> 
                    <td>
                        @if($apt->service)
                            {{ $apt->service->ServiceName }}
                        @else
                            <span class="text-danger">Service Deleted</span>
                        @endif
                    </td>

                    <td>
                        @if($apt->Status == 'Scheduled')
                            <span class="badge bg-warning text-dark">{{ $apt->Status }}</span>
                        @elseif($apt->Status == 'Confirmed')
                            <span class="badge bg-success">{{ $apt->Status }}</span>
                        @else
                            <span class="badge bg-secondary">{{ $apt->Status }}</span>
                        @endif
                    </td>

                    <td>
                        <div class="d-flex gap-2">
                            <!-- Approve Button -->
                            <form action="/appointments/{{ $apt->AppointmentID }}/status" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="Confirmed">
                                <button class="btn btn-sm btn-success">Confirm</button>
                            </form>

                            <!-- Decline Button -->
                            <form action="/appointments/{{ $apt->AppointmentID }}/status" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="Declined">
                                <button class="btn btn-sm btn-secondary">Decline</button>
                            </form>

                            <!-- Delete Button (Red) -->
                            <form action="/appointments/{{ $apt->AppointmentID }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection