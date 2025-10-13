<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FUTURE NET - CREATE ACCOUNT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="{{ asset('css/create.users.css') }}" rel="stylesheet" />
</head>

<body>
    <div class="particles" id="particles"></div>
    <div class="register-container">
        <div class="scan-line"></div>
        <div class="register-header">
            <div class="logo">FUTURE NET</div>
            <p class="tagline">CREATE ACCOUNT</p>
        </div>

        <div class="register-body">
            <!-- Thông báo flash message -->
            @if (session('success'))
                <div class="alert-custom alert-success-custom">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert-custom">{{ session('error') }}</div>
            @endif

            <form action="{{ route('ad.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="fullname" class="form-label">FULL NAME</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" class="form-control" id="fullname" name="fullname"
                            value="{{ old('fullname') }}" placeholder="ENTER FULL NAME">
                    </div>
                    @error('fullname')
                        <div class="text-danger mt-1"
                            style="color: #ff3e3e !important; text-shadow: 0 0 5px #ff3e3e; font-size: 0.8rem;">
                            {{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label">USERNAME</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-at"></i></span>
                        <input type="text" class="form-control" id="username" name="username"
                            value="{{ old('username') }}" placeholder="ENTER USERNAME">
                    </div>
                    @error('username')
                        <div class="text-danger mt-1"
                            style="color: #ff3e3e !important; text-shadow: 0 0 5px #ff3e3e; font-size: 0.8rem;">
                            {{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">EMAIL ADDRESS</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ old('email') }}" placeholder="ENTER EMAIL ADDRESS">
                    </div>
                    @error('email')
                        <div class="text-danger mt-1"
                            style="color: #ff3e3e !important; text-shadow: 0 0 5px #ff3e3e; font-size: 0.8rem;">
                            {{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">ACCESS CODE</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="ENTER ACCESS CODE">
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword"
                            style="border-color: rgba(10, 100, 255, 0.5); color: var(--neon-blue);">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="text-danger mt-1"
                            style="color: #ff3e3e !important; text-shadow: 0 0 5px #ff3e3e; font-size: 0.8rem;">
                            {{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">CONFIRM ACCESS CODE</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                        <input type="password" class="form-control" id="password_confirmation"
                            name="password_confirmation" placeholder="CONFIRM ACCESS CODE">
                        <button class="btn btn-outline-secondary" type="button" id="togglePasswordConfirmation"
                            style="border-color: rgba(10, 100, 255, 0.5); color: var(--neon-blue);">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="role" class="form-label">USER ROLE</label>
                    <select class="form-select" id="role" name="role">
                        <option value="1" {{ old('role') == '1' ? 'selected' : '' }}>ADMINISTRATOR</option>
                        <option value="3" {{ old('role') == '3' ? 'selected' : '' }}>CLIENT</option>
                    </select>
                    @error('role')
                        <div class="text-danger mt-1"
                            style="color: #ff3e3e !important; text-shadow: 0 0 5px #ff3e3e; font-size: 0.8rem;">
                            {{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-register" id="registerBtn">
                    <span id="btnText">CREATE ACCOUNT</span>
                    <span id="btnSpinner" class="spinner-border spinner-border-sm d-none"></span>
                </button>
            </form>

            <div class="register-footer">
                <a href="{{ route('ad.login') }}">ALREADY HAVE AN ACCOUNT? LOGIN</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Tạo hiệu ứng particles
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

        // Hiển thị/ẩn mật khẩu
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
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

        // Hiển thị/ẩn xác nhận mật khẩu
        document.getElementById('togglePasswordConfirmation').addEventListener('click', function() {
            const passwordInput = document.getElementById('password_confirmation');
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

        // Xử lý hiển thị spinner khi submit form
        document.querySelector('form').addEventListener('submit', function() {
            document.getElementById('btnText').classList.add('d-none');
            document.getElementById('btnSpinner').classList.remove('d-none');
            document.getElementById('registerBtn').disabled = true;
        });

        // Khởi tạo particles khi trang tải xong
        document.addEventListener('DOMContentLoaded', createParticles);
    </script>
</body>

</html>
