<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>អរុណរះ គ្លីនិក - ចូលប្រព័ន្ធ</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
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
            background: linear-gradient(135deg, #10b981 0%, #059669 50%, #047857 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 20px;
            font-size: 16px;
        }

        .login-container {
            width: 100%;
            max-width: 1100px;
            display: flex;
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        /* Left Side Info Panel */
        .info-panel {
            flex: 1;
            padding: 50px;
            color: #ffffff;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background: rgba(0, 0, 0, 0.15);
            border-right: 1px solid rgba(255, 255, 255, 0.1);
        }

        @media (max-width: 768px) {
            .info-panel {
                display: none;
            }
            .login-container {
                max-width: 450px;
            }
        }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-family: 'Khmer OS Muol Light', 'Khmer OS Muol', 'Moul', sans-serif !important;
            font-weight: 500 !important;
            font-size: 1.3rem;
            letter-spacing: 0.5px;
        }

        .info-title {
            font-family: 'Khmer OS Muol Light', 'Khmer OS Muol', 'Moul', sans-serif !important;
            font-weight: 500 !important;
            font-size: 2rem;
            line-height: 1.4;
            margin-top: 30px;
            margin-bottom: 20px;
        }

        .info-desc {
            font-size: 1.05rem;
            color: rgba(255, 255, 255, 0.85);
            line-height: 1.7;
            margin-bottom: 30px;
        }

        .feature-list {
            list-style: none;
            padding: 0;
            margin: 0 0 40px 0;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
            font-size: 1rem;
        }

        .check-icon {
            width: 22px;
            height: 22px;
            color: #34d399;
            flex-shrink: 0;
        }

        .stats-row {
            display: flex;
            gap: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.15);
            padding-top: 30px;
        }

        .stat-item {
            flex: 1;
        }

        .stat-number {
            font-weight: 700;
            font-size: 1.6rem;
            color: #34d399;
        }

        .stat-label {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.7);
            margin-top: 4px;
        }

        /* Right Side Form Panel */
        .form-panel {
            width: 450px;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }

        @media (max-width: 768px) {
            .form-panel {
                width: 100%;
                padding: 40px 30px;
            }
        }

        .language-header {
            position: absolute;
            top: 30px;
            right: 40px;
            display: flex;
            gap: 10px;
        }

        .lang-flag-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 2px;
            border-radius: 4px;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            opacity: 0.6;
        }

        .lang-flag-btn:hover, .lang-flag-btn.active {
            opacity: 1;
            transform: scale(1.1);
        }

        .flag-img {
            width: 24px;
            height: 15px;
            border-radius: 2px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .welcome-title {
            font-family: 'Khmer OS Muol Light', 'Khmer OS Muol', 'Moul', sans-serif !important;
            font-weight: 500 !important;
            font-size: 1.8rem;
            color: #ffffff;
            margin-bottom: 8px;
            text-align: center;
            line-height: 1.4;
        }

        .welcome-subtitle {
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 35px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-weight: 600;
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 8px;
            letter-spacing: 0.5px;
        }

        .form-control-custom {
            width: 100%;
            height: 50px;
            background: rgba(255, 255, 255, 0.1) !important;
            border: 1.5px solid rgba(255, 255, 255, 0.2) !important;
            border-radius: 10px !important;
            padding: 0 16px !important;
            color: #ffffff !important;
            font-size: 1rem !important;
            font-weight: 500 !important;
            transition: all 0.2s !important;
            outline: none !important;
        }

        .form-control-custom::placeholder {
            color: rgba(255, 255, 255, 0.5) !important;
        }

        .form-control-custom:focus {
            background: rgba(255, 255, 255, 0.15) !important;
            border-color: #34d399 !important;
            box-shadow: 0 0 0 4px rgba(52, 211, 153, 0.15) !important;
        }

        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 30px;
            font-size: 0.95rem;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 8px;
            color: rgba(255, 255, 255, 0.85);
            cursor: pointer;
            user-select: none;
            margin: 0;
            font-weight: 500;
        }

        .checkbox-custom {
            width: 18px;
            height: 18px;
            accent-color: #10b981;
            cursor: pointer;
        }

        .login-btn {
            width: 100%;
            height: 50px;
            background-color: #10b981;
            border: none;
            border-radius: 10px;
            color: #ffffff;
            font-weight: 700;
            font-size: 1.05rem;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);
        }

        .login-btn:hover {
            background-color: #059669;
            box-shadow: 0 6px 16px rgba(16, 185, 129, 0.35);
        }

        .alert-custom {
            background-color: rgba(239, 68, 68, 0.2) !important;
            border: 1px solid rgba(239, 68, 68, 0.3) !important;
            color: #fca5a5 !important;
            border-radius: 10px;
            padding: 12px 16px;
            margin-bottom: 25px;
            font-size: 0.95rem;
            font-weight: 500;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <!-- Left Side Info -->
        <div class="info-panel">
            <div class="brand-logo">
                <img src="/logo_favicon.png" alt="Logo" class="brand-svg-icon" style="width:36px; height:36px; object-fit:contain; border-radius:4px; margin-right:6px;" />
                <span>{{ App::getLocale() === 'km' ? 'អរុណរះ គ្លីនិក' : 'ARUNRASH CLINIC' }}</span>
            </div>

            <div>
                <h2 class="info-title">
                    @if(App::getLocale() === 'km')
                        អរុណរះ គ្លីនិក
                    @else
                        ARUNRASH CLINIC
                    @endif
                </h2>
                <p class="info-desc">
                    @if(App::getLocale() === 'km')
                        ជម្រើសដ៏ល្អបំផុតចាប់តាំងពីឆ្នាំ ២០១៦។ មុខងារលំដាប់ខ្ពស់ដើម្បីគ្រប់គ្រងផ្នែក ជំនួប ការចេញវិក្កយបត្រ ការធ្វើតេស្តមន្ទីរពិសោធន៍ និងបុគ្គលិកគ្លីនិក។
                    @else
                        Trusted since 2016. High-end features to manage departments, appointments, invoicing, lab tests, and clinic staff.
                    @endif
                </p>

                <ul class="feature-list">
                    <li class="feature-item">
                        <svg class="check-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                        <span>{{ App::getLocale() === 'km' ? 'ការចុះឈ្មោះអ្នកជំងឺលឿន និងមានសុវត្ថិភាព' : 'Fast & secure patient registration' }}</span>
                    </li>
                    <li class="feature-item">
                        <svg class="check-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                        <span>{{ App::getLocale() === 'km' ? 'របាយការណ៍ធ្វើតេស្តមន្ទីរពិសោធន៍ និងការពិនិត្យពេញលេញ' : 'Complete lab test & examination reports' }}</span>
                    </li>
                    <li class="feature-item">
                        <svg class="check-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                        <span>{{ App::getLocale() === 'km' ? 'ការចេញវិក្កយបត្រវិជ្ជាជីវៈ និងរបាយការណ៍លក់ហិរញ្ញវត្ថុ' : 'Professional invoicing & financial sales reports' }}</span>
                    </li>
                    <li class="feature-item">
                        <svg class="check-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                        <span>{{ App::getLocale() === 'km' ? 'ការគ្រប់គ្រងតួនាទី និងការអនុញ្ញាតដែលអាចបត់បែនបាន' : 'Flexible roles & permissions management' }}</span>
                    </li>
                </ul>
            </div>

            <div class="stats-row">
                <div class="stat-item">
                    <div class="stat-number">10K+</div>
                    <div class="stat-label">{{ App::getLocale() === 'km' ? 'អ្នកជំងឺសរុប' : 'Patients Served' }}</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">24/7</div>
                    <div class="stat-label">{{ App::getLocale() === 'km' ? 'គាំទ្របច្ចេកទេស' : 'Technical Support' }}</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">99.9%</div>
                    <div class="stat-label">{{ App::getLocale() === 'km' ? 'ដំណើរការប្រព័ន្ធ' : 'System Uptime' }}</div>
                </div>
            </div>
        </div>

        <!-- Right Side Form -->
        <div class="form-panel">
            <!-- Language switcher top right of form card -->
            <div class="language-header">
                <a href="{{ route('lang.switch', 'en') }}" class="lang-flag-btn {{ App::getLocale() === 'en' ? 'active' : '' }}" title="English">
                    <svg class="flag-img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 7410 3900"><rect width="7410" height="3900" fill="#b22234"/><path d="M0,0H2964V2100H0Z" fill="#3c3b6e"/><g fill="#fff"><g id="s18_flag"><g id="s9_flag"><g id="s5_flag"><g id="s_flag"><polygon points="247,0 307,185 160,72 334,72 187,185"/></g><use href="#s_flag" x="494"/><use href="#s_flag" x="988"/><use href="#s_flag" x="1482"/><use href="#s_flag" x="1976"/></g><use href="#s_flag" x="247" y="175"/><use href="#s_flag" x="741" y="175"/><use href="#s_flag" x="1235" y="175"/><use href="#s_flag" x="1729" y="175"/><use href="#s_flag" x="2223" y="175"/></g><use href="#s9_flag" y="350"/></g><use href="#s18_flag" y="700"/><use href="#s9_flag" y="1400"/><use href="#s5_flag" y="1050"/><use href="#s_flag" x="247" y="1050"/><use href="#s_flag" x="741" y="1050"/><use href="#s_flag" x="1235" y="1050"/><use href="#s_flag" x="1729" y="1050"/><use href="#s_flag" x="2223" y="1050"/></g><rect y="300" width="7410" height="300" fill="#fff"/><rect y="900" width="7410" height="300" fill="#fff"/><rect y="1500" width="7410" height="300" fill="#fff"/><rect y="2100" width="7410" height="300" fill="#fff"/><rect y="2700" width="7410" height="300" fill="#fff"/><rect y="3300" width="7410" height="300" fill="#fff"/></svg>
                </a>
                <a href="{{ route('lang.switch', 'km') }}" class="lang-flag-btn {{ App::getLocale() === 'km' ? 'active' : '' }}" title="ភាសាខ្មែរ">
                    <svg class="flag-img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 16"><rect width="25" height="16" fill="#032a95"/><rect y="4" width="25" height="8" fill="#e11c27"/><g fill="#fff" transform="translate(10,5) scale(0.12)"><path d="M21 21v1h-1v-1h-1v-1h1V9l1-3 1 3v11h1v1h-1zm14 0v1h-1v-1h-1v-1h1V9l1-3 1 3v11h1v1h-1zM7 21v1H6v-1H5v-1h1V9l1-3 1 3v11h1v1H9z"/><path d="M1 21v1h40v-1H1zm5-7h30v1H6z"/></g></svg>
                </a>
            </div>

            <h3 class="welcome-title">{{ App::getLocale() === 'km' ? 'សូមស្វាគមន៍ត្រឡប់មកវិញ!' : 'Welcome Back!' }}</h3>
            <p class="welcome-subtitle">{{ App::getLocale() === 'km' ? 'សូមចូលប្រព័ន្ធដើម្បីគ្រប់គ្រងគ្លីនិក' : 'Sign in to access your clinic portal' }}</p>

            @if(count($errors))
                <div class="alert-custom">
                    @foreach($errors->all() as $error)
                        <strong>{{ $error }}</strong><br>
                    @endforeach
                </div>
            @endif

            <form role="form" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                
                <div class="form-group">
                    <label class="form-label">{{ App::getLocale() === 'km' ? 'ឈ្មោះអ្នកប្រើប្រាស់:' : 'Username:' }}</label>
                    <input class="form-control-custom" placeholder="{{ App::getLocale() === 'km' ? 'បញ្ចូលឈ្មោះអ្នកប្រើប្រាស់' : 'Enter username' }}" name="name" type="text" autofocus required>
                </div>

                <div class="form-group">
                    <label class="form-label">{{ App::getLocale() === 'km' ? 'ពាក្យសម្ងាត់:' : 'Password:' }}</label>
                    <input class="form-control-custom" placeholder="{{ App::getLocale() === 'km' ? 'បញ្ចូលពាក្យសម្ងាត់' : 'Enter password' }}" name="password" type="password" required>
                </div>

                <div class="form-options">
                    <label class="checkbox-label">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} class="checkbox-custom">
                        <span>{{ App::getLocale() === 'km' ? 'ចងចាំគណនីខ្ញុំ' : 'Remember Me' }}</span>
                    </label>
                </div>

                <button type="submit" class="login-btn">{{ App::getLocale() === 'km' ? 'ចូលប្រព័ន្ធ' : 'Sign In' }}</button>
            </form>
        </div>
    </div>

</body>
</html>
