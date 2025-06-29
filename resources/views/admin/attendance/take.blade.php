@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Take Attendance (QR Scan)</h2>
        <a href="{{ route('admin.attendance.qr-codes', $schedule->id) }}" class="btn btn-info">
            <i class="fas fa-qrcode me-1"></i> View Student QR Codes
        </a>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="mb-4 row g-3" id="stats-area">
                <div class="col-md-3">
                    <div class="card text-center shadow-sm border-success">
                        <div class="card-body p-2">
                            <div class="fw-bold">Total Students</div>
                            <div class="display-6" id="stat-total">{{ $studentCount }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center shadow-sm border-primary">
                        <div class="card-body p-2">
                            <div class="fw-bold">Present Today</div>
                            <div class="display-6 text-success" id="stat-present">{{ $attendanceCount }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center shadow-sm border-danger">
                        <div class="card-body p-2">
                            <div class="fw-bold">Absent</div>
                            <div class="display-6 text-danger" id="stat-absent">{{ $absentCount }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center shadow-sm border-info">
                        <div class="card-body p-2">
                            <div class="fw-bold">% Present</div>
                            <div class="display-6 text-info" id="stat-percent">{{ $studentCount ? round(100 * ($attendanceCount / max($studentCount,1)), 1) : 0 }}%</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Schedule Info -->
            <div class="alert alert-info mb-3">
                <strong>Schedule Info:</strong> {{ $schedule->course->title }} - {{ $schedule->day_of_week }} {{ $schedule->start_time }}-{{ $schedule->end_time }}
                <br><small>Schedule ID: {{ $schedule->id }}, Course ID: {{ $schedule->course_id }}</small>
            </div>
            
            <div class="mb-3">
                <button class="btn btn-success mb-3" id="start-camera"><i class="fas fa-qrcode me-1"></i> Start QR Scanner</button>
            </div>
            <div id="camera-area" style="display:none;">
                <div id="qr-reader" style="width:100%;max-width:400px;box-shadow:0 2px 16px #0d6efd33;border-radius:12px;border:2px solid #0d6efd;margin:auto;"></div>
                <div id="qr-result" class="mt-3"></div>
            </div>
        </div>
    </div>
    <audio id="beep-sound" src="https://cdn.pixabay.com/audio/2022/07/26/audio_124bfae5b6.mp3" preload="auto"></audio>
</div>
<script src="https://unpkg.com/html5-qrcode"></script>
<script>
const startBtn = document.getElementById('start-camera');
const cameraArea = document.getElementById('camera-area');
const qrResult = document.getElementById('qr-result');
const beepSound = document.getElementById('beep-sound');
let qrScanner = null;

// إحصائيات أولية من السيرفر
let stats = {
    total: parseInt(document.getElementById('stat-total').textContent),
    present: parseInt(document.getElementById('stat-present').textContent),
    absent: parseInt(document.getElementById('stat-absent').textContent)
};

function updateStats(presentDelta) {
    stats.present += presentDelta;
    stats.absent = Math.max(stats.total - stats.present, 0);
    let percent = stats.total ? Math.round(1000 * (stats.present / Math.max(stats.total,1))) / 10 : 0;
    document.getElementById('stat-present').textContent = stats.present;
    document.getElementById('stat-absent').textContent = stats.absent;
    document.getElementById('stat-percent').textContent = percent + '%';
}

startBtn.onclick = function() {
    cameraArea.style.display = 'block';
    if (!qrScanner) {
        qrScanner = new Html5Qrcode("qr-reader");
        qrScanner.start(
            { facingMode: "environment" },
            { fps: 10, qrbox: 250 },
            qrCodeMessage => {
                console.log('QR Code scanned:', qrCodeMessage);
                qrResult.innerHTML = '<div class="alert alert-info">Processing QR code...</div>';
                fetch("{{ route('admin.attendance.scan') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        qr: qrCodeMessage,
                        schedule_id: {{ $schedule->id }}
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        // تشغيل صوت زمور
                        beepSound.currentTime = 0;
                        beepSound.play();
                        // تحديث الإحصائيات مباشرة
                        updateStats(1);
                        // إظهار رسالة باسم الطالب وlogin_id
                        qrResult.innerHTML = `<div class='alert alert-success alert-dismissible fade show text-center' style='font-size:1.2em;'>
                            <strong>✓</strong> ${data.message}
                        </div>`;
                        setTimeout(() => {
                            qrResult.innerHTML = '';
                        }, 2000);
                    } else {
                        qrResult.innerHTML = `<div class='alert alert-danger alert-dismissible fade show text-center' style='font-size:1.1em;'>
                            <strong>✗</strong> ${data.message}
                        </div>`;
                        setTimeout(() => {
                            qrResult.innerHTML = '';
                        }, 2000);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    qrResult.innerHTML = `<div class='alert alert-danger alert-dismissible fade show'>
                        <strong>Error:</strong> Failed to process QR code. Please try again.
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>`;
                });
            },
            errorMessage => {
                console.log('QR Scanner error:', errorMessage);
            }
        ).catch(err => {
            console.error('Failed to start QR scanner:', err);
            qrResult.innerHTML = `<div class='alert alert-danger'>
                <strong>Error:</strong> Failed to start camera. Please check permissions.
            </div>`;
        });
    }
}
</script>
@endsection 