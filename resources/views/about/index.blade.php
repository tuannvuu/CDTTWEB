@extends('layout.app')

@section('title', 'Giới thiệu về ' . $companyData['name'])

@section('content')
    <div class="container py-5">

        <h1 class="mb-4 text-primary fw-bold">Về {{ $companyData['name'] }}</h1>
        <p class="lead text-secondary">{{ $companyData['description'] }}</p>

        <div class="row my-5">
            <div class="col-md-6">
                <h3 class="mb-3">Thông tin công ty</h3>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Thành lập:</strong> {{ $companyData['founded'] }}</li>
                    <li class="list-group-item"><strong>Nhân viên:</strong> {{ $companyData['employees'] }} người</li>
                    <li class="list-group-item"><strong>Khách hàng:</strong> {{ number_format($companyData['customers']) }}
                    </li>
                    <li class="list-group-item"><strong>Sản phẩm:</strong> {{ number_format($companyData['products']) }}
                    </li>
                    <li class="list-group-item"><strong>Tỷ lệ hài lòng:</strong> {{ $companyData['satisfaction'] }}%</li>
                </ul>
            </div>

            <div class="col-md-6">
                <h3 class="mb-3">Sứ mệnh & Tầm nhìn</h3>
                <div class="mb-3">
                    <h5>Sứ mệnh</h5>
                    <p>{{ $companyData['mission'] }}</p>
                </div>
                <div>
                    <h5>Tầm nhìn</h5>
                    <p>{{ $companyData['vision'] }}</p>
                </div>
            </div>
        </div>

        <hr>

        <h2 class="my-5 text-center text-primary">Thống kê nổi bật</h2>
        <div class="row text-center">
            @foreach ($stats as $stat)
                <div class="col-6 col-md-3 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <i class="bi {{ $stat['icon'] }} text-{{ $stat['color'] }}" style="font-size: 2.5rem;"></i>
                            <h3 class="my-2 text-{{ $stat['color'] }}">{{ $stat['number'] }}</h3>
                            <p class="mb-0">{{ $stat['label'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <hr>

        <h2 class="my-5 text-center text-primary">Giá trị cốt lõi của chúng tôi</h2>
        <div class="row">
            @foreach ($values as $value)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <i class="bi {{ $value['icon'] }} text-primary mb-3" style="font-size: 2rem;"></i>
                            <h5 class="card-title">{{ $value['title'] }}</h5>
                            <p class="card-text text-secondary">{{ $value['description'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection
