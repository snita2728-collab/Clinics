<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>អរុណរះ គ្លីនិក</title>
    <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet" crossorigin="anonymous">
    <link href="{{ asset('css/datepicker3.css')}}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-table.css')}}" rel="stylesheet">
    <link href="{{ asset('css/styles.css')}}" rel="stylesheet">
    <link href="{{ asset('css/nepali.datepicker.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/datatable.css')}}" rel="stylesheet">
    <link href="{{ asset('css/buttons.dataTables.css')}}" rel="stylesheet">
    <link href="{{ asset('css/select2.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/timepicker.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/numpad.css')}}" rel="stylesheet">
    <link rel="icon" type="image/png" href="/logo_favicon.png">
    <link rel="shortcut icon" href="/logo_favicon.png" type="image/png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!--Icons-->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
        window.currentCurrency = "{{ session('currency', 'USD') }}";
        window.formatJSPrice = function(amount) {
            if (window.currentCurrency === 'KHR') {
                return Math.round(amount * 4100).toLocaleString() + ' ៛';
            }
            return '$' + parseFloat(amount).toFixed(2);
        };
    </script>
    <script src="{{asset('js/lumino.glyphs.js')}}"></script>
    <script src="{{asset('js/jquery-1.11.1.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('js/easypiechart.js')}}"></script>
    <script src="{{asset('js/easypiechart-data.js')}}"></script>
    <script src="{{asset('js/bootstrap-table.js')}}"></script>
    <script src="{{asset('js/nepali.datepicker.min.js')}}"></script>
    <script src="{{asset('js/datatable.js')}}"></script>
    <script src="{{asset('js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('js/buttonPrint.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script src="{{asset('js/timepicker.min.js')}}"></script>
    <script src="{{asset('js/numpad.js')}}"></script>
  
    <script src="//cdn.datatables.net/buttons/1.3.1/js/buttons.flash.min.js"></script>



    <script type="text/javascript">
    $(document).ready(function() {
        // Setup global translation for DataTables
        var dtLang = {};
        if ("{{ App::getLocale() }}" === "km") {
            dtLang = {
                "sProcessing":   "កំពុងដំណើរការ...",
                "sLengthMenu":   "បង្ហាញ _MENU_ បញ្ជី",
                "sZeroRecords":  "មិនមានទិន្នន័យទេ",
                "sInfo":         "បង្ហាញពីលេខ _START_ ដល់ _END_ នៃបញ្ជីសរុប _TOTAL_ ",
                "sInfoEmpty":    "បង្ហាញពីលេខ 0 ដល់ 0 នៃបញ្ជីសរុប 0 ",
                "sInfoFiltered": "(ស្វែងរកពីបញ្ជីសរុប _MAX_)",
                "sInfoPostFix":  "",
                "sSearch":       "ស្វែងរក:",
                "sUrl":          "",
                "oPaginate": {
                    "sFirst":    "ដំបូង",
                    "sPrevious": "មុន",
                    "sNext":     "បន្ទាប់",
                    "sLast":     "ចុងក្រោយ"
                }
            };
            if ($.fn.dataTable) {
                $.extend(true, $.fn.dataTable.defaults, {
                    language: dtLang
                });
            }
        }

        $('#example').DataTable();
        $('.example').DataTable();
        $('.datepicker').datepicker();
        $('.datepicker1').datepicker({

            format: "mm/dd/yyyy",
            todayHighlight:true,
            autoclose: true,
        });
        $('.datepicker').change(function(){
            $(".datepicker").datepicker('hide');
        });
        $('.datepicker1').change(function(){
            $(".datepicker1").datepicker('hide')
        });
} );
</script>
    <script>
    $(document).ready(function(){

        $('input.timepicker').timepicker({dropdown: true,
    scrollbar: true});
        
        $('#nepaliDateD').nepaliDatePicker({
            disableBefore: '12/08/2073',
            disableAfter: '12/20/2073'
        });
        $('#nepaliDateD1').nepaliDatePicker({
            disableDaysBefore: '10',
            disableDaysAfter: '10'
        });

       /* $('#nepaliDate5').nepaliDatePicker({
            npdMonth: true,
            npdYear: true,


        });  */
        $('#nepaliDate').nepaliDatePicker({
            onFocus: false,
            npdMonth: true,
            npdYear: true,
            ndpEnglishInput: 'englishDate',
            ndpTriggerButtonText: 'Date',
            ndpTriggerButtonClass: 'btn btn-primary btn-sm'
        });
        $('#nepaliDate1').nepaliDatePicker({
            onChange: function(){
                alert($('#nepaliDate1').val());
            }
        });
        $('#nepaliDate2').nepaliDatePicker();
        $('#nepaliDate3').nepaliDatePicker({
            onFocus: false,
            npdMonth: true,
            npdYear: true,
            ndpTriggerButton: true,
            ndpTriggerButtonText: 'Date',
            ndpTriggerButtonClass: 'btn btn-primary btn-sm'
        });

        $('#englishDate').change(function(){
            $('#nepaliDate').val(AD2BS($('#englishDate').val()));
        });

        $('#englishDate9').change(function(){
            $('#nepaliDate9').val(AD2BS($('#englishDate9').val()));
        });

        $('#nepaliDate9').change(function(){
            $('#englishDate9').val(BS2AD($('#nepaliDate9').val()));
        });
    });
</script>
    <script type="text/javascript">
         $(document).ready(function() {
  $(".select2").select2();

});
    </script>
    <script type="text/javascript">
