@extends('backend.layouts.master')

@section('page_title', __('back.add_report'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ __('back.add_report') }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="employee_id" class="form-label">{{ __('back.employee') }}</label>
                                    <select class="form-control select2 @error('employee_id') is-invalid @enderror" id="employee_id" name="employee_id">
                                        <option value="">{{ __('back.select_employee') }}</option>
                                        @foreach($employees as $employee)
                                        <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                                            {{ $employee->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('employee_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="report_date" class="form-label">{{ __('back.report_date') }} <span class="text-danger">*</span></label>
                                    <input type="datetime-local" class="form-control @error('report_date') is-invalid @enderror"
                                           id="report_date" name="report_date" value="{{ old('report_date', now()->format('Y-m-d\TH:i')) }}" required>
                                    @error('report_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="location_id" class="form-label">{{ __('back.location') }} <span class="text-danger">*</span></label>
                                    <select class="form-control select2 @error('location_id') is-invalid @enderror" id="location_id" name="location_id" required>
                                        <option value="">{{ __('back.select_location') }}</option>
                                        @foreach($locations as $location)
                                        <option value="{{ $location->id }}" {{ old('location_id') == $location->id ? 'selected' : '' }}>
                                            {{ $location->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('location_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="severity_level_id" class="form-label">{{ __('back.severity_level') }} <span class="text-danger">*</span></label>
                                    <select class="form-control select2 @error('severity_level_id') is-invalid @enderror" id="severity_level_id" name="severity_level_id" required>
                                        <option value="">{{ __('back.select_severity') }}</option>
                                        @foreach($severityLevels as $level)
                                        <option value="{{ $level->id }}" {{ old('severity_level_id') == $level->id ? 'selected' : '' }}>
                                            {{ $level->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('severity_level_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('back.gps') }}</label>
                                    <div class="input-group">
                                        <button type="button" class="btn btn-primary" onclick="detectLocation()">
                                            <i class="ti ti-current-location"></i> {{ __('back.detect_location') }}
                                        </button>
                                        <input type="text" class="form-control" id="location_display" readonly placeholder="{{ __('back.location_not_detected') }}">
                                    </div>
                                    <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude') }}">
                                    <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude') }}">
                                    <input type="hidden" name="map_url" id="map_url" value="{{ old('map_url') }}">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="short_description" class="form-label">{{ __('back.short_description') }} <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('short_description') is-invalid @enderror"
                                              id="short_description" name="short_description" rows="3" required>{{ old('short_description') }}</textarea>
                                    @error('short_description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="attachments" class="form-label">{{ __('back.attachments') }}</label>
                                    <input type="file" class="form-control @error('attachments.*') is-invalid @enderror"
                                           id="attachments" name="attachments[]" multiple accept="image/*,audio/*,video/*">
                                    <small class="text-muted">{{ __('back.accepted_files') }}: JPG, PNG, GIF, MP3, WAV, OGG, MP4 ({{ __('back.max_size') }}: 10MB)</small>
                                    @error('attachments.*')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div id="file-preview" class="row g-2 mb-3"></div>
                            </div>
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-device-floppy"></i> {{ __('back.save') }}
                            </button>
                            <a href="{{ route('reports.index') }}" class="btn btn-secondary">
                                <i class="ti ti-arrow-back"></i> {{ __('back.back') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Detect location function
    function detectLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function(position) {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;

                    document.getElementById('latitude').value = lat.toFixed(6);
                    document.getElementById('longitude').value = lng.toFixed(6);
                    document.getElementById('location_display').value = lat.toFixed(6) + ', ' + lng.toFixed(6);
                    document.getElementById('map_url').value = 'https://www.google.com/maps?q=' + lat + ',' + lng;
                },
                function(error) {
                    alert('{{ __("back.location_error") }}: ' + error.message);
                },
                { enableHighAccuracy: true }
            );
        } else {
            alert('{{ __("back.geolocation_not_supported") }}');
        }
    }

    $(document).ready(function() {
        $('.select2').select2({
            theme: 'bootstrap-5'
        });

        // File preview
        $('#attachments').on('change', function() {
            const files = this.files;
            const preview = $('#file-preview');
            preview.empty();

            Array.from(files).forEach(file => {
                const fileType = file.type.split('/')[0];
                const fileSize = (file.size / 1024 / 1024).toFixed(2);

                if (fileType === 'image') {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.append(`
                            <div class="col-md-2">
                                <div class="card">
                                    <img src="${e.target.result}" class="card-img-top" style="height: 100px; object-fit: contain;">
                                    <div class="card-body p-2">
                                        <small class="text-muted">${file.name}<br>${fileSize} MB</small>
                                    </div>
                                </div>
                            </div>
                        `);
                    };
                    reader.readAsDataURL(file);
                } else if (fileType === 'audio') {
                    preview.append(`
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body text-center">
                                    <i class="ti ti-music" style="font-size: 48px;"></i>
                                    <p class="mb-0"><small>${file.name}<br>${fileSize} MB</small></p>
                                </div>
                            </div>
                        </div>
                    `);
                }
            });
        });
    });
</script>
@endpush
