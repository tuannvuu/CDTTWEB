<button class="btn btn-menu-cate me-2" type="button" data-bs-toggle="dropdown" aria-expanded="false"
    id="categoryDropdown">
    <i class="bi bi-list" style="font-size:2rem;"></i>
</button>

<ul class="dropdown-menu custom-category-dropdown" aria-labelledby="categoryDropdown">
    @foreach ($categories as $item)
        <li>
            <a class="dropdown-item d-flex align-items-center" href="{{ route('category', ['id' => $item->cateid]) }}">
                <img src="{{ asset('storage/categories/' . $item->image) }}"
                     alt="{{ $item->catename }}"
                     class="category-icon img-fluid"
                     style="max-height:70px; object-fit:contain;">
                <span class="ms-2 category-name">{{ $item->catename }}</span>
            </a>
        </li>
    @endforeach
</ul>