$(document).ready(function() {
  $(".select").select2();
});
</script>


    @yield('script')
    <style type="text/css">
        @font-face {
            font-family: 'Kantumruy Pro';
            src: url('/fonts/KantumruyPro-VariableFont_wght.ttf') format('truetype-variations'),
                 url('/fonts/KantumruyPro-VariableFont_wght.ttf') format('truetype');
            font-weight: 100 900;
            font-style: normal;
        }

        @font-face {
            font-family: 'Kantumruy Pro';
            src: url('/fonts/KantumruyPro-Italic-VariableFont_wght.ttf') format('truetype-variations'),
                 url('/fonts/KantumruyPro-Italic-VariableFont_wght.ttf') format('truetype');
            font-weight: 100 900;
            font-style: italic;
        }

        @import url('https://fonts.googleapis.com/css2?family=Moul&display=swap');

        body {
            font-family: 'Kantumruy Pro', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
            padding-top: 0 !important;
            overflow-x: hidden;
            font-size: 18px;
        }

        .app-layout {
            display: flex;
            min-height: 100vh;
            position: relative;
        }

        /* Sidebar Styling - Emerald Green Scheme matching SMM Panels */
        .app-sidebar {
            width: 280px;
            min-width: 280px;
            height: 100vh;
            background-color: #1769AA;
            color: #ffffff;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            box-shadow: 4px 0 25px 0 rgba(23, 105, 170, 0.18);
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1), transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
        }

        .sidebar-header {
            height: 75px;
            display: flex;
            align-items: center;
            padding: 0 24px;
            border-bottom: 1px solid #3B82C4;
            transition: all 0.3s ease;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #ffffff;
            text-decoration: none !important;
            width: 100%;
        }

        .brand-text {
            font-family: 'Khmer OS Muol Light', 'Khmer OS Muol', 'Moul', sans-serif !important;
            font-weight: 500 !important;
            font-size: 1.8rem;
            color: #ffffff;
            letter-spacing: 0.5px;
            line-height: 1.4;
            transition: opacity 0.3s ease;
        }

        .brand-svg-icon {
            animation: pulse-ring 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
            flex-shrink: 0;
        }

        .sidebar-menu {
            list-style: none;
            padding: 20px 12px;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 6px;
            flex-grow: 1;
            overflow-y: auto;
            overflow-x: hidden;
            scrollbar-width: thin;
            scrollbar-color:#7DB7E8 rgba(37, 112, 173, 0.2);
        }

        /* Custom sidebar menu scrollbar for webkit browsers */
        .sidebar-menu::-webkit-scrollbar {
            width: 6px;
        }
        .sidebar-menu::-webkit-scrollbar-track {
            background: rgba(37, 112, 173, 0.15);
            border-radius: 3px;
        }
        .sidebar-menu::-webkit-scrollbar-thumb {
            background: #5FA8D3;
            border-radius: 3px;
        }
        .sidebar-menu::-webkit-scrollbar-thumb:hover {
            background: #0F4C81;
        }

        .menu-item-single, .menu-item-group {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .menu-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 18px;
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none !important;
            font-weight: 500;
            font-size: 1.65rem;
            border-radius: 8px;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .menu-link:hover {
            background-color: #3B82C4;
            color: #ffffff;
        }
        .menu-link.active {
            background-color: #0F4C81;
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(15, 76, 129, 0.3);
        }

        .menu-link.active-parent {
            background-color: #256EA8;
            color: #ffffff;
        }

        .menu-svg-icon {
            width: 22px;
            height: 22px;
            opacity: 0.9;
            margin-right: 12px;
            flex-shrink: 0;
            transition: margin 0.3s ease;
        }

        .menu-link.active .menu-svg-icon,
        .menu-link.active-parent .menu-svg-icon {
            opacity: 1;
            color: #ffffff;
        }

        /* Dropdown Sub-menu */
        .dropdown-menu-custom {
            list-style: none;
            padding: 6px 0 6px 0;
            margin: 4px 0 4px 26px;
            display: none;
            flex-direction: column;
            gap: 4px;
            border-left: 1px solid#4A90C2;
        }

        .dropdown-menu-custom.open {
            display: flex;
        }

        .dropdown-menu-custom li {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .dropdown-menu-custom a {
            display: block;
            padding: 9px 18px;
            color: rgba(255, 255, 255, 0.75);
            font-size: 1.5rem;
            font-weight: 500;
            text-decoration: none !important;
            transition: all 0.15s ease;
            border-radius: 0 6px 6px 0;
            position: relative;
        }

        .dropdown-menu-custom a::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            width: 8px;
            height: 1px;
            background-color: #72B7E8;
        }

        .dropdown-menu-custom a:hover {
            background-color:#2878B5;
            color: #ffffff;
        }

        .dropdown-menu-custom a.active {
            color: #DCEEFF;
            font-weight: 600;
            background-color: rgba(255, 255, 255, 0.08);
        }

        .dropdown-caret {
            transition: transform 0.2s ease;
            color: rgba(255, 255, 255, 0.6);
        }

        .menu-link:hover .dropdown-caret {
            color: #ffffff;
        }

        .dropdown-caret.rotate {
            transform: rotate(180deg);
            color: #ffffff;
        }

        /* Collapsed Sidebar State - Keeping Icons Visible */
        body.sidebar-collapsed .app-sidebar {
            width: 75px;
            min-width: 75px;
        }

        body.sidebar-collapsed .app-sidebar .brand-text,
        body.sidebar-collapsed .app-sidebar .menu-link span,
        body.sidebar-collapsed .app-sidebar .dropdown-caret,
        body.sidebar-collapsed .app-sidebar .dropdown-menu-custom {
            display: none !important;
        }

        body.sidebar-collapsed .app-sidebar .sidebar-header {
            padding: 0;
            justify-content: center;
        }

        body.sidebar-collapsed .app-sidebar .sidebar-logo {
            justify-content: center;
            gap: 0;
        }

        body.sidebar-collapsed .app-sidebar .menu-link {
            justify-content: center;
            padding: 14px 0;
        }

        body.sidebar-collapsed .app-sidebar .menu-svg-icon {
            margin-right: 0 !important;
        }

        body.sidebar-collapsed .app-content-area {
            margin-left: 75px;
        }

        /* Hover expansion when collapsed */
        body.sidebar-collapsed .app-sidebar:hover {
            width: 280px;
            box-shadow: 10px 0 30px rgba(0, 0, 0, 0.15);
        }

        body.sidebar-collapsed .app-sidebar:hover ~ .app-content-area {
            margin-left: 280px;
        }

        body.sidebar-collapsed .app-sidebar:hover .brand-text {
            display: inline-block !important;
        }
        body.sidebar-collapsed .app-sidebar:hover .menu-link span {
            display: inline-block !important;
        }
        body.sidebar-collapsed .app-sidebar:hover .dropdown-caret {
            display: inline-block !important;
        }
        body.sidebar-collapsed .app-sidebar:hover .dropdown-menu-custom.open {
            display: flex !important;
        }

        body.sidebar-collapsed .app-sidebar:hover .sidebar-header {
            padding: 0 24px;
            justify-content: flex-start;
        }

        body.sidebar-collapsed .app-sidebar:hover .sidebar-logo {
            justify-content: flex-start;
            gap: 12px;
        }

        body.sidebar-collapsed .app-sidebar:hover .menu-link {
            justify-content: space-between;
            padding: 14px 18px;
        }

        body.sidebar-collapsed .app-sidebar:hover .menu-svg-icon {
            margin-right: 12px !important;
        }

        /* Content Area */
        .app-content-area {
            flex-grow: 1;
            min-width: 0;
            margin-left: 270px ; //!important
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background-color: #f3f4f6;
        }

        /* Custom Header */
        .app-header-custom {
            height: 75px;
            background-color: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            position: sticky;
            top: 0;
            z-index: 999;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05);
        }

        .header-title {
            font-family: 'Khmer OS Muol Light', 'Khmer OS Muol', 'Moul', sans-serif !important;
            font-weight: 500 !important;
            font-size: 1.5rem;
            letter-spacing: 0.5px;
            color: #2878B5;
            text-transform: uppercase;
        }

        .toggle-btn {
            border: none;
            background: none;
            padding: 8px;
            cursor: pointer;
            color: #475569;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.2s;
        }

        .toggle-btn:hover {
            background-color: #f1f5f9;
            color: #0f172a;
        }

        /* Switchers Styling */
        .switcher-btn {
            background: none;
            border: none;
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 600;
            color: #475569;
            padding: 8px 12px;
            border-radius: 8px;
            transition: all 0.2s ease;
            cursor: pointer;
            font-size: 0.95rem;
        }

        .switcher-btn:hover {
            background-color: #f1f5f9;
            color: #0f172a;
        }

        .switcher-dropdown {
            position: absolute;
            right: 0;
            top: 45px;
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -4px rgba(0, 0, 0, 0.05);
            width: 140px;
            list-style: none;
            padding: 6px;
            margin: 0;
            display: none;
            z-index: 1001;
            animation: slideDown 0.15s ease-out;
        }

        .switcher-dropdown.open {
            display: block;
        }

        .switcher-item {
            display: flex;
            align-items: center;
            padding: 10px 12px;
            color: #475569;
            font-size: 0.9rem;
            font-weight: 500;
            text-decoration: none !important;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.15s ease;
        }

        .switcher-item:hover {
            background-color: #f1f5f9;
            color: #0f172a;
        }

        .switcher-item.active {
            background-color: rgba(16, 185, 129, 0.08);
            color: #2e9f7b;
            font-weight: 600;
        }

        .flag-icon {
            box-shadow: 0 1px 2px rgba(0,0,0,0.1);
        }

        .user-profile-btn {
            background: none;
            border: none;
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
            color: #334155;
            padding: 8px 12px;
            border-radius: 8px;
            transition: all 0.2s ease;
            cursor: pointer;
            font-size: 0.95rem;
        }

        .user-profile-btn:hover {
            background-color: #f1f5f9;
        }

        .user-dropdown-custom {
            position: absolute;
            right: 0;
            top: 45px;
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -4px rgba(0, 0, 0, 0.05);
            width: 200px;
            list-style: none;
            padding: 6px;
            margin: 0;
            display: none;
            z-index: 1001;
            animation: slideDown 0.15s ease-out;
        }

        .user-dropdown-custom.open {
            display: block;
        }

        .user-dropdown-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            color: #475569;
            font-size: 0.9rem;
            font-weight: 500;
            text-decoration: none !important;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.15s ease;
        }

        .user-dropdown-item:hover {
            background-color: #f1f5f9;
            color: #0f172a;
        }

        /* Sidebar overlay for mobile */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(15, 23, 42, 0.3);
            backdrop-filter: blur(4px);
            z-index: 998;
        }

        /* Animations */
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-8px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse-ring {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: .6;
            }
        }

        /* Responsive Breakpoints */
        @media (max-width: 992px) {
            .app-sidebar {
                transform: translateX(-280px);
            }
            .app-content-area {
                margin-left: 0 !important;
            }
            body.sidebar-open .app-sidebar {
                transform: translateX(0);
            }
            body.sidebar-open .sidebar-overlay {
                display: block;
            }
            body.sidebar-collapsed .app-sidebar {
                transform: translateX(-280px);
            }
        }

        /* Override existing styles and containers to behave well under flex columns */
        .col-sm-offset-3, .col-md-offset-2 {
            margin-left: 0 !important;
        }
        .main {
            padding: 0 !important;
            width: 100% !important;
            float: none !important;
            margin: 0 !important;
        }
        .app-content-body {
            flex-grow: 1;
            padding: 24px;
        }
        
        /* Table and Panel Overrides for Premium Green styling */
        .panel {
            border: 1px solid #e2e8f0 !important;
            border-radius: 12px !important;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.02) !important;
            overflow: hidden;
            margin-bottom: 24px;
        }
        .panel-heading {
            background-color: #10b981 !important;
            border-bottom: 1px solid #059669 !important;
            font-family: 'Khmer OS Muol Light', 'Khmer OS Muol', 'Moul', sans-serif !important;
            font-weight: 500 !important;
            color: #ffffff !important;
            padding: 16px 20px !important;
            font-size: 1.25rem !important;
        }
        .panel-body {
            padding: 20px !important;
            background-color: #ffffff;
        }
        .table {
            margin-bottom: 0 !important;
        }
        .table > thead > tr > th {
            border-bottom: 1px solid #e5e7eb !important;
            color: #047857 !important;
            font-weight: 600 !important;
            text-transform: uppercase;
            font-size: 0.95rem;
            letter-spacing: 0.5px;
            padding: 12px 16px !important;
            background-color: #f0fdf4;
        }
        .table > tbody > tr > td {
            border-top: 1px solid #f3f4f6 !important;
            padding: 14px 16px !important;
            color: #374151;
            font-size: 1.05rem;
        }
        .breadcrumb {
            background-color: transparent !important;
            padding: 0 !important;
            margin-bottom: 16px !important;
            font-size: 1.05rem;
        }
        .breadcrumb a {
            color: #10b981;
            text-decoration: none;
        }
        .breadcrumb > .active {
            color: #6b7280 !important;
        }
        .page-header {
            margin: 0 0 20px 0 !important;
            font-family: 'Khmer OS Muol Light', 'Khmer OS Muol', 'Moul', sans-serif !important;
            font-weight: 500 !important;
            color: #111827 !important;
            border-bottom: none !important;
            font-size: 1.95rem !important;
        }

        /* Form and General controls styling to match increased fonts */
        label, .form-group label, .control-label, select, textarea, button, .btn {
            font-size: 1.1rem !important;
        }
        .form-control, input[type="text"], input[type="email"], input[type="password"], input[type="number"], select {
            height: 44px !important;
            font-size: 1.05rem !important;
        }

        /* Redesign buttons to match Followiz green scheme */
        .btn-primary {
            background-color: #10b981 !important;
            border-color: #10b981 !important;
            box-shadow: 0 2px 4px rgba(16, 185, 129, 0.15) !important;
            border-radius: 6px !important;
            font-weight: 600 !important;
            transition: all 0.2s !important;
            font-size: 0.95rem !important;
        }
        .btn-primary:hover, .btn-primary:focus, .btn-primary:active {
            background-color: #059669 !important;
            border-color: #059669 !important;
            box-shadow: 0 4px 8px rgba(16, 185, 129, 0.25) !important;
        }

        .btn-success {
            background-color: #059669 !important;
            border-color: #059669 !important;
            font-size: 0.95rem !important;
        }

        /* Color classes override for dashboard panels */
        .panel-blue {
            background-color: #ffffff !important;
            border-left: 4px solid #10b981 !important;
        }
        .panel-blue .large {
            color: #10b981 !important;
        }
        .panel-orange {
            background-color: #ffffff !important;
            border-left: 4px solid #f59e0b !important;
        }
        .panel-orange .large {
            color: #f59e0b !important;
        }
        .panel-teal {
            background-color: #ffffff !important;
            border-left: 4px solid #06b6d4 !important;
        }
        .panel-teal .large {
            color: #06b6d4 !important;
        }
        .panel-red {
            background-color: #ffffff !important;
            border-left: 4px solid #6944ef !important;
        }
        .panel-red .large {
            color: #4c52f5 !important;
        }
        .text-muted {
            color: #6b7280 !important;
            font-weight: 500 !important;
            font-size: 0.95rem !important;
        }

        /* Premium DataTables controls styling */
        .dataTables_wrapper .dataTables_length {
            margin-bottom: 15px;
            color: #4b5563;
            font-size: 1.05rem;
        }
        .dataTables_wrapper .dataTables_length select {
            border: 1px solid #d1d5db !important;
            border-radius: 6px !important;
            padding: 6px 12px !important;
            height: 38px !important;
            background-color: #ffffff !important;
            outline: none !important;
            color: #374151 !important;
            transition: border-color 0.2s, box-shadow 0.2s;
            margin: 0 6px !important;
        }
        .dataTables_wrapper .dataTables_length select:focus {
            border-color: #10b981 !important;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.15) !important;
        }

        .dataTables_wrapper .dataTables_filter {
            margin-bottom: 15px;
            color: #4b5563;
            font-size: 1.05rem;
        }
        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #d1d5db !important;
            border-radius: 6px !important;
            padding: 6px 12px !important;
            height: 38px !important;
            width: 220px !important;
            background-color: #ffffff !important;
            outline: none !important;
            color: #374151 !important;
            transition: border-color 0.2s, box-shadow 0.2s;
            margin-left: 8px !important;
        }
        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #10b981 !important;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.15) !important;
        }
        
        /* DataTables pagination styling */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 6px !important;
            padding: 6px 12px !important;
            border: 1px solid #e5e7eb !important;
            background: #ffffff !important;
            color: #374151 !important;
            margin: 0 2px !important;
            transition: all 0.2s !important;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.current, 
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #10b981 !important;
            border-color: #10b981 !important;
            color: #ffffff !important;
        }

        /* Force uniform font size for all page content elements */
        .app-content-body, 
        .app-content-body p, 
        .app-content-body span:not(.brand-text):not(.header-title), 
        .app-content-body li, 
        .app-content-body label, 
        .app-content-body th, 
        .app-content-body td, 
        .app-content-body input, 
        .app-content-body select, 
        .app-content-body textarea, 
        .app-content-body button, 
        .app-content-body .btn {
            font-size: 1.5rem !important;
        }
       
    /* ===== BLUE THEME (ស្របតាម Sidebar) ===== */
