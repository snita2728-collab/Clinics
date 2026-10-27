        @extends('layouts.app')

@section('content')
<div class="ar-dashboard">
    <style>
        .ar-dashboard {
            --ar-blue: #1769aa;
            --ar-blue-dark: #14558b;
            --ar-blue-light: #eaf5ff;
            --ar-border: #cfe5ff;
            --ar-text: #0759a6;
            color: var(--ar-text);
            padding: 8px 12px 28px;
            font-family: Arial, sans-serif;
        }
        .ar-dashboard * { box-sizing: border-box; }
        .ar-dashboard .ar-breadcrumb {
            display:flex; align-items:center; gap:14px; padding:12px 16px;
            border:1px solid var(--ar-border); border-radius:11px;
            background:rgba(255,255,255,.75); margin:0 0 20px;
            color:#2874bb;
        }
        .ar-dashboard .ar-breadcrumb .glyphicon { font-size:21px; }
        .ar-dashboard .ar-page-title { font-size:28px; font-weight:700; margin:0 0 18px; color:var(--ar-blue); }
        .ar-dashboard .ar-stats {
            display:grid; grid-template-columns:repeat(4,minmax(0,1fr)); gap:16px; margin-bottom:17px;
        }
        .ar-dashboard .ar-stat {
            position:relative; overflow:hidden; min-height:155px; padding:17px 19px;
            border:1px solid var(--ar-border); border-radius:14px;
            background:linear-gradient(135deg,#fff,#f4faff);
        }
        .ar-dashboard .ar-stat:after {
            content:""; position:absolute; width:90px; height:90px; right:10px; top:18px;
            border-radius:50%; background:currentColor; opacity:.08;
        }
        .ar-dashboard .ar-stat-icon {
            display:flex; align-items:center; justify-content:center; width:50px; height:50px;
            border-radius:12px; color:#fff; font-size:24px; margin-bottom:10px;
            box-shadow:0 4px 12px rgba(30,110,190,.16);
        }
        .ar-dashboard .ar-stat-label { font-size:14px; font-weight:600; margin:0 0 4px; color:#0759a6; }
        .ar-dashboard .ar-stat-number { font-size:27px; font-weight:700; line-height:1.2; color:#0759a6; }
        .ar-dashboard .ar-stat-track { height:8px; width:75%; border-radius:8px; background:#d7e8f8; margin-top:10px; }
        .ar-dashboard .ar-stat.blue { color:#238af0; border-color:#b9dcff; }
        .ar-dashboard .ar-stat.orange { color:#f5ad35; border-color:#f6d9a8; background:linear-gradient(135deg,#fff,#fffaf2); }
        .ar-dashboard .ar-stat.green { color:#19b88c; border-color:#a9e8d9; background:linear-gradient(135deg,#fff,#f3fffb); }
        .ar-dashboard .ar-stat.red { color:#fa596c; border-color:#ffd0d7; background:linear-gradient(135deg,#fff,#fff7f8); }
        .ar-dashboard .blue .ar-stat-icon { background:#2b91f5; }
        .ar-dashboard .orange .ar-stat-icon { background:#ffb43f; }
        .ar-dashboard .green .ar-stat-icon { background:#19bd91; }
        .ar-dashboard .red .ar-stat-icon { background:#ff5368; }
        .ar-dashboard .ar-panels { display:grid; grid-template-columns:1.35fr 1fr; gap:17px; margin-bottom:17px; }
        .ar-dashboard .ar-panel {
            min-width:0; background:#fff; border:1px solid var(--ar-border); border-radius:13px;
            padding:18px; margin-bottom:17px; box-shadow:0 4px 14px rgba(29,108,174,.045);
        }
        .ar-dashboard .ar-panels .ar-panel { margin-bottom:0; }
        .ar-dashboard .ar-panel-title {
            display:flex; align-items:center; gap:12px; font-size:16px; font-weight:700;
            margin:0 0 18px; color:#0759a6;
        }
        .ar-dashboard .ar-panel-title .glyphicon { font-size:22px; }
        .ar-dashboard .ar-chart-wrap { height:220px; position:relative; }
        .ar-dashboard .ar-doughnut-layout { display:grid; grid-template-columns: minmax(130px, .9fr) 1.1fr; align-items:center; gap:18px; }
        .ar-dashboard .ar-doughnut-wrap { height:175px; position:relative; }
        .ar-dashboard .ar-legend { list-style:none; margin:0; padding:0; }
        .ar-dashboard .ar-legend li { display:flex; align-items:center; gap:10px; margin:12px 0; font-size:12px; }
        .ar-dashboard .ar-dot { display:inline-block; width:11px; height:11px; border-radius:50%; flex:0 0 11px; }
        .ar-dashboard .ar-legend strong { margin-left:auto; white-space:nowrap; font-weight:500; }
        .ar-dashboard .ar-panel-head { display:flex; align-items:center; justify-content:space-between; gap:15px; flex-wrap:wrap; }
        .ar-dashboard .ar-actions { display:flex; gap:10px; flex-wrap:wrap; }
        .ar-dashboard .ar-search { width:220px; max-width:100%; border:1px solid var(--ar-border); border-radius:9px; padding:10px 12px; outline:none; }
        .ar-dashboard .ar-search:focus { border-color:#5ba8f4; box-shadow:0 0 0 3px rgba(43,145,245,.10); }
        .ar-dashboard .ar-add-btn { display:inline-flex; align-items:center; gap:8px; border:0; border-radius:9px; padding:10px 15px; background:#258cf3; color:#fff!important; text-decoration:none!important; }
        .ar-dashboard .ar-add-btn:hover { background:#1477d9; }
        .ar-dashboard .table-responsive { border:1px solid var(--ar-border); border-radius:9px; margin-top:14px; }
        .ar-dashboard table.ar-table { margin:0; min-width:700px; background:#fff; }
        .ar-dashboard .ar-table thead th { background:#edf6ff; color:#0759a6; font-weight:600; font-size:12px; border-bottom:1px solid var(--ar-border); padding:13px 12px; }
        .ar-dashboard .ar-table tbody td { padding:12px; vertical-align:middle; border-color:#edf4fb; }
        .ar-dashboard .ar-table tbody tr:hover { background:#f8fbff; }
        .ar-dashboard .ar-empty { text-align:center; padding:26px!important; color:#6898c8; }
        .ar-dashboard .ar-empty .glyphicon { display:block; font-size:25px; margin-bottom:8px; }
        .ar-dashboard .ar-total-row th { background:#f7fbff; padding:12px; }
        .ar-dashboard .ar-status { display:inline-block; border-radius:20px; padding:5px 9px; font-size:12px; white-space:nowrap; }
        .ar-dashboard .ar-status.done { color:#13845e; background:#e0f8ee; }
        .ar-dashboard .ar-status.pending { color:#9a6400; background:#fff2d5; }
        .ar-dashboard .ar-footer-note { color:#4b83b8; font-size:13px; padding-top:12px; }
        .ar-dashboard .alert { border-radius:10px; }
        @media(max-width:1200px) {
            .ar-dashboard .ar-stats { grid-template-columns:repeat(2,minmax(0,1fr)); }
            .ar-dashboard .ar-panels { grid-template-columns:1fr; }
        }
        @media(max-width:650px) {
            .ar-dashboard { padding:4px 0 20px; }
            .ar-dashboard .ar-stats { grid-template-columns:repeat(2,minmax(0,1fr)); gap:9px; }
            .ar-dashboard .ar-stat { padding:13px; min-height:145px; }
            .ar-dashboard .ar-stat-label { font-size:12px; }
            .ar-dashboard .ar-stat-number { font-size:23px; }
            .ar-dashboard .ar-panel { padding:13px; }
            .ar-dashboard .ar-panel-head { align-items:flex-start; }
            .ar-dashboard .ar-actions { width:100%; }
            .ar-dashboard .ar-search { width:100%; }
            .ar-dashboard .ar-add-btn { justify-content:center; }
            .ar-dashboard .ar-doughnut-layout { grid-template-columns:1fr; }
            .ar-dashboard .ar-doughnut-wrap { height:165px; }
        }
    </style>

    <div class="ar-breadcrumb">
        <span class="glyphicon glyphicon-home"></span>
        <span>/</span>
        <span>{{ App::getLocale() === 'km' ? 'ផ្ទាំងព័ត៌មាន' : 'Dashboard' }}</span>
    </div>

    <h2 class="ar-page-title">{{ App::getLocale() === 'km' ? 'ផ្ទាំងព័ត៌មាន' : 'Dashboard' }}</h2>

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif

    <div class="ar-stats">
        <div class="ar-stat blue">
            <div class="ar-stat-icon"><span class="glyphicon glyphicon-user"></span></div>
            <p class="ar-stat-label">{{ App::getLocale() === 'km' ? 'អ្នកជំងឺសរុប' : 'Total Patients' }}</p>
            <div class="ar-stat-number">{{ $patients->count() }}</div>
            <div class="ar-stat-track"></div>
        </div>
        <div class="ar-stat orange">
            <div class="ar-stat-icon"><span class="glyphicon glyphicon-calendar"></span></div>
            <p class="ar-stat-label">{{ App::getLocale() === 'km' ? 'ជំនួបដែលកំពុងរង់ចាំ' : 'Pending Appointments' }}</p>
            <div class="ar-stat-number">{{ $pending['appointment'] }}</div>
            <div class="ar-stat-track"></div>
        </div> 
    {{--    <div class="ar-stat green">
            <div class="ar-stat-icon"><span class="glyphicon glyphicon-check"></span></div>
            <p class="ar-stat-label">{{ App::getLocale() === 'km' ? 'ការធ្វើតេស្តសរុប' : 'Total Tests' }}</p>
            <div class="ar-stat-number">{{ $total_test }}</div>
            <div class="ar-stat-track"></div>
        </div> --}}
        
        <div class="ar-stat red">
            <div class="ar-stat-icon"><span class="glyphicon glyphicon-briefcase"></span></div>
            <p class="ar-stat-label">{{ App::getLocale() === 'km' ? 'វេជ្ជបណ្ឌិតសរុប' : 'Total Doctors' }}</p>
            <div class="ar-stat-number">{{ $total_doctor }}</div>
            <div class="ar-stat-track"></div>
        </div>
    </div>

    <div class="ar-panels">
        <section class="ar-panel">
            <h3 class="ar-panel-title"><span class="glyphicon glyphicon-calendar"></span>{{ App::getLocale() === 'km' ? 'ទិដ្ឋភាពទូទៅនៃជំនួប' : 'Appointments Overview' }}</h3>
            <div class="ar-chart-wrap"><canvas id="arAppointmentChart" aria-label="Appointments overview chart"></canvas></div>
        </section>
        <section class="ar-panel">
            <h3 class="ar-panel-title"><span class="glyphicon glyphicon-stats"></span>{{ App::getLocale() === 'km' ? 'ស្ថានភាពអ្នកជំងឺតាមផ្នែក' : 'Patient Overview' }}</h3>
            <div class="ar-doughnut-layout">
                <div class="ar-doughnut-wrap"><canvas id="arDepartmentChart" aria-label="Patient overview chart"></canvas></div>
                <ul class="ar-legend">
                    <li><span class="ar-dot" style="background:#3296f5"></span>General Dentistry <strong>{{ $patients->count() }}</strong></li>
                    <li><span class="ar-dot" style="background:#9b7cf6"></span>Orthodontics <strong>—</strong></li>
                    <li><span class="ar-dot" style="background:#20bf91"></span>Oral Surgery <strong>—</strong></li>
                    <li><span class="ar-dot" style="background:#ffbd45"></span>Periodontics <strong>—</strong></li>
                    <li><span class="ar-dot" style="background:#ff7186"></span>Pediatric Dentistry <strong>—</strong></li>
                </ul>
            </div>
            <p class="text-muted" style="font-size:11px;margin:8px 0 0;">{{ App::getLocale() === 'km' ? 'ចំនួនសរុបអ្នកជំងឺបង្ហាញពីទិន្នន័យដែលមានស្រាប់។' : 'Department breakdown requires department-specific data.' }}</p>
        </section>
    </div>

    <section class="ar-panel">
        <div class="ar-panel-head">
            <h3 class="ar-panel-title" style="margin-bottom:0;"><span class="glyphicon glyphicon-list-alt"></span>{{ App::getLocale() === 'km' ? 'អ្នកជំងឺថ្ងៃនេះ' : 'Today Patients' }}</h3>
            <input type="search" class="ar-search" id="arOpdSearch" placeholder="{{ App::getLocale() === 'km' ? 'ស្វែងរក...' : 'Search ...' }}">
        </div>
        <div class="table-responsive">
            <table id="arOpdTable" class="table ar-table">
                <thead><tr>
                    <th>{{ App::getLocale() === 'km' ? 'ល.រ.' : 'No.' }}</th>
                    <th>{{ App::getLocale() === 'km' ? 'ឈ្មោះអ្នកជំងឺ' : 'Patient Name' }}</th>
                    <th>{{ App::getLocale() === 'km' ? 'ឈ្មោះវេជ្ជបណ្ឌិត' : 'Doctor Name' }}</th>
                    <th>{{ App::getLocale() === 'km' ? 'ចុះឈ្មោះនៅ' : 'Register At' }}</th>
                    <th>{{ App::getLocale() === 'km' ? 'ស្ថានភាព' : 'Status' }}</th>
                </tr></thead>
                <tbody>
                @forelse($opds as $opd)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $opd->invoice->patient->first_name }} {{ $opd->invoice->patient->last_name }}</td>
                        <td>{{ $opd->doctor->employee->first_name }} {{ $opd->doctor->employee->middle_name }} {{ $opd->doctor->employee->last_name }}</td>
                        <td>{{ $opd->created_at }}</td>
                        <td>
                            @if($opd->status == 1)
                                <span class="ar-status done">{{ App::getLocale() === 'km' ? 'រួចរាល់' : 'Complete' }}</span>
                            @else
                                <a class="ar-status pending" href="{{ route('doctor.edit', $opd->id) }}">{{ App::getLocale() === 'km' ? 'កំពុងរង់ចាំ' : 'Pending' }}</a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="ar-empty"><span class="glyphicon glyphicon-file"></span>{{ App::getLocale() === 'km' ? 'មិនមានទិន្នន័យ' : 'No data available in table' }}</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>

{{-- Chart.js is loaded only for this Dashboard view. --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
(function () {
    function initDashboard() {
        var appointmentCanvas = document.getElementById('arAppointmentChart');
        if (appointmentCanvas && window.Chart) {
            new Chart(appointmentCanvas, {
                type: 'line',
                data: {
                    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                    datasets: [
                        { label: 'Completed', data: [0,0,0,0,0,0,0], borderColor: '#2995ff', backgroundColor: 'rgba(41,149,255,.08)', tension: .3, fill: true },
                        { label: 'Pending', data: [0,0,0,0,0,0,0], borderColor: '#ffbd45', backgroundColor: 'rgba(255,189,69,.05)', tension: .3, fill: false },
                        { label: 'Cancelled', data: [0,0,0,0,0,0,0], borderColor: '#ff7186', tension: .3, fill: false }
                    ]
                },
                options: {
                    responsive: true, maintainAspectRatio: false,
                    plugins: { legend: { position: 'top', labels: { usePointStyle: true, boxWidth: 8 } } },
                    scales: { y: { beginAtZero: true, ticks: { stepSize: 5 }, grid: { color: '#eaf3fc' } }, x: { grid: { color: '#edf5fc' } } }
                }
            });
        }

        var departmentCanvas = document.getElementById('arDepartmentChart');
        if (departmentCanvas && window.Chart) {
            new Chart(departmentCanvas, {
                type: 'doughnut',
                data: {
                    labels: ['General Dentistry', 'Orthodontics', 'Oral Surgery', 'Periodontics', 'Pediatric Dentistry'],
                    datasets: [{ data: [1,0,0,0,0], backgroundColor: ['#3296f5','#9b7cf6','#20bf91','#ffbd45','#ff7186'], borderWidth: 2, borderColor: '#fff' }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false, cutout: '66%',
                    plugins: { legend: { display: false }, tooltip: { enabled: false } }
                },
                plugins: [{
                    id: 'centerLabel',
                    afterDraw: function(chart) {
                        var ctx = chart.ctx, area = chart.chartArea;
                        if (!area) return;
                        ctx.save();
                        ctx.font = '12px Arial';
                        ctx.fillStyle = '#4b83b8';
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'middle';
                        ctx.fillText('Overview', (area.left + area.right) / 2, (area.top + area.bottom) / 2);
                        ctx.restore();
                    }
                }]
            });
        }

        [
            ['arInvoiceSearch', 'arInvoiceTable'],
            ['arAppointmentSearch', 'arAppointmentTable'],
            ['arOpdSearch', 'arOpdTable']
        ].forEach(function (pair) {
            var input = document.getElementById(pair[0]);
            var table = document.getElementById(pair[1]);
            if (!input || !table) return;
            input.addEventListener('input', function () {
                var query = input.value.toLowerCase();
                Array.prototype.forEach.call(table.querySelectorAll('tbody tr'), function (row) {
                    row.style.display = row.textContent.toLowerCase().indexOf(query) !== -1 ? '' : 'none';
                });
            });
        });

        // Keep existing DataTables behavior if the app already loads its plugin.
        if (window.jQuery && jQuery.fn && jQuery.fn.DataTable) {
            ['arInvoiceTable', 'arAppointmentTable', 'arOpdTable'].forEach(function (id) {
                if (!jQuery.fn.DataTable.isDataTable('#' + id)) {
                    jQuery('#' + id).DataTable({ pageLength: 5, ordering: true, searching: false });
                }
            });
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initDashboard);
    } else {
        initDashboard();
    }
})();
</script>
@endsection
