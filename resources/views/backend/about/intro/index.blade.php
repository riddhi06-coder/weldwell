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
                                    <svg class="stroke-icon">
                                        <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                                    </svg>
                                </a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                        <li class="breadcrumb-item active">Introduction</li>
                                    </ol>
                                </nav>
                                {{-- Show Add only while no ACTIVE introduction exists (inactive ones don't block it). --}}
                                @if(auth()->user()->hasPermission('about-intro.create') && ! $intros->firstWhere('is_active', true))
                                    <a href="{{ route('manage-about-intro.create') }}" class="btn btn-primary px-5 radius-30">
                                        + Add Introduction
                                    </a>
                                @endif
                            </div>

                            <div class="table-responsive custom-scrollbar">
                                <table class="display" id="basic-1">
                                    <thead>
                                        <tr>
                                            <th>Sr No.</th>
                                            <th>Heading</th>
                                            <th>Vision / Mission</th>
                                            <th>Status</th>
                                            <th class="text-end" style="min-width:170px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($intros as $intro)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $intro->heading ?: '—' }}</td>
                                                <td><span class="badge bg-primary">{{ $intro->visions_count }}</span></td>
                                                <td>
                                                    @if($intro->is_active)
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                        <span class="badge bg-secondary">Inactive</span>
                                                    @endif
                                                </td>
                                                <td class="text-end">
                                                    <div class="d-flex gap-1 justify-content-end">
                                                        @if(auth()->user()->hasPermission('about-intro.edit'))
                                                            <a href="{{ route('manage-about-intro.edit', $intro->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                        @endif
                                                        @if(auth()->user()->hasPermission('about-intro.delete'))
                                                            <form action="{{ route('manage-about-intro.destroy', $intro->id) }}" method="POST" class="m-0" onsubmit="return confirm('Delete this introduction?');">
                                                                @csrf @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr><td colspan="5" class="text-center text-muted py-4">No introduction added yet.</td></tr>
                                        @endforelse
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
    @include('components.backend.main-js')
</body>
</html>
