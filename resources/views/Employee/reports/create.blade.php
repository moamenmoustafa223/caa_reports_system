@extends('Employee.layouts.master')

@section('page_title')
    {{ trans('back.add_report') }}
@endsection

@section('title_page')
    {{ trans('back.add_report') }}
@endsection

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        /* Mobile-optimized form styling */
        .mobile-form-container {
            max-width: 100%;
            margin: 0 auto;
            padding: 0;
        }

        .form-section {
            background: white;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 16px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            border: 1px solid #e5e7eb;
        }

        .section-label {
            font-size: 13px;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 16px;
            font-weight: 500;
        }

        .form-field {
            margin-bottom: 16px;
        }

        .form-field:last-child {
            margin-bottom: 0;
        }

        .field-label {
            display: block;
            font-weight: 500;
            font-size: 14px;
            color: #0f172a;
            margin-bottom: 8px;
        }

        .required-star {
            color: #dc2626;
        }

        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            font-size: 15px;
            transition: all 0.2s;
            font-family: inherit;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            outline: none;
            border-color: #262761;
            box-shadow: 0 0 0 3px rgba(38, 39, 97, 0.1);
        }

        .form-textarea {
            resize: vertical;
            min-height: 100px;
        }

        /* Image Capture Buttons */
        .image-buttons {
            display: flex;
            gap: 12px;
            margin-bottom: 12px;
        }

        .image-btn {
            flex: 1;
            padding: 16px;
            border: 2px dashed #cbd5e1;
            border-radius: 12px;
            background: white;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
        }

        .image-btn:hover {
            border-color: #262761;
            background: rgba(38, 39, 97, 0.02);
        }

        .image-btn.active {
            border-color: #262761;
            background: rgba(38, 39, 97, 0.05);
        }

        .image-btn i {
            font-size: 24px;
            color: #262761;
            display: block;
            margin-bottom: 8px;
        }

        .image-btn span {
            font-size: 12px;
            color: #64748b;
            font-weight: 500;
        }

        /* Camera Modal */
        .camera-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            z-index: 9999;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .camera-modal.active {
            display: flex;
        }

        .camera-video {
            max-width: 100%;
            max-height: 70vh;
            border-radius: 12px;
        }

        .camera-controls {
            margin-top: 20px;
            display: flex;
            gap: 16px;
        }

        .camera-btn {
            padding: 16px 32px;
            border-radius: 50px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }

        .capture-btn {
            background: #262761;
            color: white;
        }

        .close-camera-btn {
            background: #dc2626;
            color: white;
        }

        /* Preview Grid */
        .preview-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
            margin-top: 12px;
        }

        .preview-item {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            height: 80px;
            border: 1px solid #e5e7eb;
            background: #f8fafc;
        }

        .preview-item img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .preview-item .remove-btn {
            position: absolute;
            top: 4px;
            right: 4px;
            width: 20px;
            height: 20px;
            background: #dc2626;
            color: white;
            border: none;
            border-radius: 50%;
            font-size: 12px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Map Section */
        .map-container {
            height: 200px;
            border-radius: 12px;
            overflow: hidden;
            border: 2px solid #e5e7eb;
            margin-bottom: 12px;
        }

        #map {
            height: 100%;
            width: 100%;
        }

        .map-actions {
            display: flex;
            gap: 8px;
        }

        .map-btn {
            flex: 1;
            padding: 10px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            background: white;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .map-btn:hover {
            border-color: #262761;
            color: #262761;
        }

        .map-btn.active {
            background: #262761;
            color: white;
            border-color: #262761;
        }

        .coords-display {
            font-size: 12px;
            color: #262761;
            margin-top: 8px;
            text-align: center;
        }

        /* Severity Tags */
        .severity-tags {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .severity-tag {
            flex: 1;
            min-width: calc(50% - 4px);
            position: relative;
        }

        .severity-tag input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .severity-tag label {
            display: block;
            padding: 12px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 999px;
            text-align: center;
            font-weight: 500;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s;
            background: white;
        }

        .severity-tag input:checked+label {
            background: #262761;
            color: white;
            border-color: #262761;
            transform: scale(1.05);
        }

        .severity-tag label:hover {
            border-color: #262761;
        }

        /* Voice Recording */
        .voice-recorder {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            border: 2px dashed #cbd5e1;
            border-radius: 12px;
            background: white;
        }

        .record-btn {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            border: none;
            background: #262761;
            color: white;
            font-size: 24px;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .record-btn.recording {
            background: #dc2626;
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }
        }

        .record-status {
            margin-top: 12px;
            font-size: 14px;
            color: #64748b;
        }

        .record-timer {
            font-size: 18px;
            font-weight: 600;
            color: #262761;
            margin-top: 8px;
        }

        .audio-preview {
            width: 100%;
            margin-top: 12px;
        }

        /* Action Buttons */
        .form-actions {
            display: flex;
            gap: 12px;
            margin-top: 24px;
        }

        .btn-secondary,
        .btn-primary {
            flex: 1;
            padding: 14px 20px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 15px;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-secondary {
            background: #d3d3d3;
            color: #475569;
        }

        .btn-secondary:hover {
            background: #e2e8f0;
        }

        .btn-primary {
            background: linear-gradient(135deg, #262761 0%, #3a3b8a 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(38, 39, 97, 0.3);
        }

        /* Responsive */
        @media (min-width: 769px) {
            .mobile-form-container {
                max-width: 600px;
            }
        }

        @media (max-width: 768px) {
            .severity-tag {
                min-width: 100%;
            }
        }
    </style>
@endsection

@section('content')
    <div class="mobile-form-container">
        <form action="{{ route('employee.reports.store') }}" method="POST" enctype="multipart/form-data" id="reportForm">
            @csrf

            <!-- Image Capture/Upload Section -->
            <div class="form-section">
                <div class="section-label">{{ trans('back.images') }}</div>

                <div class="image-buttons">
                    <div class="image-btn" onclick="openCamera()">
                        <i class="fas fa-camera"></i>
                        <span>{{ trans('back.capture_image') }}</span>
                    </div>
                    <label class="image-btn" for="imageUpload">
                        <i class="fas fa-upload"></i>
                        <span>{{ trans('back.upload_image') }}</span>
                    </label>
                    <input type="file" id="imageUpload" name="attachments[]" multiple accept="image/*"
                        style="display:none" onchange="handleImageUpload(event)">
                </div>

                <div id="imagePreview" class="preview-grid"></div>
                <div id="capturedImagesContainer"></div>
            </div>

            <!-- Location Section -->
            <div class="form-section">
                <div class="section-label">{{ trans('back.location_info') }}</div>

                <div class="form-field">
                    <label class="field-label">{{ trans('back.gps') }}</label>
                    <div class="map-container">
                        <div id="map"></div>
                    </div>
                    <div class="map-actions">
                        <button type="button" class="map-btn" onclick="getCurrentLocation()">
                            <i class="fas fa-crosshairs"></i> {{ trans('back.my_location') }}
                        </button>
                        <button type="button" class="map-btn" onclick="enableMapSelection()">
                            <i class="fas fa-map-marker-alt"></i> {{ trans('back.select_on_map') }}
                        </button>
                    </div>
                    <div class="coords-display" id="coordsDisplay" style="display:none"></div>
                    <input type="hidden" name="latitude" id="latitude">
                    <input type="hidden" name="longitude" id="longitude">
                </div>

                <div class="form-field">
                    <label class="field-label">{{ trans('back.location') }} <span class="required-star">*</span></label>
                    <select class="form-select" name="location_id" required>
                        <option value="">{{ trans('back.select_location') }}</option>

                        @foreach ($locations as $location)
                            <option value="{{ $location->id }}" @if (old('location_id') == $location->id || (count($locations) == 1 && $loop->first)) selected @endif>
                                @if (app()->getLocale() == 'ar')
                                    {{ $location->name_ar }}
                                @else
                                    {{ $location->name_en }}
                                @endif
                            </option>
                        @endforeach
                    </select>

                    @error('location_id')
                        <small style="color:#dc2626">{{ $message }}</small>
                    @enderror
                </div>

            </div>

            <!-- Report Details Section -->
            <div class="form-section">
                <div class="section-label">{{ trans('back.report_details') }}</div>

                <div class="form-field">
                    <label class="field-label">{{ trans('back.severity') }} <span class="required-star">*</span></label>
                    <div class="severity-tags">
                        @foreach ($severityLevels as $level)
                            <div class="severity-tag">
                                <input type="radio" name="severity_level_id" value="{{ $level->id }}"
                                    id="severity_{{ $level->id }}"
                                    {{ old('severity_level_id') == $level->id ? 'checked' : '' }} required>
                                <label for="severity_{{ $level->id }}">
                                    @if (app()->getLocale() == 'ar')
                                        {{ $level->name_ar }}
                                    @else
                                        {{ $level->name_en }}
                                    @endif
                                </label>
                            </div>
                        @endforeach
                    </div>
                    @error('severity_level_id')
                        <small style="color:#dc2626">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-field">
                    <label class="field-label">{{ trans('back.short_description') }} <span
                            class="required-star">*</span></label>
                    <textarea class="form-textarea" name="short_description"
                        placeholder="{{ app()->getLocale() == 'ar' ? 'مثال: تسرب بالقرب من لوحة الكهرباء.' : 'e.g., Leakage near electrical panel.' }}"
                        required>{{ old('short_description') }}</textarea>
                    @error('short_description')
                        <small style="color:#dc2626">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <!-- Voice Recording Section -->
            <div class="form-section">
                <div class="section-label">{{ trans('back.voice_message') }}</div>

                <div class="voice-recorder">
                    <button type="button" class="record-btn" id="recordBtn" onclick="toggleRecording()">
                        <i class="fas fa-microphone" id="recordIcon"></i>
                    </button>
                    <div class="record-status" id="recordStatus">{{ trans('back.tap_to_record') }}</div>
                    <div class="record-timer" id="recordTimer" style="display:none">00:00</div>
                    <audio id="audioPreview" class="audio-preview" controls style="display:none"></audio>
                </div>
                <input type="hidden" name="voice_recording" id="voiceRecording">
            </div>

            <input type="hidden" name="report_date" value="{{ now()->format('Y-m-d H:i:s') }}">

            <!-- Action Buttons -->
            <div class="form-actions mb-3">
                <a href="{{ route('employee.index') }}" class="btn-secondary"
                    style="text-align:center;display:flex;align-items:center;justify-content:center;text-decoration:none">
                    {{ trans('back.cancel') }}
                </a>
                <button type="submit" class="btn-primary">
                    {{ trans('back.submit') }}
                </button>
            </div>
        </form>
    </div>

    <!-- Camera Modal -->
    <div class="camera-modal" id="cameraModal">
        <video id="cameraVideo" class="camera-video" autoplay playsinline></video>
        <div class="camera-controls">
            <button type="button" class="camera-btn capture-btn" onclick="captureImage()">
                <i class="fas fa-camera"></i> {{ trans('back.capture') }}
            </button>
            <button type="button" class="camera-btn close-camera-btn" onclick="closeCamera()">
                <i class="fas fa-times"></i> {{ trans('back.close') }}
            </button>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        // Global variables
        let map, marker;
        let mediaStream = null;
        let mediaRecorder = null;
        let audioChunks = [];
        let recordingTimer = null;
        let recordingSeconds = 0;
        let capturedImages = [];

        // Initialize map
        document.addEventListener('DOMContentLoaded', function() {
            // Default to Oman coordinates
            map = L.map('map').setView([23.5880, 58.3829], 10);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap'
            }).addTo(map);

            // Try to get current location automatically
            getCurrentLocation();
        });

        // Get current location
        function getCurrentLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        const lat = position.coords.latitude;
                        const lng = position.coords.longitude;
                        setMapLocation(lat, lng);
                    },
                    function(error) {
                        console.log('Location error:', error.message);
                    }, {
                        enableHighAccuracy: true
                    }
                );
            }
        }

        // Enable map selection mode
        function enableMapSelection() {
            map.on('click', function(e) {
                setMapLocation(e.latlng.lat, e.latlng.lng);
            });
            alert('{{ trans('back.click_map_to_select') }}');
        }

        // Set map location
        function setMapLocation(lat, lng) {
            if (marker) {
                map.removeLayer(marker);
            }

            marker = L.marker([lat, lng]).addTo(map);
            map.setView([lat, lng], 15);

            document.getElementById('latitude').value = lat.toFixed(6);
            document.getElementById('longitude').value = lng.toFixed(6);

            const coordsDisplay = document.getElementById('coordsDisplay');
            coordsDisplay.textContent = `📍 ${lat.toFixed(6)}, ${lng.toFixed(6)}`;
            coordsDisplay.style.display = 'block';
        }

        // Camera functions
        function openCamera() {
            const modal = document.getElementById('cameraModal');
            const video = document.getElementById('cameraVideo');

            navigator.mediaDevices.getUserMedia({
                    video: {
                        facingMode: 'environment'
                    },
                    audio: false
                })
                .then(function(stream) {
                    mediaStream = stream;
                    video.srcObject = stream;
                    modal.classList.add('active');
                })
                .catch(function(error) {
                    alert('{{ trans('back.camera_error') }}: ' + error.message);
                });
        }

        function closeCamera() {
            const modal = document.getElementById('cameraModal');
            const video = document.getElementById('cameraVideo');

            if (mediaStream) {
                mediaStream.getTracks().forEach(track => track.stop());
                mediaStream = null;
            }
            video.srcObject = null;
            modal.classList.remove('active');
        }

        function captureImage() {
            const video = document.getElementById('cameraVideo');
            const canvas = document.createElement('canvas');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            canvas.getContext('2d').drawImage(video, 0, 0);

            const imageData = canvas.toDataURL('image/jpeg', 0.8);
            capturedImages.push(imageData);

            updateImagePreview();
            closeCamera();
        }

        // Handle image upload
        function handleImageUpload(event) {
            const files = event.target.files;

            for (let i = 0; i < files.length; i++) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Show preview but don't add to capturedImages (file will be sent normally)
                };
                reader.readAsDataURL(files[i]);
            }

            updateUploadPreview(files);
        }

        function updateImagePreview() {
            const preview = document.getElementById('imagePreview');
            const container = document.getElementById('capturedImagesContainer');

            // Clear existing captured previews
            const existingPreviews = preview.querySelectorAll('.captured-preview');
            existingPreviews.forEach(el => el.remove());

            // Clear hidden inputs
            container.innerHTML = '';

            capturedImages.forEach((img, index) => {
                // Add preview
                const div = document.createElement('div');
                div.className = 'preview-item captured-preview';
                div.innerHTML = `
                <img src="${img}" alt="">
                <button type="button" class="remove-btn" onclick="removeCapturedImage(${index})">×</button>
            `;
                preview.appendChild(div);

                // Add hidden input
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'captured_images[]';
                input.value = img;
                container.appendChild(input);
            });
        }

        function updateUploadPreview(files) {
            const preview = document.getElementById('imagePreview');

            // Clear existing upload previews
            const existingUploads = preview.querySelectorAll('.upload-preview');
            existingUploads.forEach(el => el.remove());

            for (let i = 0; i < files.length; i++) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'preview-item upload-preview';
                    div.innerHTML = `<img src="${e.target.result}" alt="">`;
                    preview.appendChild(div);
                };
                reader.readAsDataURL(files[i]);
            }
        }

        function removeCapturedImage(index) {
            capturedImages.splice(index, 1);
            updateImagePreview();
        }

        // Voice recording functions
        function toggleRecording() {
            if (mediaRecorder && mediaRecorder.state === 'recording') {
                stopRecording();
            } else {
                startRecording();
            }
        }

        function startRecording() {
            navigator.mediaDevices.getUserMedia({
                    audio: true
                })
                .then(function(stream) {
                    mediaRecorder = new MediaRecorder(stream);
                    audioChunks = [];

                    mediaRecorder.ondataavailable = function(e) {
                        audioChunks.push(e.data);
                    };

                    mediaRecorder.onstop = function() {
                        const audioBlob = new Blob(audioChunks, {
                            type: 'audio/webm'
                        });
                        const audioUrl = URL.createObjectURL(audioBlob);

                        const audioPreview = document.getElementById('audioPreview');
                        audioPreview.src = audioUrl;
                        audioPreview.style.display = 'block';

                        // Convert to base64
                        const reader = new FileReader();
                        reader.onloadend = function() {
                            document.getElementById('voiceRecording').value = reader.result;
                        };
                        reader.readAsDataURL(audioBlob);

                        stream.getTracks().forEach(track => track.stop());
                    };

                    mediaRecorder.start();

                    // Update UI
                    const btn = document.getElementById('recordBtn');
                    const icon = document.getElementById('recordIcon');
                    const status = document.getElementById('recordStatus');
                    const timer = document.getElementById('recordTimer');

                    btn.classList.add('recording');
                    icon.className = 'fas fa-stop';
                    status.textContent = '{{ trans('back.recording') }}';
                    timer.style.display = 'block';

                    // Start timer
                    recordingSeconds = 0;
                    recordingTimer = setInterval(function() {
                        recordingSeconds++;
                        const mins = Math.floor(recordingSeconds / 60).toString().padStart(2, '0');
                        const secs = (recordingSeconds % 60).toString().padStart(2, '0');
                        timer.textContent = `${mins}:${secs}`;
                    }, 1000);
                })
                .catch(function(error) {
                    alert('{{ trans('back.microphone_error') }}: ' + error.message);
                });
        }

        function stopRecording() {
            if (mediaRecorder && mediaRecorder.state === 'recording') {
                mediaRecorder.stop();

                // Update UI
                const btn = document.getElementById('recordBtn');
                const icon = document.getElementById('recordIcon');
                const status = document.getElementById('recordStatus');

                btn.classList.remove('recording');
                icon.className = 'fas fa-microphone';
                status.textContent = '{{ trans('back.recording_saved') }}';

                // Stop timer
                clearInterval(recordingTimer);
            }
        }
    </script>
@endsection
