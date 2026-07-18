@extends('layouts.app')
@section('content')
<div class="col-md-12 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li class="active">{{ App::getLocale() === 'km' ? 'ការបម្រុងទុកទិន្នន័យ' : 'Database Backup' }}</li>
        </ol>
    </div>
    
    <div class="row" style="margin-top: 20px;">
        <div class="col-lg-12">
            <h2 class="page-header">{{ App::getLocale() === 'km' ? 'ការបម្រុងទុកទិន្នន័យ' : 'Database Backup' }}</h2>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <p>{{ $errors->first() }}</p>
        </div>
    @endif

    <div class="row">
        <!-- Backup Generator Panel -->
        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading">{{ App::getLocale() === 'km' ? 'បង្កើតការបម្រុងទុក' : 'Create Backup' }}</div>
                <div class="panel-body text-center" style="padding: 40px 20px !important;">
                    <div style="margin-bottom: 24px;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 80px; height: 80px; color: #10b981; margin: 0 auto;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0v3.75" />
                        </svg>
                    </div>
                    
                    <h3 style="font-weight: 600; color: #111827; margin-bottom: 12px;">
                        {{ App::getLocale() === 'km' ? 'បម្រុងទុកមូលដ្ឋានទិន្នន័យគ្លីនិក' : 'Clinic Database Backup' }}
                    </h3>
                    
                    <p style="color: #6b7280; font-size: 1rem; line-height: 1.6; margin-bottom: 30px;">
                        @if(App::getLocale() === 'km')
                            ចុចប៊ូតុងខាងក្រោមដើម្បីបង្កើតការបម្រុងទុកមូលដ្ឋានទិន្នន័យគ្លីនិកបច្ចុប្បន្នរបស់អ្នក។ ឯកសារ SQL នឹងត្រូវបានរក្សាទុក ហើយអ្នកអាចទាញយកវាសម្រាប់រក្សាទុក។
                        @else
                            Click the button below to generate a new backup of your clinic's database. The SQL file will be generated and added to the table on the right.
                        @endif
                    </p>
                    
                    <a href="{{ route('hospital.backup', ['run' => 'true']) }}" class="btn btn-primary btn-lg" style="padding: 12px 30px !important; font-size: 1.15rem !important;">
                        <span class="glyphicon glyphicon-download-alt" style="margin-right: 8px;"></span>
                        {{ App::getLocale() === 'km' ? 'បង្កើតឯកសារបម្រុងទុក' : 'Generate Backup File' }}
                    </a>
                </div>
            </div>
        </div>

        <!-- History List Panel -->
        <div class="col-md-7">
            <div class="panel panel-default">
                <div class="panel-heading">{{ App::getLocale() === 'km' ? 'ឯកសារបម្រុងទុកដែលមានស្រាប់' : 'Available Backup Files' }}</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>{{ App::getLocale() === 'km' ? 'ឈ្មោះឯកសារ' : 'File Name' }}</th>
                                    <th>{{ App::getLocale() === 'km' ? 'ទំហំ' : 'Size' }}</th>
                                    <th>{{ App::getLocale() === 'km' ? 'កាលបរិច្ឆេទបង្កើត' : 'Created Date' }}</th>
                                    <th style="text-align: right;">{{ App::getLocale() === 'km' ? 'សកម្មភាព' : 'Actions' }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($backups) > 0)
                                    @foreach($backups as $backup)
                                        <tr>
                                            <td style="font-weight: 500; color: #374151;">{{ $backup['filename'] }}</td>
                                            <td>{{ $backup['size'] }}</td>
                                            <td>{{ $backup['date'] }}</td>
                                            <td style="text-align: right; white-space: nowrap;">
                                                <a href="{{ $backup['download_url'] }}" class="btn btn-xs btn-success" style="margin-right: 5px;" download>
                                                    <span class="glyphicon glyphicon-download"></span>
                                                    {{ App::getLocale() === 'km' ? 'ទាញយក' : 'Download' }}
                                                </a>
                                                <button class="btn btn-xs btn-warning" onclick="triggerRestore('{{ $backup['filename'] }}')">
                                                    <span class="glyphicon glyphicon-refresh"></span>
                                                    {{ App::getLocale() === 'km' ? 'ស្ដារឡើងវិញ' : 'Restore' }}
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4" class="text-center text-muted" style="padding: 40px 0;">
                                            {{ App::getLocale() === 'km' ? 'មិនទាន់មានឯកសារបម្រុងទុកនៅឡើយទេ' : 'No backups created yet.' }}
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Restore Confirmation Modal -->
<div class="modal fade" id="restoreConfirmModal" tabindex="-1" role="dialog" aria-labelledby="restoreConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" style="color: #d97706; font-weight: 600;">
                    <span class="lang-en">Confirm Database Restore</span>
                    <span class="lang-km" style="display: none;">បញ្ជាក់ការស្ដារទិន្នន័យឡើងវិញ</span>
                </h4>
            </div>
            <form action="{{ route('hospital.backup.restore') }}" method="POST" id="restoreForm">
                {{ csrf_field() }}
                <input type="hidden" name="filename" id="restore_filename">
                <div class="modal-body">
                    <p style="font-size: 1.05rem; line-height: 1.6; color: #374151; margin-bottom: 15px;">
                        <span class="lang-en">Are you sure you want to restore the database from the backup file <strong id="restore_filename_display"></strong>?</span>
                        <span class="lang-km" style="display: none;">តើអ្នកប្រាកដជាចង់ស្ដារទិន្នន័យពីឯកសារបម្រុងទុក <strong id="restore_filename_display_km"></strong> មែនទេ?</span>
                    </p>
                    <div class="alert alert-danger" style="margin-top: 15px; border-radius: 8px; font-size: 0.95rem;">
                        <strong>
                            <span class="lang-en">WARNING:</span>
                            <span class="lang-km" style="display: none;">ការព្រមាន៖</span>
                        </strong>
                        <span class="lang-en">All current database records will be replaced by the records in this backup file. This action cannot be undone.</span>
                        <span class="lang-km" style="display: none;">រាល់ទិន្នន័យបច្ចុប្បន្នទាំងអស់នឹងត្រូវជំនួសដោយទិន្នន័យក្នុងឯកសារបម្រុងទុកនេះ។ សកម្មភាពនេះមិនអាចត្រឡប់ថយក្រោយវិញបានទេ។</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        <span class="lang-en">Cancel</span>
                        <span class="lang-km" style="display: none;">បោះបង់</span>
                    </button>
                    <button type="submit" class="btn btn-warning">
                        <span class="glyphicon glyphicon-refresh"></span>
                        <span class="lang-en">Yes, Restore</span>
                        <span class="lang-km" style="display: none;">បាទ/ចាស ស្ដារឡើងវិញ</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function triggerRestore(filename) {
    $('#restore_filename').val(filename);
    $('#restore_filename_display').text(filename);
    $('#restore_filename_display_km').text(filename);
    
    // Toggle locale elements in modal matching active locale
    var currentLocale = "{{ App::getLocale() }}";
    if (currentLocale === 'km') {
        $('#restoreConfirmModal .lang-en').hide();
        $('#restoreConfirmModal .lang-km').show();
    } else {
        $('#restoreConfirmModal .lang-km').hide();
        $('#restoreConfirmModal .lang-en').show();
    }
    
    $('#restoreConfirmModal').modal('show');
}
</script>
@endsection
