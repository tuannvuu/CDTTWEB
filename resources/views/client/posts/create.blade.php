<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đăng Tin - Chợ Tốt</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* === GLOBAL === */
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Roboto', Arial, sans-serif;
            background-color: #f5f5f5;
        }

        a {
            text-decoration: none;
        }

        /* === NAVBAR === */
        .navbar {
            background-color: #ffb800;
            display: flex;
            align-items: center;
            padding: 10px 20px;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .navbar-left,
        .navbar-right {
            display: flex;
            align-items: center;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: white;
            margin-right: 20px;
        }

        .menu {
            margin-right: 30px;
        }

        .menu a {
            margin-right: 15px;
            color: black;
            font-size: 14px;
            font-weight: 500;
        }

        .search-box {
            display: flex;
            align-items: center;
            background-color: white;
            border-radius: 5px;
            overflow: hidden;
            height: 35px;
            width: 400px;
        }

        .search-box input {
            border: none;
            outline: none;
            padding: 0 10px;
            flex: 1;
            font-size: 14px;
        }

        .search-box button {
            background-color: #f57f17;
            border: none;
            color: white;
            width: 40px;
            height: 100%;
            cursor: pointer;
        }

        .navbar-right .icon {
            margin-left: 15px;
            cursor: pointer;
            position: relative;
        }

        .navbar-right .icon.notification::after {
            content: "4";
            position: absolute;
            top: -5px;
            right: -7px;
            background: red;
            color: white;
            border-radius: 50%;
            font-size: 10px;
            width: 14px;
            height: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-info {
            display: flex;
            align-items: center;
            margin-left: 15px;
            cursor: pointer;
        }

        .user-initial {
            width: 25px;
            height: 25px;
            background: #4a3a39;
            color: white;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin-right: 5px;
        }

        .post-btn {
            margin-left: 15px;
            background-color: #ff6f00;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
        }

        .icon img {
            width: 18px;
            height: 18px;
        }

        /* === MAIN CONTENT === */
        .container {
            width: 80%;
            margin: 30px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .top-row {
            display: flex;
            flex-direction: column;
            margin-bottom: 15px;
        }

        .main-content {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 40px;
        }

        /* upload box */
        .upload-box {
            border: 1px dashed #ffb74d;
            background: #fffaf2;
            width: 240px;
            height: 240px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: #aaa;
            font-size: 13px;
            cursor: pointer;
        }

        .upload-box:hover {
            border-color: #ff9800;
        }

        .upload-box img {
            width: 40px;
            opacity: 0.6;
            margin-bottom: 10px;
        }

        .upload-box input {
            display: none;
        }

        /* right side */
        .right-side {
            flex: 1;
            text-align: center;
        }

        .category-btn {
            padding: 10px;
            border: 1px solid #ccc;
            width: 250px;
            cursor: pointer;
            text-align: left;
            border-radius: 4px;
            background: #fff;
            margin-bottom: 20px;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow-y: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fff;
            margin: 50px auto;
            padding: 20px;
            border-radius: 8px;
            width: 400px;
            max-height: 80vh;
            overflow-y: auto;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .modal-header h2 {
            margin: 0;
            font-size: 18px;
        }

        .close {
            font-size: 20px;
            font-weight: bold;
            cursor: pointer;
        }

        .category-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .category-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px;
            border-bottom: 1px solid #eee;
            cursor: pointer;
        }

        .category-item:hover {
            background: #f9f9f9;
        }

        .category-item span {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
        }

        .category-item i {
            font-size: 18px;
            width: 24px;
            text-align: center;
        }

        .illustration img {
            width: 350px;
            max-width: 100%;
        }

        .illustration p {
            margin: 10px 0 5px;
            font-weight: bold;
        }

        .illustration span {
            font-size: 14px;
            color: #666;
        }
    </style>
</head>

<body>


    <!-- ==== NAVBAR ==== -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand fw-bold text-warning" href="http://127.0.0.1:8000/">
                chợ<b class="text-dark">TỐT</b>
            </a>

            <!-- Nút toggle cho mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu -->
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="http://127.0.0.1:8000/">Chợ Tốt</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#">Nhà Tốt</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Chợ Tốt Xe</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Việc Làm Tốt</a></li>
                </ul>

                <!-- Ô tìm kiếm -->
                <form class="d-flex me-3">
                    <input class="form-control me-2" type="search" placeholder="Tìm kiếm sản phẩm trên Chợ Tốt">
                    <button class="btn btn-outline-warning" type="submit">🔍</button>
                </form>

                <!-- Icon -->
                <div class="d-flex align-items-center me-3">
                    <a href="#" class="me-3">
                        <img src="https://img.icons8.com/ios-filled/24/000000/bell.png" alt="Thông báo" />
                    </a>
                    <a href="#" class="me-3">
                        <img src="https://img.icons8.com/ios-filled/24/000000/speech-bubble--v1.png" alt="Tin nhắn" />
                    </a>
                    <a href="#" class="me-3">
                        <img src="https://img.icons8.com/ios-filled/24/000000/shopping-bag.png" alt="Giỏ hàng" />
                    </a>
                    <a href="#" class="me-3">
                        <img src="https://img.icons8.com/ios-filled/24/000000/table.png" alt="Quản lý tin" />
                    </a>
                </div>

                <!-- User -->
                <div class="dropdown me-3">
                    <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle"
                        id="dropdownUser" data-bs-toggle="dropdown">
                        <div class="bg-warning rounded-circle d-flex align-items-center justify-content-center me-2"
                            style="width:32px;height:32px;">
                            <span class="fw-bold">V</span>
                        </div>
                        <span>Vũ Tuấn</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                        <li><a class="dropdown-item" href="#">Trang cá nhân</a></li>
                        <li><a class="dropdown-item" href="#">Cài đặt</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Đăng xuất</a></li>
                    </ul>
                </div>

                <!-- Nút đăng tin -->
                <button class="btn btn-warning fw-bold">✎ ĐĂNG TIN</button>
            </div>
        </div>
    </nav>

    <!-- Bootstrap 5 JS + CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>




    <!-- ==== FORM ĐĂNG TIN ==== -->
    <div class="container">
        <div class="top-row">
            <h2>Hình ảnh và Video sản phẩm</h2>
            <p>Xem thêm về <a href="#" target="_blank">Quy định đăng tin của Chợ Tốt</a></p>
        </div>

        <div class="main-content">
            <!-- upload bên trái -->
            <label for="file-upload" class="upload-box">
                <img src="https://img.icons8.com/ios-filled/50/000000/camera.png" alt="Upload Icon" />
                Hình có kích thước tối thiểu 240x240
                <input type="file" id="file-upload" multiple>
            </label>

            <!-- chọn danh mục + minh họa bên phải -->
            <div class="right-side">
                <!-- button mở modal -->
                <button class="category-btn" id="openModal">Danh Mục Tin Đăng *</button>
                <input type="hidden" name="category" id="categoryInput">

                <div class="illustration">
                    <img src="https://cdn.chotot.com/upload/image/illustration-post.png" alt="Đăng tin nhanh">
                    <p>ĐĂNG NHANH - BÁN GỌN</p>
                    <span>Chọn “danh mục tin đăng” để đăng tin</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal danh mục -->
    <div id="categoryModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Chọn danh mục</h2>
                <span class="close" id="closeModal">&times;</span>
            </div>
            <ul class="category-list">
                @foreach ($categories as $item)
                    <li class="category-item" data-id="{{ $item->cateid }}">
                        <span><i class="fa-solid fa-circle"></i> {{ $item->catename }}</span>
                        <i class="fa-solid fa-chevron-right"></i>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <script>
        const modal = document.getElementById("categoryModal");
        const openBtn = document.getElementById("openModal");
        const closeBtn = document.getElementById("closeModal");
        const categoryBtn = document.querySelector(".category-btn");
        const categoryInput = document.getElementById("categoryInput");

        // mở modal
        openBtn.onclick = function() {
            modal.style.display = "block";
        }

        // đóng modal
        closeBtn.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        }

        // chọn category
        document.querySelectorAll(".category-item").forEach(item => {
            item.addEventListener("click", function() {
                const catName = this.innerText.trim();
                const catId = this.getAttribute("data-id");

                categoryBtn.textContent = catName;
                categoryInput.value = catId;
                modal.style.display = "none";
            });
        });
    </script>

</body>

</html>