:root {
    --c-primary:      #1769AA;  /* ពណ៌មេ = Sidebar */
    --c-primary-dark: #0F4C81;  /* active / hover ខ្លាំង */
    --c-primary-mid:  #256EA8;
    --c-primary-soft: #3B82C4;
    --c-primary-light:#DCEEFF;
    --c-primary-bg:   #EAF4FD;  /* ផ្ទៃស្រាល */
    --c-border:       #D6E4F0;
    --c-text:         #1E3A52;
}

body, .app-content-area { background-color: #F1F6FB; }

/* Header */
.app-header-custom { border-bottom: 1px solid var(--c-border); }
.header-title { color: var(--c-primary) !important; }
.toggle-btn { color: var(--c-primary); }
.toggle-btn:hover,
.switcher-btn:hover,
.user-profile-btn:hover,
.user-dropdown-item:hover,
.switcher-item:hover { background-color: var(--c-primary-bg); color: var(--c-primary-dark); }
.switcher-item.active {
    background-color: var(--c-primary-bg);
    color: var(--c-primary);
}
.switcher-btn span[style*="#10b981"] { color: var(--c-primary) !important; }

/* Panel */
.panel { border: 1px solid var(--c-border) !important; }
.panel-heading {
    background: linear-gradient(135deg, var(--c-primary) 0%, var(--c-primary-mid) 100%) !important;
    border-bottom: 1px solid var(--c-primary-dark) !important;
    color: #fff !important;
}

/* តារាង */
.table > thead > tr > th {
    background-color: var(--c-primary-bg) !important;
    color: var(--c-primary-dark) !important;
    border-bottom: 2px solid var(--c-border) !important;
}
.table > tbody > tr > td { color: var(--c-text); border-top: 1px solid #EEF3F8 !important; }
.table-hover > tbody > tr:hover,
.table > tbody > tr:hover { background-color: #F5FAFE; }

/* Breadcrumb / Title */
.breadcrumb a { color: var(--c-primary); }
.page-header { color: var(--c-primary-dark) !important; }

/* ប៊ូតុង */
.btn-primary {
    background-color: var(--c-primary) !important;
    border-color: var(--c-primary) !important;
    box-shadow: 0 2px 4px rgba(23, 105, 170, 0.2) !important;
}
.btn-primary:hover, .btn-primary:focus, .btn-primary:active {
    background-color: var(--c-primary-dark) !important;
    border-color: var(--c-primary-dark) !important;
    box-shadow: 0 4px 8px rgba(15, 76, 129, 0.3) !important;
}
.btn-info {
    background-color: var(--c-primary-soft) !important;
    border-color: var(--c-primary-soft) !important;
    color: #fff !important;
}
.btn-success { background-color: #16a34a !important; border-color: #16a34a !important; }
.btn-default { border-color: var(--c-border) !important; color: var(--c-primary-dark); }
.btn-default:hover { background-color: var(--c-primary-bg) !important; }

/* Form */
.form-control:focus, .select2-container--default.select2-container--focus .select2-selection--multiple,
.select2-container--default .select2-selection--single:focus {
    border-color: var(--c-primary) !important;
    box-shadow: 0 0 0 3px rgba(23, 105, 170, 0.15) !important;
}

/* Dashboard cards */
.panel-blue   { border-left: 4px solid var(--c-primary) !important; }
.panel-blue .large   { color: var(--c-primary) !important; }
.panel-teal   { border-left: 4px solid #0EA5C6 !important; }
.panel-teal .large   { color: #0EA5C6 !important; }
.panel-orange { border-left: 4px solid #F59E0B !important; }
.panel-orange .large { color: #F59E0B !important; }
.panel-red    { border-left: 4px solid #7C5CE0 !important; }
.panel-red .large    { color: #7C5CE0 !important; }
.panel-blue, .panel-teal, .panel-orange, .panel-red {
    transition: transform .2s, box-shadow .2s;
}
.panel-blue:hover, .panel-teal:hover, .panel-orange:hover, .panel-red:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(23, 105, 170, 0.12) !important;
}

/* DataTables */
.dataTables_wrapper .dataTables_length select:focus,
.dataTables_wrapper .dataTables_filter input:focus {
    border-color: var(--c-primary) !important;
    box-shadow: 0 0 0 3px rgba(23, 105, 170, 0.15) !important;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.current,
.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background: var(--c-primary) !important;
    border-color: var(--c-primary) !important;
    color: #fff !important;
}

    </style>
    <script>
        // Apply sidebar state immediately to prevent layout shift (flash)
        (function() {
            const collapsed = localStorage.getItem('sidebar-collapsed');
            if (collapsed === 'true') {
                document.documentElement.classList.add('sidebar-collapsed');
            }
        })();
    </script>
</head>
<body>

<div class="app-layout" id="appLayout">
    <!-- Mobile Sidebar Overlay -->
    <div class="sidebar-overlay" onclick="toggleSidebar()"></div>

    <!-- Left Sidebar -->
    <aside class="app-sidebar" id="appSidebar">
        <div class="sidebar-header">
            <a href="{{route('dashboard.index')}}" class="sidebar-logo">
                <img src="/logo_favicon.png" alt="Logo" class="brand-svg-icon" style="width:34px; height:34px; object-fit:contain; border-radius:4px; margin-right:4px;" />
                <span class="brand-text">{{ App::getLocale() === 'km' ? 'អរុណរះ គ្លីនិក' : 'ARUNRASH CLINIC' }}</span>
            </a>
        </div>
        
        <ul class="sidebar-menu">
            <li class="menu-item-single">
                <a href="{{route('dashboard.index')}}" class="menu-link" id="menu-link-dashboard">
                    <div style="display:flex; align-items:center;">
                        <svg class="menu-svg-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" /></svg>
                        <span>{{ App::getLocale() === 'km' ? 'ផ្ទាំងព័ត៌មាន' : 'Dashboard' }}</span>
                    </div>
                </a>
            </li>

            <!-- Admin Setup Group -->
            @permission('department.index')
            <li class="menu-item-group" id="menu-group-admin">
                <div class="menu-link menu-dropdown-toggle" onclick="toggleDropdown(this)">
                    <div style="display:flex; align-items:center;">
                        <svg class="menu-svg-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.248-8.25-3.285z" /></svg>
                        <span>{{ App::getLocale() === 'km' ? 'ការគ្រប់គ្រង' : 'Management' }}</span>
                    </div>
                    <svg class="dropdown-caret" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width:12px; height:12px;"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
                </div>
                <ul class="dropdown-menu-custom">
                    <li><a href="{{route('department.index')}}">{{ App::getLocale() === 'km' ? 'ផ្នែកគ្លីនិក' : 'Departments' }}</a></li>
                    <li><a href="{{route('service.index')}}">{{ App::getLocale() === 'km' ? 'សេវាកម្ម' : 'Services' }}</a></li>
                {{--    <li><a href="{{route('package.index')}}">{{ App::getLocale() === 'km' ? 'កញ្ចប់សេវា' : 'Packages' }}</a></li>  --}}
                    <li><a href="{{route('employee.index')}}">{{ App::getLocale() === 'km' ? 'បុគ្គលិក' : 'Employees' }}</a></li>
                    <li><a href="{{route('doctor.index')}}">{{ App::getLocale() === 'km' ? 'វេជ្ជបណ្ឌិត ' : 'Doctor ' }}</a></li>
                    <li><a href="{{route('invoice.report')}}">{{ App::getLocale() === 'km' ? 'របាយការណ៍វិក្កយបត្រ' : 'Invoice Report' }}</a></li>
                </ul>
            </li>
            @endpermission

            <!-- Patients Group -->
            @permission('patient.index')
            <li class="menu-item-group" id="menu-group-patients">
                <div class="menu-link menu-dropdown-toggle" onclick="toggleDropdown(this)">
                    <div style="display:flex; align-items:center;">
                        <svg class="menu-svg-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m0 0a8.967 8.967 0 01-2.312-6.086c0-3.482 1.961-6.505 4.88-8.003M18.72 9.75a3 3 0 11-6 0 3 3 0 016 0zM12.75 12a3 3 0 11-6 0 3 3 0 016 0zM9.75 15.75a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15.75 15.75a6.002 6.002 0 01-1.125 3.197m0 0a8.965 8.965 0 01-3.74-.477m.94-2.72a5.97 5.97 0 00-.94-3.197m0 0a5.97 5.97 0 00-1.125 3.197m0 0a8.96 8.96 0 01-3.74-.477" /></svg>
                        <span>{{ App::getLocale() === 'km' ? 'អ្នកជំងឺ' : 'Patients' }}</span>
                    </div>
                    <svg class="dropdown-caret" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width:12px; height:12px;"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
                </div>
                <ul class="dropdown-menu-custom">
                    <li><a href="{{route('patient.index')}}">{{ App::getLocale() === 'km' ? 'គ្រប់គ្រងអ្នកជំងឺ' : 'Manage Patients' }}</a></li>
                    <li><a href="{{route('appointment.index')}}">{{ App::getLocale() === 'km' ? 'ជំនួបអ្នកជំងឺ' : 'Appointments' }}</a></li>
                </ul>
            </li>
            @endpermission

            <!-- Billing Group -->
            <li class="menu-item-group" id="menu-group-billing">
                <div class="menu-link menu-dropdown-toggle" onclick="toggleDropdown(this)">
                    <div style="display:flex; align-items:center;">
                        <svg class="menu-svg-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" /></svg>
                        <span>{{ App::getLocale() === 'km' ? 'ការទូទាត់/វិក្កយបត្រ' : 'Billing/Invoice' }}</span>
                    </div>
                    <svg class="dropdown-caret" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width:12px; height:12px;"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
                </div>
                <ul class="dropdown-menu-custom">
                    <li><a href="{{route('invoice.index')}}">{{ App::getLocale() === 'km' ? 'វិក្កយបត្រសេវាកម្ម' : 'Service Bill' }}</a></li>
                    <li><a href="{{route('opd.index')}}">{{ App::getLocale() === 'km' ? 'វិក្កយបត្រ OPD' : 'OPD Bill' }}</a></li>
                {{--    <li><a href="{{url('package/sale')}}">{{ App::getLocale() === 'km' ? 'វិក្កយបត្រកញ្ចប់' : 'Package Bill' }}</a></li> --}}
                    @permission('search.invoice')
                    <li><a href="{{route('search.invoice')}}">{{ App::getLocale() === 'km' ? 'របាយការណ៍វិក្កយបត្រ' : 'Invoice Report' }}</a></li>
                    @endpermission
                </ul>
            </li>

            <!-- Lab Tests Group -->
            <!--@permission('test.index')
            <li class="menu-item-group" id="menu-group-lab">
                <div class="menu-link menu-dropdown-toggle" onclick="toggleDropdown(this)">
                    <div style="display:flex; align-items:center;">
                        <svg class="menu-svg-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v1.242c0 .289.139.56.378.718l4.744 3.163a1.5 1.5 0 01.628 1.242v7.606c0 .546-.293 1.054-.767 1.325l-4.744 2.711a1.5 1.5 0 01-1.488 0L3.767 16.41A1.5 1.5 0 013 15.085V7.48a1.5 1.5 0 01.628-1.243l4.744-3.163a1.272 1.272 0 01.378-.718V3.104z" /><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 8.25h4.5M9.75 12h4.5" /></svg>
                        <span>{{ App::getLocale() === 'km' ? 'ការធ្វើតេស្តមន្ទីរពិសោធន៍' : 'Lab Test' }}</span>
                    </div>
                    <svg class="dropdown-caret" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width:12px; height:12px;"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
                </div>
                <ul class="dropdown-menu-custom">
                    <li><a href="{{route('test.index')}}">{{ App::getLocale() === 'km' ? 'គ្រប់គ្រងការធ្វើតេស្ត' : 'Manage Test' }}</a></li>
                    <li><a href="{{route('reference.index')}}">{{ App::getLocale() === 'km' ? 'ឯកសារយោងតេស្ត' : 'Test References' }}</a></li>
                    <li><a href="{{route('haematology.index')}}">{{ App::getLocale() === 'km' ? 'របាយការណ៍ឈាម' : 'Haematology Report' }}</a></li>
                    <li><a href="{{route('biochemistry.index')}}">{{ App::getLocale() === 'km' ? 'របាយការណ៍ជីវគីមី' : 'Biochemistry Report' }}</a></li>
                    <li><a href="{{route('immunology.index')}}">{{ App::getLocale() === 'km' ? 'របាយការណ៍ស៊ាំ' : 'Immunology Report' }}</a></li>
                    <li><a href="{{route('microbiology.index')}}">{{ App::getLocale() === 'km' ? 'របាយការណ៍មីក្រូជីវវិទ្យា' : 'Microbiology Report' }}</a></li>
                    <li><a href="{{route('examination.index')}}">{{ App::getLocale() === 'km' ? 'របាយការណ៍ពិនិត្យ' : 'Examination Report' }}</a></li>
                    <li><a href="{{route('stain.index')}}">{{ App::getLocale() === 'km' ? 'របាយការណ៍លាបពណ៌' : 'Stain Report' }}</a></li>
                    <li><a href="{{route('report.index')}}">{{ App::getLocale() === 'km' ? 'របាយការណ៍ទាំងអស់' : 'All Reports' }}</a></li>
                </ul>
            </li>
            @endpermission  -->

            <!-- Reports Group -->
            @permission('invoice.report')
            <li class="menu-item-group" id="menu-group-reports">
                <div class="menu-link menu-dropdown-toggle" onclick="toggleDropdown(this)">
                    <div style="display:flex; align-items:center;">
                        <svg class="menu-svg-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v5.625c0 .621-.504 1.125-1.125 1.125h-2.25A1.125 1.125 0 013 18.75v-5.625zM16.5 10.125c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v8.625c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V10.125zM9.75 4.125c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v14.625c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" /></svg>
                        <span>{{ App::getLocale() === 'km' ? 'របាយការណ៍លក់' : 'Reports' }}</span>
                    </div>
                    <svg class="dropdown-caret" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width:12px; height:12px;"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
                </div>
                <ul class="dropdown-menu-custom">
                    <li><a href="{{route('account.service')}}">{{ App::getLocale() === 'km' ? 'លក់សេវាកម្ម' : 'Service Sale' }}</a></li>
                    <li><a href="{{route('account.opd')}}">{{ App::getLocale() === 'km' ? 'លក់ ' : ' Sale' }}</a></li>
                {{--    <li><a href="{{route('account.package')}}">{{ App::getLocale() === 'km' ? 'លក់កញ្ចប់សេវា' : 'Package Sale' }}</a></li> --}}
                </ul>
            </li>
            @endpermission

            <!-- Settings Group -->
            @permission('hospital.setting')
            <li class="menu-item-group" id="menu-group-settings">
                <div class="menu-link menu-dropdown-toggle" onclick="toggleDropdown(this)">
                    <div style="display:flex; align-items:center;">
                        <svg class="menu-svg-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.43l-1.003.828c-.293.241-.438.613-.43.992a7.723 7.723 0 010 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.43l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.991l-1.004-.827a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        <span>{{ App::getLocale() === 'km' ? 'ការកំណត់ប្រព័ន្ធ' : 'Settings' }}</span>
                    </div>
                    <svg class="dropdown-caret" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width:12px; height:12px;"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
                </div>
                <ul class="dropdown-menu-custom">
                    @permission('user.index')
                    <li><a href="{{route('user.index')}}">{{ App::getLocale() === 'km' ? 'អ្នកប្រើប្រាស់' : 'Users' }}</a></li>
                    @permission('role.index')
                    <li><a href="{{route('role.index')}}">{{ App::getLocale() === 'km' ? 'តួនាទី' : 'Roles' }}</a></li>
                    @endpermission
                    <li><a href="{{ route('hospital.setting')}}">{{ App::getLocale() === 'km' ? 'ការកំណត់ប្រព័ន្ធ' : 'Settings' }}</a></li>
                    <li><a href="{{ route('hospital.backup')}}">{{ App::getLocale() === 'km' ? 'ចម្លងទុកទិន្នន័យ' : 'Backup' }}</a></li>
                    @endpermission
                </ul>
            </li>
            @endpermission
        </ul>
    </aside>

    <!-- Main Content Area -->
    <div class="app-content-area" id="appContentArea">
        <header class="app-header-custom">
            <div style="display:flex; align-items:center; gap:15px;">
                <button class="toggle-btn" onclick="toggleSidebar(event)">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" style="width:20px; height:20px;"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                </button>
                <div class="header-title">{{ App::getLocale() === 'km' ? 'អរុណរះ គ្លីនិក' : 'ARUNRASH CLINIC' }}</div>
            </div>
            
            <div style="display:flex; align-items:center; gap:20px;">
                <!-- Currency Switcher -->
                <div style="position:relative;">
                    <button class="switcher-btn" onclick="toggleCurrencyDropdown(event)">
                        <span style="font-weight:700; color:#10b981;">{{ session('currency', 'USD') }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width:12px; height:12px; margin-top:2px;"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
                    </button>
                    <ul class="switcher-dropdown" id="currencyDropdown">
                        <li><a class="switcher-item {{ session('currency', 'USD') === 'USD' ? 'active' : '' }}" href="{{ route('currency.switch', 'USD') }}">USD ($)</a></li>
                        <li><a class="switcher-item {{ session('currency', 'USD') === 'KHR' ? 'active' : '' }}" href="{{ route('currency.switch', 'KHR') }}">KHR (៛)</a></li>
                    </ul>
                </div>

                <!-- Language Switcher -->
                <div style="position:relative;">
                    <button class="switcher-btn" onclick="toggleLanguageDropdown(event)">
                        @if(session('locale', 'en') === 'km')
                            <svg class="flag-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 16" style="width: 18px; height: 11px; border-radius: 2px; display:inline-block; vertical-align:middle; margin-right:4px;"><rect width="25" height="16" fill="#032a95"/><rect y="4" width="25" height="8" fill="#e11c27"/><g fill="#fff" transform="translate(10,5) scale(0.12)"><path d="M21 21v1h-1v-1h-1v-1h1V9l1-3 1 3v11h1v1h-1zm14 0v1h-1v-1h-1v-1h1V9l1-3 1 3v11h1v1h-1zM7 21v1H6v-1H5v-1h1V9l1-3 1 3v11h1v1H9z"/><path d="M1 21v1h40v-1H1zm5-7h30v1H6z"/></g></svg>
                            <span>ភាសាខ្មែរ</span>
                        @else
                            <svg class="flag-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 7410 3900" style="width: 18px; height: 11px; border-radius: 2px; display:inline-block; vertical-align:middle; margin-right:4px;"><rect width="7410" height="3900" fill="#b22234"/><path d="M0,0H2964V2100H0Z" fill="#3c3b6e"/><g fill="#fff"><g id="s18_flag_h"><g id="s9_flag_h"><g id="s5_flag_h"><g id="s_flag_h"><polygon points="247,0 307,185 160,72 334,72 187,185"/></g><use href="#s_flag_h" x="494"/><use href="#s_flag_h" x="988"/><use href="#s_flag_h" x="1482"/><use href="#s_flag_h" x="1976"/></g><use href="#s_flag_h" x="247" y="175"/><use href="#s_flag_h" x="741" y="175"/><use href="#s_flag_h" x="1235" y="175"/><use href="#s_flag_h" x="1729" y="175"/><use href="#s_flag_h" x="2223" y="175"/></g><use href="#s9_flag_h" y="350"/></g><use href="#s18_flag_h" y="700"/><use href="#s9_flag_h" y="1400"/><use href="#s5_flag_h" y="1050"/><use href="#s_flag_h" x="247" y="1050"/><use href="#s_flag_h" x="741" y="1050"/><use href="#s_flag_h" x="1235" y="1050"/><use href="#s_flag_h" x="1729" y="1050"/><use href="#s_flag_h" x="2223" y="1050"/></g><rect y="300" width="7410" height="300" fill="#fff"/><rect y="900" width="7410" height="300" fill="#fff"/><rect y="1500" width="7410" height="300" fill="#fff"/><rect y="2100" width="7410" height="300" fill="#fff"/><rect y="2700" width="7410" height="300" fill="#fff"/><rect y="3300" width="7410" height="300" fill="#fff"/></svg>
                            <span>English</span>
                        @endif
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width:12px; height:12px; margin-top:2px;"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
                    </button>
                    <ul class="switcher-dropdown" id="languageDropdown">
                        <li><a class="switcher-item {{ session('locale', 'en') === 'en' ? 'active' : '' }}" href="{{ route('lang.switch', 'en') }}">
                            <svg class="flag-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 7410 3900" style="width: 16px; height: 10px; border-radius: 2px; display:inline-block; vertical-align:middle; margin-right:8px;"><rect width="7410" height="3900" fill="#b22234"/><path d="M0,0H2964V2100H0Z" fill="#3c3b6e"/><g fill="#fff"><g id="s18_flag_d"><g id="s9_flag_d"><g id="s5_flag_d"><g id="s_flag_d"><polygon points="247,0 307,185 160,72 334,72 187,185"/></g><use href="#s_flag_d" x="494"/><use href="#s_flag_d" x="988"/><use href="#s_flag_d" x="1482"/><use href="#s_flag_d" x="1976"/></g><use href="#s_flag_d" x="247" y="175"/><use href="#s_flag_d" x="741" y="175"/><use href="#s_flag_d" x="1235" y="175"/><use href="#s_flag_d" x="1729" y="175"/><use href="#s_flag_d" x="2223" y="175"/></g><use href="#s9_flag_d" y="350"/></g><use href="#s18_flag_d" y="700"/><use href="#s9_flag_d" y="1400"/><use href="#s5_flag_d" y="1050"/><use href="#s_flag_d" x="247" y="1050"/><use href="#s_flag_d" x="741" y="1050"/><use href="#s_flag_d" x="1235" y="1050"/><use href="#s_flag_d" x="1729" y="1050"/><use href="#s_flag_d" x="2223" y="1050"/></g><rect y="300" width="7410" height="300" fill="#fff"/><rect y="900" width="7410" height="300" fill="#fff"/><rect y="1500" width="7410" height="300" fill="#fff"/><rect y="2100" width="7410" height="300" fill="#fff"/><rect y="2700" width="7410" height="300" fill="#fff"/><rect y="3300" width="7410" height="300" fill="#fff"/></svg>
                            English
                        </a></li>
                        <li><a class="switcher-item {{ session('locale', 'en') === 'km' ? 'active' : '' }}" href="{{ route('lang.switch', 'km') }}">
                            <svg class="flag-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 16" style="width: 16px; height: 10px; border-radius: 2px; display:inline-block; vertical-align:middle; margin-right:8px;"><rect width="25" height="16" fill="#032a95"/><rect y="4" width="25" height="8" fill="#e11c27"/><g fill="#fff" transform="translate(10,5) scale(0.12)"><path d="M21 21v1h-1v-1h-1v-1h1V9l1-3 1 3v11h1v1h-1zm14 0v1h-1v-1h-1v-1h1V9l1-3 1 3v11h1v1h-1zM7 21v1H6v-1H5v-1h1V9l1-3 1 3v11h1v1H9z"/><path d="M1 21v1h40v-1H1zm5-7h30v1H6z"/></g></svg>
                            ភាសាខ្មែរ
                        </a></li>
                    </ul>
                </div>

                <div class="header-user" style="position:relative;">
                    <button class="user-profile-btn" onclick="toggleUserDropdown(event)">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width:20px; height:20px; color:#475569;"><path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        <span>{{ Auth::user()->uname }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width:12px; height:12px; margin-top:2px;"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
                    </button>
                    
                    <ul class="user-dropdown-custom" id="userDropdown">
                        <li><a class="user-dropdown-item" id="password_change_sidebar">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width:16px; height:16px;"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" /></svg>
                            {{ App::getLocale() === 'km' ? 'ផ្លាស់ប្តូរពាក្យសម្ងាត់' : 'Change Password' }}
                        </a></li>
                        <li><a class="user-dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width:16px; height:16px;"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" /></svg>
                            {{ App::getLocale() === 'km' ? 'ចាកចេញពីប្រព័ន្ធ' : 'Logout' }}
                        </a></li>
                        <form id="logout-form-sidebar" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </ul>
                </div>
            </div>
        </header>

        <div class="app-content-body">
            @yield('content')
        </div>
    </div>
</div>

<a id="password_change" style="display: none;"></a>
@include('change')

<script>
    // Collapse / Expand Sidebar on Click and save state
    function toggleSidebar(event) {
        if (event) event.stopPropagation();
        
        const isMobile = window.innerWidth <= 992;
        if (isMobile) {
            document.body.classList.remove('sidebar-collapsed');
            document.body.classList.toggle('sidebar-open');
        } else {
            document.body.classList.remove('sidebar-open');
            const isCollapsed = document.body.classList.toggle('sidebar-collapsed');
            localStorage.setItem('sidebar-collapsed', isCollapsed);
        }
    }

    // Toggle active dropdown menus in the sidebar manually
    function toggleDropdown(element) {
        const parent = element.parentElement;
        const dropdown = parent.querySelector('.dropdown-menu-custom');
        const caret = element.querySelector('.dropdown-caret');
        
        const isOpen = dropdown.classList.contains('open');
        
        // Close other open dropdowns
        document.querySelectorAll('.dropdown-menu-custom.open').forEach(el => {
            if (el !== dropdown) {
                el.classList.remove('open');
                el.parentElement.querySelector('.dropdown-caret').classList.remove('rotate');
                el.parentElement.querySelector('.menu-link').classList.remove('active-parent');
            }
        });
        
        if (isOpen) {
            dropdown.classList.remove('open');
            caret.classList.remove('rotate');
            element.classList.remove('active-parent');
        } else {
            dropdown.classList.add('open');
            caret.classList.add('rotate');
            element.classList.add('active-parent');
        }
    }

    // Toggle user profile dropdown in top right
    function toggleUserDropdown(event) {
        event.stopPropagation();
        
        // Close other dropdowns
        document.getElementById('currencyDropdown').classList.remove('open');
        document.getElementById('languageDropdown').classList.remove('open');
        
        const dropdown = document.getElementById('userDropdown');
        dropdown.classList.toggle('open');
    }

    // Toggle currency switcher dropdown
    function toggleCurrencyDropdown(event) {
        event.stopPropagation();
        
        // Close other dropdowns
        document.getElementById('languageDropdown').classList.remove('open');
        document.getElementById('userDropdown').classList.remove('open');
        
        const dropdown = document.getElementById('currencyDropdown');
        dropdown.classList.toggle('open');
    }

    // Toggle language switcher dropdown
    function toggleLanguageDropdown(event) {
        event.stopPropagation();
        
        // Close other dropdowns
        document.getElementById('currencyDropdown').classList.remove('open');
        document.getElementById('userDropdown').classList.remove('open');
        
        const dropdown = document.getElementById('languageDropdown');
        dropdown.classList.toggle('open');
    }

    // Close user/currency/language dropdown if clicking outside
    window.addEventListener('click', function(e) {
        const userDropdown = document.getElementById('userDropdown');
        const currencyDropdown = document.getElementById('currencyDropdown');
        const languageDropdown = document.getElementById('languageDropdown');
        
        if (userDropdown && userDropdown.classList.contains('open')) {
            userDropdown.classList.remove('open');
        }
        if (currencyDropdown && currencyDropdown.classList.contains('open')) {
            currencyDropdown.classList.remove('open');
        }
        if (languageDropdown && languageDropdown.classList.contains('open')) {
            languageDropdown.classList.remove('open');
        }
        
        // Mobile sidebar close on click outside
        if (window.innerWidth <= 992) {
            const sidebar = document.getElementById('appSidebar');
            const toggle = document.querySelector('.toggle-btn');
            if (sidebar && !sidebar.contains(e.target) && !toggle.contains(e.target)) {
                document.body.classList.remove('sidebar-open');
            }
        }
    });

    // Automatically expand the correct dropdown and select the active link on page load
    $(document).ready(function() {
        const currentUrl = window.location.href;
        const currentPath = window.location.pathname;
        let matched = false;

        // 1. Exact URL/Path Match for sub-menu items
        $('.dropdown-menu-custom a').each(function() {
            const linkUrl = this.href;
            const linkPath = this.pathname;
            
            if (currentUrl === linkUrl || (currentPath !== '/' && currentPath === linkPath)) {
                $(this).addClass('active');
                matched = true;
                
                const parentGroup = $(this).closest('.menu-item-group');
                if (parentGroup.length) {
                    parentGroup.find('.dropdown-menu-custom').addClass('open');
                    parentGroup.find('.dropdown-caret').addClass('rotate');
                    parentGroup.find('.menu-link').first().addClass('active-parent');
                }
            }
        });

        // 2. Prefix Match for sub-menu items (e.g., '/patient/create' matches parent sub-menu '/patient')
        if (!matched) {
            $('.dropdown-menu-custom a').each(function() {
                const linkPath = this.pathname;
                if (linkPath !== '/' && currentPath.indexOf(linkPath) === 0) {
                    $(this).addClass('active');
                    matched = true;
                    
                    const parentGroup = $(this).closest('.menu-item-group');
                    if (parentGroup.length) {
                        parentGroup.find('.dropdown-menu-custom').addClass('open');
                        parentGroup.find('.dropdown-caret').addClass('rotate');
                        parentGroup.find('.menu-link').first().addClass('active-parent');
                    }
                }
            });
        }

        // 3. Exact URL Match for single (root level) menu items
        if (!matched) {
            $('.menu-item-single a').each(function() {
                const linkUrl = this.href;
                const linkPath = this.pathname;
                if (currentUrl === linkUrl || (currentPath !== '/' && currentPath === linkPath)) {
                    $(this).addClass('active');
                    matched = true;
                }
            });
        }

        // Connect change password triggers
        $('#password_change_sidebar').click(function() {
            $('#change_password').modal('show');
        });
    });
</script>

</body>
</html>