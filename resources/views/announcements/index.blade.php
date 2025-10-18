@extends('layer.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Announcements</h1>
                </div>
                <div class="col-sm-6">
                    @if(auth()->user()->user_role_id == 1)
                        <a href="{{ route('announcements.create') }}" class="btn btn-primary float-right">
                            <i class="fas fa-plus"></i> Create Announcement
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All Announcements</h3>
                        </div>
                        <div class="card-body">
                            @forelse($announcements as $announcement)
                                <div class="card mb-3 border-info">
                                    <div class="card-body">
                                        <div class="row">
                                            @if($announcement->image)
                                            <div class="col-md-3">
                                                <img src="{{ asset('storage/' . $announcement->image) }}"
                                                     alt="Announcement Image"
                                                     class="img-fluid rounded"
                                                     style="max-height: 150px; object-fit: cover; width: 100%;">
                                            </div>
                                            @endif
                                            <div class="{{ $announcement->image ? 'col-md-9' : 'col-md-12' }}">
                                                <h5 class="card-title">{{ $announcement->title }}</h5>
                                                <p class="text-muted small mb-2">
                                                    <i class="fas fa-user"></i> Posted by: {{ $announcement->user->name ?? 'Unknown' }}
                                                    <br>
                                                    <i class="fas fa-calendar"></i> Posted on: {{ $announcement->created_at->format('M d, Y') }}
                                                    @if($announcement->expired_date)
                                                        <br>
                                                        <i class="fas fa-clock"></i> Expires: {{ \Carbon\Carbon::parse($announcement->expired_date)->format('M d, Y') }}
                                                    @endif
                                                </p>
                                                <div class="btn-group">
                                                    <a href="{{ route('announcements.show', $announcement->announcement_id) }}" class="btn btn-sm btn-info">
                                                        <i class="fas fa-eye"></i> View
                                                    </a>
                                                    @if(auth()->user()->role_id == 1)
                                                        <a href="{{ route('announcements.edit', $announcement->announcement_id) }}" class="btn btn-sm btn-warning">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </a>
                                                        <form action="{{ route('announcements.destroy', $announcement->announcement_id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                                <i class="fas fa-trash"></i> Delete
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle"></i> No announcements available at the moment.
                                </div>
                            @endforelse
                        </div>
                        <div class="card-footer clearfix">
                            {{ $announcements->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
