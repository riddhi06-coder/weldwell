<!doctype html>
<html lang="en">
<head>
    @include('components.backend.head')
</head>
<body>
@include('components.backend.header')
@include('components.backend.sidebar')

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6"></div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                <svg class="stroke-icon"><use href="../assets/svg/icon-sprite.svg#stroke-home"></use></svg>
                            </a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Permissions by Role</li>
                                </ol>
                            </nav>
                            @if(auth()->user()->hasPermission('permissions.assign'))
                        <a href="{{ route('admin.permissions.manage') }}" class="btn btn-primary px-5 radius-30">Manage Permission Catalog</a>
                    @endif
                        </div>

                        <p class="text-muted mb-3">Choose a role to assign which sections/actions it can access. Super Admin always has full access.</p>
                        <div class="table-responsive custom-scrollbar">
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>Role</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th class="text-end" style="min-width:140px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($roles as $role)
                                        <tr>
                                            <td>
                                                <strong>{{ $role->name }}</strong>
                                                @if($role->is_protected)
                                                    <span class="badge bg-warning text-dark ms-1">protected</span>
                                                @endif
                                            </td>
                                            <td>{{ $role->description ?: '—' }}</td>
                                            <td>
                                                @if($role->is_active)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-secondary">Inactive</span>
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                @if(auth()->user()->hasPermission('permissions.assign') && ! $role->is_protected)
                                                    <a href="{{ route('admin.permissions.edit', $role) }}" class="btn btn-sm btn-primary">Manage</a>
                                                @else
                                                    <span class="text-muted small">—</span>
                                                @endif
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
</div>
@include('components.backend.footer')
</div>

@include('components.backend.main-js')
</body>
</html>
