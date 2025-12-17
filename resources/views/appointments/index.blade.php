@extends('layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Staff Dashboard</h4>
        <p class="text-muted small mb-0">Manage upcoming appointments</p>
    </div>
    <span class="badge bg-dark rounded-pill px-3 py-2">{{ session('role') }} View</span>
</div>

<div class="card">
    <div class="card-body p-0">
        @if($appointments->isEmpty())
            <div class="text-center py-5">
                <i class="bi bi-calendar-x text-muted fs-1"></i>
                <p class="text-muted mt-2">No appointments found.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Date & Time</th>
                            <th>Client</th>
                            <th>Service</th>
                            <th>Status</th>
                            <th>Notes</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $apt)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div class="bg-light rounded p-2 me-2 text-center" style="width: 50px;">
                                        <div class="fw-bold text-dark">{{ \Carbon\Carbon::parse($apt->AppointmentDate)->format('d') }}</div>
                                        <div class="small text-uppercase text-muted" style="font-size: 10px;">{{ \Carbon\Carbon::parse($apt->AppointmentDate)->format('M') }}</div>
                                    </div>
                                    <div>
                                        <div class="small text-muted">{{ $apt->AppointmentTime }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="fw-medium text-dark">ID: {{ $apt->ClientID }}</div>
                                <div class="small text-muted">{{ $apt->client ? $apt->client->FirstName : 'Unknown' }}</div>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border">{{ $apt->service ? $apt->service->ServiceName : 'Removed' }}</span>
                            </td>
                            <td>
                                @if($apt->Status == 'Confirmed')
                                    <span class="status-badge bg-success-subtle text-success">Confirmed</span>
                                @elseif($apt->Status == 'Declined')
                                    <span class="status-badge bg-danger-subtle text-danger">Declined</span>
                                @else
                                    <span class="status-badge bg-warning-subtle text-warning">Scheduled</span>
                                @endif
                            </td>
                            
                            <!-- Note Input -->
                            <td>
                                <form action="/appointments/{{ $apt->AppointmentID }}/note" method="POST" class="input-group input-group-sm" style="max-width: 200px;">
                                    @csrf
                                    <input type="text" name="notes" class="form-control" value="{{ $apt->Notes ?? '' }}" placeholder="Add note...">
                                    <button class="btn btn-outline-secondary"><i class="bi bi-save"></i></button>
                                </form>
                            </td>

                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-1">
                                    <form action="/appointments/{{ $apt->AppointmentID }}/status" method="POST">
                                        @csrf <input type="hidden" name="status" value="Confirmed">
                                        <button class="btn btn-sm btn-success" title="Confirm"><i class="bi bi-check-lg"></i></button>
                                    </form>
                                    
                                    <form action="/appointments/{{ $apt->AppointmentID }}/status" method="POST">
                                        @csrf <input type="hidden" name="status" value="Declined">
                                        <button class="btn btn-sm btn-secondary" title="Decline"><i class="bi bi-x-lg"></i></button>
                                    </form>

                                    @if(session('role') === 'admin')
                                        <form action="/appointments/{{ $apt->AppointmentID }}" method="POST" onsubmit="return confirm('Delete?');">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-danger ms-2" title="Delete"><i class="bi bi-trash"></i></button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection