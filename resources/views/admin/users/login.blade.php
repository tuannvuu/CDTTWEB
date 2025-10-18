<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FUTURE NET - TRUY CẬP KỶ NGUYÊN SỐ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet" />
</head>

<body>
    <div class="particles" id="particles"></div>
    <div class="login-container">
        <div class="scan-line"></div>
        <div class="login-header">
            <div class="logo">FUTURE NET</div>
            <p class="tagline">TRUY CẬP KỶ NGUYÊN SỐ</p>
        </div>

        <div class="login-body">
            <!-- Hiển thị thông báo lỗi (nếu có) -->
            <x-alert></x-alert>

            <form action="{{ route('ad.loginpost') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="f-username" class="form-label">ĐỊA CHỈ EMAIL</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="text" class="form-control" id="f-username" placeholder="NHẬP ĐỊA CHỈ EMAIL"
                            name="email" value="{{ old('email') }}">
                    </div>
                    @error('email')
                        <div class="text-danger mt-1" style="color: #ff3e3e !important; text-shadow: 0 0 5px #ff3e3e;">
                            {{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="f-password" class="form-label">MẬT KHẨU</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                        <input type="password" class="form-control" id="f-password" placeholder="NHẬP MẬT KHẨU"
                            name="password">
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword"
                            style="border-color: rgba(10, 100, 255, 0.5); color: var(--neon-blue);">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="text-danger mt-1" style="color: #ff3e3e !important; text-shadow: 0 0 5px #ff3e3e;">
                            {{ $message }}</div>
                    @enderror
                </div>

                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" id="remember" name="remember">
                    <label class="form-check-label" for="remember">GHI NHỚ MẬT KHẨU</label>
                </div>

                <button type="submit" class="btn btn-login" id="loginBtn">
                    <span id="btnText">ĐĂNG NHẬP</span>
                    <span id="btnSpinner" class="spinner-border spinner-border-sm d-none"></span>
                </button>

                {{-- Hiển thị thông báo thành công --}}
                @if (session('success'))
                    <div class="alert alert-success mt-3"
                        style="background: rgba(30, 255, 30, 0.2); border: 1px solid rgba(30, 255, 30, 0.5); color: #00ff00; text-shadow: 0 0 5px #00ff00;">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Hiển thị thông báo lỗi --}}
                @if (session('error'))
                    <div class="alert alert-danger mt-3"
                        style="background: rgba(255, 30, 30, 0.2); border: 1px solid rgba(255, 30, 30, 0.5); color: #ff3e3e; text-shadow: 0 0 5px #ff3e3e;">
                        {{ session('error') }}
                    </div>
                @endif

            </form>

            <div class="login-footer">
                <a href="{{ route('ad.create') }}">TẠO TÀI KHOẢN</a>
                <a href="{{ route('ad.forgotpass') }}">QUÊN MẬT KHẨU</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Tạo hiệu ứng hạt bay (particles)
        function createParticles() {
            const particlesContainer = document.getElementById('particles');
            const particleCount = 30;

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');

                // Kích thước ngẫu nhiên
                const size = Math.random() * 3 + 1;
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;

                // Vị trí ngẫu nhiên
                particle.style.left = `${Math.random() * 100}%`;

                // Thời gian animation ngẫu nhiên
                const duration = Math.random() * 20 + 10;
                const delay = Math.random() * 10;
                particle.style.animationDuration = `${duration}s`;
                particle.style.animationDelay = `${delay}s`;

                particlesContainer.appendChild(particle);
            }
        }

        // Hiển thị / ẩn mật khẩu
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('f-password');
            const icon = this.querySelector('i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });

        // Hiển thị spinner khi submit form
        document.querySelector('form').addEventListener('submit', function() {
            document.getElementById('btnText').classList.add('d-none');
            document.getElementById('btnSpinner').classList.remove('d-none');
            document.getElementById('loginBtn').disabled = true;
        });

        // Khởi tạo hiệu ứng khi tải trang
        document.addEventListener('DOMContentLoaded', createParticles);
    </script>
</body>

</html>
