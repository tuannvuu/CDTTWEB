    <button class="btn btn-menu-cate me-2" type="button" data-bs-toggle="dropdown" aria-expanded="false"
        id="categoryDropdown">
        <i class="bi bi-list" style="font-size:2rem;"></i>
    </button>
    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
        {{-- đọc biến $categories (trong component) --}}
        @foreach ($categories as $item)
            <li><a class="dropdown-item"
                    href="{{ route('category', ['id' => $item->cateid]) }}">{{ $item->catename }}</a>
            </li>
        @endforeach
    </ul>
