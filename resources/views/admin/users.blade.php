@extends('layout')

@section('content')
<div class="fade-in-up">
    
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h6 class="text-primary fw-bold text-uppercase ls-1">Admin Panel</h6>
            <h2 class="fw-bold mb-0">Manage Accounts</h2>
        </div>
        <a href="/appointments" class="btn btn-outline-secondary rounded-pill px-4">Back to Dashboard</a>
    </div>

    <div class="row g-4">
        
        <!-- LEFT SIDE: Create User Form -->
        <div class="col-lg-4">
            <div class="card-modern h-100">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3"><i class="bi bi-person-plus-fill text-primary me-2"></i>Create New User</h5>
                    <form action="/admin/users" method="POST">
                        @csrf
                        
                        <!-- User Type Selection -->
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Account Type</label>
                            <select name="user_type" class="form-select" id="userTypeSelect" onchange="toggleRoleField()" required>
                                <option value="client">Client</option>
                                <option value="staff">Staff / Admin</option>
                            </select>
                        </div>

                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <input type="text" name="first_name" class="form-control" placeholder="First Name" required>
                            </div>
                            <div class="col-6">
                                <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                        </div>

                        <div class="mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>

                        <!-- Only shows if Staff is selected -->
                        <div id="staffFields" style="display:none;">
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted">Staff Role</label>
                                <select name="role" class="form-select">
                                    <option value="Provider">Service Provider</option>
                                    <option value="Administrator">Administrator</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <input type="text" name="phone" class="form-control" placeholder="Phone Number">
                            </div>
                        </div>

                        <button class="btn btn-gradient w-100 py-2 rounded-3 fw-bold mt-2">Create Account</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- RIGHT SIDE: Lists -->
        <div class="col-lg-8">
            
            <!-- Staff List -->
            <div class="card-modern mb-4">
                <div class="card-body p-0">
                    <div class="bg-light p-3 border-bottom">
                        <h6 class="fw-bold mb-0 text-uppercase small text-muted">Staff & Admins</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <tbody>
                                @foreach($staff as $s)
                                <tr>
                                    <td class="ps-4">
                                        <div class="fw-bold">{{ $s->FirstName }} {{ $s->LastName }}</div>
                                        <div class="small text-muted">{{ $s->Email }}</div>
                                    </td>
                                    <td>
                                        @if($s->Role == 'Administrator')
                                            <span class="badge bg-dark">Admin</span>
                                        @else
                                            <span class="badge bg-primary bg-opacity-10 text-primary">Provider</span>
                                        @endif
                                    </td>
                                    <td class="text-end pe-4">
                                        <form action="/admin/staff/{{ $s->StaffID }}" method="POST" onsubmit="return confirm('Delete this staff member?');">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-light text-danger"><i class="bi bi-trash-fill"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Client List -->
            <div class="card-modern">
                <div class="card-body p-0">
                    <div class="bg-light p-3 border-bottom">
                        <h6 class="fw-bold mb-0 text-uppercase small text-muted">Clients</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <tbody>
                                @foreach($clients as $c)
                                <tr>
                                    <td class="ps-4">
                                        <div class="fw-bold">{{ $c->FirstName }} {{ $c->LastName }}</div>
                                        <div class="small text-muted">{{ $c->Email }}</div>
                                    </td>
                                    <td><span class="badge bg-secondary bg-opacity-10 text-secondary">Client</span></td>
                                    <td class="text-end pe-4">
                                        <form action="/admin/clients/{{ $c->ClientID }}" method="POST" onsubmit="return confirm('Delete this client?');">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-light text-danger"><i class="bi bi-trash-fill"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    function toggleRoleField() {
        var type = document.getElementById('userTypeSelect').value;
        var staffFields = document.getElementById('staffFields');
        if (type === 'staff') {
            staffFields.style.display = 'block';
        } else {
            staffFields.style.display = 'none';
        }
    }
</script>
@endsection