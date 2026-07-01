<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Log in') }} - {{ setting('site_name', 'First Trade') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            min-height: 100vh;
            background-color: {{ setting('login_background_color', '#F4F1EA') }};
            @if(setting('login_background_image'))
                background-image: url('{{ asset(setting('login_background_image')) }}');
                background-size: cover;
                background-position: center;
            @endif
        }

        .auth-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .auth-card {
            width: 100%;
            max-width: 430px;
            border-radius: 24px;
            padding: 34px;
            background: {{ setting('login_card_color', '#FFFFFF') }};
            opacity: {{ setting('login_card_opacity', '0.92') }};
            color: {{ setting('login_card_text_color', '#1F2937') }};
            box-shadow: 0 24px 70px rgba(15, 23, 42, .16);
            backdrop-filter: blur(10px);
        }

        .auth-logo {
            text-align: center;
            margin-bottom: 24px;
        }

        .auth-logo img {
            max-width: 145px;
            max-height: 110px;
            object-fit: contain;
        }

        .auth-submit {
            background: {{ setting('login_button_color', '#2F6E3B') }};
            color: {{ setting('login_button_text_color', '#FFFFFF') }};
            border: 0;
        }

        .auth-submit:hover {
            opacity: .92;
            color: {{ setting('login_button_text_color', '#FFFFFF') }};
        }
    </style>
</head>
<body>
<div class="auth-page">
    <div class="auth-card">
        <div class="auth-logo">
            @if(setting('site_logo'))
                <img src="{{ asset(setting('site_logo')) }}" alt="{{ setting('site_name', 'First Trade') }}">
            @else
                <h4 class="mb-0">{{ setting('site_name', 'First Trade') }}</h4>
            @endif
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">{{ __('Email') }}</label>
                <input class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">{{ __('Password') }}</label>
                <input class="form-control" type="password" name="password" required>
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="d-flex align-items-center justify-content-between mb-4">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="remember">
                    {{ __('Remember me') }}
                </label>

                @if (Route::has('password.request'))
                    <a class="small" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <button type="submit" class="btn auth-submit w-100">
                {{ __('Log in') }}
            </button>
        </form>
    </div>
</div>
</body>
</html>