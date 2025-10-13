<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đăng Tin - Chợ Tốt</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/posts.css') }}">

<body>
    <!-- ==== NAVBAR ==== -->
    <nav class="navbar">
        <div class="navbar-left">
            <a href="http://127.0.0.1:8000/" class="logo">chợ<b>TỐT</b></a>
        </div>

        <button class="post-btn">
            <i class="fas fa-pen"></i> ĐĂNG TIN
        </button>
    </nav>

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
                <div>Thêm hình ảnh/video</div>
                <div style="font-size: 12px; margin-top: 8px;">Hình có kích thước tối thiểu 240x240</div>
            </label>

            <!-- chọn danh mục + minh họa bên phải -->
            <div class="right-side">
                <!-- button mở modal -->
                <button class="category-btn" id="openModal">Danh Mục Tin Đăng *</button>
                <input type="hidden" name="category" id="categoryInput">

                <div class="illustration">
                    <img src="https://cdn.chotot.com/upload/image/illustration-post.png" alt="Đăng tin nhanh">
                    <p>ĐĂNG NHANH - BÁN GỌN</p>
                    <span>Chọn "danh mục tin đăng" để đăng tin</span>
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
        document.addEventListener('DOMContentLoaded', function() {
            // Xử lý modal danh mục
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
                    const catName = this.querySelector('span').innerText.trim();
                    const catId = this.getAttribute("data-id");

                    categoryBtn.textContent = catName;
                    categoryInput.value = catId;
                    modal.style.display = "none";
                });
            });

            // Xử lý upload ảnh
            const fileUpload = document.getElementById('file-upload');
            fileUpload.addEventListener('change', function(e) {
                if (e.target.files.length > 0) {
                    // Xử lý hiển thị preview ảnh ở đây
                    console.log(`${e.target.files.length} file(s) đã được chọn`);
                }
            });
        });
    </script>

</body>

</html>
