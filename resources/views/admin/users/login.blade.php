<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng nhập hệ thống</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container mt-3 ">
        <form action="{{ route('ad.loginpost') }}" class="mx-auto shadow-lg p-4 w-50 bg-light" method="POST">
            @csrf
            <h2>Đăng nhập hệ thống</h2>
            {{-- hiển thị thông báo lỗi (nếu có) --}}
            {{-- component đã được tạo từ bài trước : resource/views/component/alert.blade.php --}}
            <x-alert></x-alert>
            <div class="mb-3 mt-3">
                {{-- Có thể đăng nhập theo username hoặc email --}}
                <label for="f-username">Email</label>
                <input type="text" class="form-control" id="f-username" placeholder="Nhập email" name="email"
                    value="{{ old('email') }}">
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="f-password">Mật khẩu</label>
                <input type="password" class="form-control" id="f-password" placeholder="Nhập mật khẩu" name="password">
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-check mb-3">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="remember"> Ghi nhớ đăng nhập
                </label>
            </div>
            <button type="submit" class="btn btn-primary w-100" id="loginBtn">
                <span id="btnText">Đăng nhập</span>
                <span id="btnSpinner" class="spinner-border spinner-border-sm d-none"></span>
            </button>


            @if (session('message'))
                <div class="text-danger mt-2">{{ session('message') }}</div>
            @endif
            <a href="{{ route('ad.create') }}">Đăng ký tài khoản</a>
            <a href="{{ route('ad.forgotpass') }}">Quên mật khẩu</a>

        </form>
    </div>
</body>

</html>
