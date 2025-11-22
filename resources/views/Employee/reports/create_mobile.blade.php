<!doctype html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>{{ trans('back.add_report') }} | CAA</title>
    <style>
        :root {
            --bg: #fff;
            --fg: #0f172a;
            --muted: #64748b;
            --line: #e5e7eb;
            --brand: #008060;
            --accent: #cc0000;
        }
        * { box-sizing: border-box; }
        html, body {
            margin: 0;
            background: #f1f5f9;
            -webkit-font-smoothing: antialiased;
            text-rendering: optimizeLegibility;
        }
        :root {
            --arabic-font: "Cairo", "Tajawal", "Noto Naskh Arabic", "Noto Kufi Arabic", "Geeza Pro", "Amiri", "Arial", "Roboto", "Segoe UI", sans-serif;
        }
        body, * {
            font-family: var(--arabic-font);
            line-height: 1.45;
        }
        .phone {
            max-width: 420px;
            margin: 0 auto;
            background: #0009;
            padding: 12px;
            border-radius: 38px;
            box-shadow: 0 20px 50px rgba(0,0,0,.35);
        }
        .notch {
            position: relative;
            height: 14px;
        }
        .notch:after {
            content: '';
            position: absolute;
            left: 50%;
            top: -7px;
            transform: translateX(-50%);
            width: 120px;
            height: 22px;
            background: #000;
            border-radius: 20px;
        }
        .screen {
            height: 84vh;
            min-height: 640px;
            border-radius: 30px;
            overflow: hidden;
            background: var(--bg);
        }
        .bar {
            height: 18px;
            background: #fff;
        }
        .top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px;
            border-bottom: 1px solid var(--line);
            background: #fff;
        }
        .logo {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .logo img {
            width: 34px;
            height: 34px;
            border-radius: 999px;
            border: 1px solid #ddd;
            background: #fff;
            object-fit: contain;
        }
        .title {
            font-weight: 600;
        }
        .link {
            font-size: 14px;
            text-decoration: underline;
            color: #0a56a3;
            background: none;
            border: none;
            cursor: pointer;
        }
        .content {
            padding: 14px;
            overflow-y: auto;
            max-height: calc(84vh - 100px);
        }
        .btn {
            display: inline-block;
            padding: 12px 14px;
            border: 1px solid var(--line);
            background: #fff;
            border-radius: 14px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
        }
        .btn.brand {
            background: var(--brand);
            color: #fff;
            border: none;
        }
        .muted {
            color: var(--muted);
            font-size: 14px;
        }
        .field {
            display: flex;
            flex-direction: column;
            gap: 6px;
            margin-bottom: 10px;
        }
        .input, .select, textarea {
            border: 1px solid var(--line);
            border-radius: 12px;
            padding: 10px;
            font-size: 15px;
            width: 100%;
        }
        .map {
            height: 140px;
            border: 1px dashed #94a3b8;
            border-radius: 12px;
            background: linear-gradient(90deg,#eef2ff 50%, transparent 0), linear-gradient(#eef2ff 50%, transparent 0);
            background-size: 20px 20px;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #475569;
            cursor: pointer;
        }
        .row {
            display: flex;
            gap: 8px;
            align-items: center;
            justify-content: space-between;
        }
        .tags {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }
        .tag {
            padding: 8px 12px;
            border: 1px solid var(--line);
            border-radius: 999px;
            font-size: 13px;
            background: #f8fafc;
            cursor: pointer;
            transition: all 0.2s;
        }
        .tag.active {
            background: var(--brand);
            color: #fff;
            border-color: var(--brand);
        }
        .preview-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 8px;
            margin-top: 10px;
        }
        .preview-item {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            height: 80px;
            border: 1px solid var(--line);
        }
        .preview-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="phone">
        <div class="notch"></div>
        <div class="screen">
            <div class="bar"></div>

            <div class="top">
                <div class="logo">
                    <img src="{{ asset(App\Models\Setting::first()->logo) }}" alt="CAA">
                    <div class="title">{{ trans('back.add_report') }}</div>
                </div>
                <div class="row" style="gap:10px">
                    <a href="{{ route('employee.index') }}" class="link">{{ trans('back.back') }}</a>
                </div>
            </div>

            <div class="content">
                <form action="{{ route('employee.reports.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="muted" style="margin-bottom:8px">{{ trans('back.report_form') }}</div>

                    {{-- GPS Location --}}
                    <div class="field">
                        <label>{{ trans('back.gps') }}</label>
                        <div class="map" id="mapPreview" onclick="getCurrentLocation()">
                            🗺️ <span id="mapText">{{ trans('back.map_preview') }}</span>
                        </div>
                        <input type="hidden" name="latitude" id="latitude">
                        <input type="hidden" name="longitude" id="longitude">
                    </div>

                    {{-- Section --}}
                    <div class="field">
                        <label>{{ trans('back.section') }} <span style="color:var(--accent)">*</span></label>
                        <select class="select" name="section_id" required>
                            <option value="">{{ trans('back.select_section') }}</option>
                            @foreach($sections as $section)
                                <option value="{{ $section->id }}">
                                    @if (app()->getLocale() == 'ar')
                                        {{ $section->name_ar }}
                                    @else
                                        {{ $section->name_en }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Location --}}
                    <div class="field">
                        <label>{{ trans('back.location') }} <span style="color:var(--accent)">*</span></label>
                        <select class="select" name="location_id" required>
                            <option value="">{{ trans('back.select_location') }}</option>
                            @foreach($locations as $location)
                                <option value="{{ $location->id }}">
                                    @if (app()->getLocale() == 'ar')
                                        {{ $location->name_ar }}
                                    @else
                                        {{ $location->name_en }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Severity Level --}}
                    <div class="field">
                        <label>{{ trans('back.severity') }} <span style="color:var(--accent)">*</span></label>
                        <div class="tags">
                            @foreach($severityLevels as $level)
                                <label class="tag" onclick="selectSeverity({{ $level->id }})">
                                    <input type="radio" name="severity_level_id" value="{{ $level->id }}" style="display:none" required>
                                    <span>
                                        @if (app()->getLocale() == 'ar')
                                            {{ $level->name_ar }}
                                        @else
                                            {{ $level->name_en }}
                                        @endif
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="field">
                        <label>{{ trans('back.short_description') }} <span style="color:var(--accent)">*</span></label>
                        <textarea rows="3" name="short_description" placeholder="{{ app()->getLocale() == 'ar' ? 'مثال: تسرب بالقرب من لوحة الكهرباء.' : 'e.g., Leakage near electrical panel.' }}" required>{{ old('short_description') }}</textarea>
                    </div>

                    {{-- Attachments --}}
                    <div class="field">
                        <label>{{ trans('back.attach') }}</label>
                        <div class="row">
                            <label for="attachments" class="btn" style="cursor:pointer;flex:1;text-align:center">
                                {{ trans('back.pick_image') }}
                            </label>
                        </div>
                        <input type="file" id="attachments" name="attachments[]" multiple accept="image/*,audio/*" style="display:none" onchange="previewFiles()">
                        <div id="preview" class="preview-grid"></div>
                    </div>

                    <input type="hidden" name="report_date" value="{{ now()->format('Y-m-d H:i:s') }}">

                    {{-- Submit --}}
                    <div class="row" style="margin-top:10px">
                        <a href="{{ route('employee.index') }}" class="btn">{{ trans('back.back') }}</a>
                        <button type="submit" class="btn brand">{{ trans('back.submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Get current location
        function getCurrentLocation() {
            if (navigator.geolocation) {
                document.getElementById('mapText').textContent = '{{ app()->getLocale() == 'ar' ? 'جاري التحديد...' : 'Locating...' }}';
                navigator.geolocation.getCurrentPosition(function(position) {
                    document.getElementById('latitude').value = position.coords.latitude.toFixed(6);
                    document.getElementById('longitude').value = position.coords.longitude.toFixed(6);
                    document.getElementById('mapText').textContent = `📍 ${position.coords.latitude.toFixed(6)}, ${position.coords.longitude.toFixed(6)}`;
                }, function(error) {
                    alert('{{ trans("back.location_error") }}: ' + error.message);
                    document.getElementById('mapText').textContent = '{{ trans("back.map_preview") }}';
                });
            } else {
                alert('{{ trans("back.location_not_supported") }}');
            }
        }

        // Select severity
        function selectSeverity(id) {
            document.querySelectorAll('.tag').forEach(t => t.classList.remove('active'));
            event.currentTarget.classList.add('active');
        }

        // Preview files
        function previewFiles() {
            const preview = document.getElementById('preview');
            preview.innerHTML = '';
            const files = document.getElementById('attachments').files;

            for (let i = 0; i < Math.min(files.length, 6); i++) {
                const file = files[i];
                const reader = new FileReader();

                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'preview-item';

                    if (file.type.startsWith('image/')) {
                        div.innerHTML = `<img src="${e.target.result}" alt="">`;
                    } else if (file.type.startsWith('audio/')) {
                        div.innerHTML = '<div style="display:flex;align-items:center;justify-content:center;height:100%;background:#f8fafc">🎵</div>';
                    }

                    preview.appendChild(div);
                };

                reader.readAsDataURL(file);
            }
        }
    </script>
</body>
</html>
