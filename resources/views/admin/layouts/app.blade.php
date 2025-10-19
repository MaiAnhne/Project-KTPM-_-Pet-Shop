<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Dashboard') - Thú cưng</title>

    <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.ico') }}" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inria+Sans:wght@300;400;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}?v={{ time() }}">

    <style>
        body {
    background-color: #f19df129; 
    font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
    margin: 0;
    padding: 0;
    }

    h3, h1, h2 {
    color: #151819ff;
    text-shadow: 1px 1px 5px #000;
   }

    img:hover {
    border: 2px solid #f2eaeaff;
    border-radius: 10px;
    }
    </style>

    @stack('styles')
</head>
<body>
<div id="app">
    @yield('content')

    @php
        $placeholder = asset('assets/images/placeholder.png');
    @endphp

    <div class="container mt-5">
        <h3 class="mb-4 text-center">Hình ảnh sản phẩm</h3>
        <div class="row g-3">
            @foreach(range(1, 9) as $i)
                @php
                    $files = glob(storage_path("app/public/products/{$i}.*"));
                    if(count($files) > 0){
                        $filename = basename($files[0]);
                        $file = asset("storage/products/{$filename}");
                    } else {
                        $file = $placeholder;
                    }
                @endphp

                <div class="col-md-4 col-sm-6">
                    <img src="{{ $file }}" class="img-fluid rounded shadow-sm w-100" alt="Sản phẩm {{ $i }}">
                </div>
            @endforeach
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@includeWhen(View::exists('components.sweetalert'), 'components.sweetalert')
@stack('scripts')
</body>
</html>
