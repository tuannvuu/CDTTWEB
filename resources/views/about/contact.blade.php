@extends('layouts.app')

@section('title', 'Liên hệ ' . $contactInfo['company'])

@section('content')
    <div class="container py-5">
        <h1 class="mb-4 text-primary">Liên hệ {{ $contactInfo['company'] }}</h1>

        <div class="row mb-5">
            <div class="col-md-6">
                <h4>Thông tin liên hệ</h4>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Địa chỉ:</strong> {{ $contactInfo['address'] }}</li>
                    <li class="list-group-item"><strong>Điện thoại:</strong> {{ $contactInfo['phone'] }}</li>
                    <li class="list-group-item"><strong>Email:</strong> <a
                            href="mailto:{{ $contactInfo['email'] }}">{{ $contactInfo['email'] }}</a></li>
                    <li class="list-group-item"><strong>Website:</strong> <a href="{{ $contactInfo['website'] }}"
                            target="_blank">{{ $contactInfo['website'] }}</a></li>
                </ul>

                <h5 class="mt-4">Giờ làm việc</h5>
                <ul class="list-unstyled">
                    <li><strong>Thứ 2 - Thứ 6:</strong> {{ $contactInfo['working_hours']['monday_friday'] }}</li>
                    <li><strong>Thứ 7:</strong> {{ $contactInfo['working_hours']['saturday'] }}</li>
                    <li><strong>Chủ nhật:</strong> {{ $contactInfo['working_hours']['sunday'] }}</li>
                </ul>

                <h5 class="mt-4">Mạng xã hội</h5>
                <p>
                    <a href="{{ $contactInfo['social_media']['facebook'] }}" target="_blank" class="me-3"><i
                            class="bi bi-facebook fs-3"></i></a>
                    <a href="{{ $contactInfo['social_media']['instagram'] }}" target="_blank" class="me-3"><i
                            class="bi bi-instagram fs-3"></i></a>
                    <a href="{{ $contactInfo['social_media']['youtube'] }}" target="_blank" class="me-3"><i
                            class="bi bi-youtube fs-3"></i></a>
                    <a href="{{ $contactInfo['social_media']['tiktok'] }}" target="_blank"><i
                            class="bi bi-tiktok fs-3"></i></a>
                </p>
            </div>

            <div class="col-md-6">
                <h4>Bản đồ</h4>
                <div class="ratio ratio-16x9">
                    <iframe
                        src="https://maps.google.com/maps?q={{ $contactInfo['map_coordinates']['lat'] }},{{ $contactInfo['map_coordinates']['lng'] }}&hl=vi&z=14&output=embed"
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>

        <h3 class="mb-4">Văn phòng chi nhánh</h3>
        <div class="row">
            @foreach ($offices as $office)
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $office['name'] }}</h5>
                            <p><strong>Địa chỉ:</strong> {{ $office['address'] }}</p>
                            <p><strong>Điện thoại:</strong> {{ $office['phone'] }}</p>
                            <span class="badge bg-secondary">{{ $office['type'] }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
