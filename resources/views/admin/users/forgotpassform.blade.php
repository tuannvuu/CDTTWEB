<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quên mật khẩu</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container mt-3 ">
        <form action="{{ route('ad.forgotpasspost') }}" method="POST"
            class="mx-auto shadow-lg p-4 w-50 bg-light rounded">
            @csrf
            <h2 class="mb-4 text-center">Quên mật khẩu</h2>
            <x-alert></x-alert>
            {{-- Hiển thị thông báo lỗi --}}
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="mb-3">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control"
                    placeholder="Nhập email đăng ký" value="{{ old('email') }}" required>
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100">Tiếp tục</button>

            <div class="text-end mt-2">
                <a href="{{ route('ad.login') }}">Quay lại đăng nhập</a>
            </div>
        </form>
    </div>
</body>

</html>
