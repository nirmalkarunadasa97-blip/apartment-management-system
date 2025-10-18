@extends('layer.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $announcement->title }}</h1>
                </div>
                <div class="col-sm-6">
                    @if(auth()->user()->user_role_id == 1)
                        <a href="{{ route('announcements.edit', $announcement->announcement_id) }}" class="btn btn-warning float-right">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    @if($announcement->image)
                        <div class="text-center mb-3">
                            <img src="{{ asset('storage/' . $announcement->image) }}" alt="Announcement Image" class="img-fluid" style="max-height: 400px;">
                        </div>
                    @endif

                    <p class="text-muted">
                        <i class="fas fa-user"></i> Posted by: {{ $announcement->user->name ?? 'Unknown' }}<br>
                        <i class="fas fa-calendar"></i> Posted on: {{ $announcement->created_at->format('M d, Y') }}
                        @if($announcement->expired_date)
                            <br><i class="fas fa-clock"></i> Expires: {{ \Carbon\Carbon::parse($announcement->expired_date)->format('M d, Y') }}
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
