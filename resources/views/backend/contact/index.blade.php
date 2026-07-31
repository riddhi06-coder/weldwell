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
                <div class="col-6"><h3>Contact Details</h3></div>
                <div class="col-6 text-end">
                    @if(auth()->user()->hasPermission('contact-details.create') && $contacts->isEmpty())
                        <a href="{{ route('manage-contact-details.create') }}" class="btn btn-primary">+ Add Contact Details</a>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display table table-bordered table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Email</th>
                                        <th>Telephone</th>
                                        <th class="text-center">Socials</th>
                                        <th class="text-center">Offices</th>
                                        <th>Status</th>
                                        <th class="text-end" style="min-width:170px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($contacts as $contact)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $contact->email ?: '—' }}</td>
                                            <td>{{ $contact->telephone ?: '—' }}</td>
                                            <td class="text-center"><span class="badge bg-info">{{ $contact->socials_count }}</span></td>
                                            <td class="text-center"><span class="badge bg-info">{{ $contact->offices_count }}</span></td>
                                            <td>
                                                @if($contact->is_active)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-secondary">Inactive</span>
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                <div class="d-flex gap-1 justify-content-end">
                                                    @if(auth()->user()->hasPermission('contact-details.edit'))
                                                        <a href="{{ route('manage-contact-details.edit', $contact->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                    @endif
                                                    @if(auth()->user()->hasPermission('contact-details.delete'))
                                                        <form action="{{ route('manage-contact-details.destroy', $contact->id) }}" method="POST" class="m-0" onsubmit="return confirm('Delete these contact details?')">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="7" class="text-center text-muted py-4">No contact details found.</td></tr>
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
</div>

@include('components.backend.main-js')
</body>
</html>
