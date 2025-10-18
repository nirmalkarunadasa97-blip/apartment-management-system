@extends('layer.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Announcement</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ route('announcements.index') }}" class="btn btn-secondary">Back to Announcements</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Announcement Details</h3>
                            </div>
                            <form action="{{ route('announcements.update', $announcement->announcement_id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title">Title <span class="text-danger">*</span></label>
                                        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $announcement->title) }}" required>
                                        @error('title')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        @if($announcement->image)
                                            <div class="mb-2">
                                                <img src="{{ asset('storage/' . $announcement->image) }}" alt="Current Image" class="img-thumbnail" style="max-height: 150px;">
                                                <p class="text-muted small">Current image. Upload a new one to replace it.</p>
                                            </div>
                                        @endif
                                        <input type="file" name="image" id="image" class="form-control-file @error('image') is-invalid @enderror" accept="image/jpeg,image/png,image/jpg">
                                        <small class="form-text text-muted">Allowed formats: JPG, JPEG, PNG. Max size: 2MB. Leave empty to keep current image.</small>
                                        @error('image')
                                            <span class="invalid-feedback d-block">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="expired_date">Expiry Date (Optional)</label>
                                        <input type="date" name="expired_date" id="expired_date" class="form-control @error('expired_date') is-invalid @enderror" value="{{ old('expired_date', $announcement->expired_date) }}">
                                        @error('expired_date')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Update Announcement
                                    </button>
                                    <a href="{{ route('announcements.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-times"></i> Cancel
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
