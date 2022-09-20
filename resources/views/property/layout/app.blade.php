<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Psm Property</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{  asset('public/panel/assets/css/app.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/panel/assets/bundles/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/panel/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('public/panel/assets/bundles/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{  asset('public/panel/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{  asset('public/panel/assets/css/components.css') }}">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="{{  asset('public/panel/assets/css/custom.css') }}">
    <link rel='shortcut icon' type='image/x-icon' href='{{ asset('public/panel/assets/img/favicon.ico') }}'/>
    @livewireStyles
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            /* display: none; <- Crashes Chrome on hover */
            -webkit-appearance: none;
            margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
        }

        input[type=number] {
            -moz-appearance:textfield; /* Firefox */
        }
    </style>
</head>

<body>
<div class="loader"></div>
<div id="app">
    <div class="main-wrapper main-wrapper-1">
        @include('property.includes.header')
        @include('admin.includes.aside')
        @yield('content')
        @include('property.includes.footer')
    </div>
</div>
<!-- General JS Scripts -->
<script src="{{ asset('public/panel/assets/js/app.min.js') }}"></script>
<!-- JS Libraies -->
<script src="{{ asset('public/panel/assets/bundles/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('public/panel/assets/bundles/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('public/panel/assets/bundles/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('public/panel/assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/panel/assets/js/page/datatables.js') }}"></script>
<!-- Page Specific JS File -->
<script src="{{ asset('public/panel/assets/js/page/index.js') }}"></script>
<!-- Template JS File -->
<script src="{{ asset('public/panel/assets/js/scripts.js') }}"></script>
<!-- Custom JS File -->
<script src="{{ asset('public/panel/assets/js/custom.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/panel/assets/js/spartan-multi-image-picker.js') }}"></script>
@livewireScripts
<!-- Sweet Alert -->
@yield('script')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000,
        width: '27rem',
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })
        @if (Session()->has('message'))
    var type = "{{ Session::get('alert') }}";
    switch (type) {
        case'info':
            Toast.fire({
                icon: 'info',
                title: '{{ Session::get("message") }}'
            })
            break;
        case 'success':
            Toast.fire({
                icon: 'success',
                title: '{{ Session::get("message") }}'
            })
            break;
        case 'warning':
            Toast.fire({
                icon: 'warning',
                title: '{{ Session::get("message") }}'
            })
            break;
        case'error':
            Toast.fire({
                icon: 'error',
                title: '{{ Session::get("message") }}'
            })
            break;
    }
    @endif
    $(".custom-file-input").on("change", function () {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

</script>
<audio id="myAudio">
    <source src="{{asset('public/panel/assets/sound/notification.mp3')}}" type="audio/mpeg">
</audio>

<script>
    var audio = document.getElementById("myAudio");

    function playAudio() {
        audio.play();
    }

    function pauseAudio() {
        audio.pause();
    }
</script>
<script>
    $(document).ready(function () {
        $('#notification-mark-read').on('click', function () {
            $.ajax({
                url: "{{ url('property/notification/mark/read') }}",
                type: "GET",
                dataType: "json",
                success: function (data) {
                    console.log(data);
                    pauseAudio();
                },
            });
        });
        setInterval(function () {
            /*$("#signInButton").trigger('click');*/
            $.ajax({
                url: "{{ url('property/notification/latest') }}",
                type: "GET",
                dataType: "json",
                success: function (data) {
                    console.log(data)
                    if (data.length > 0) {
                        $('#notification-list').empty();
                        $.each(data, function (key, value) {
                            console.log(key, value.id)
                            /*playAudio();*/
                            $('#notification-list').append('<a href="#" class="dropdown-item"><span class="dropdown-item-icon bg-info text-white"> <i class="fas fa-bell"></i></span> <span class="dropdown-item-desc">' +
                                value.data + '<span class="time">' + value.created_at + '</span></span></a>');
                            /*Swal.fire('Any fool can use a computer')*/
                        });
                    } else {
                        pauseAudio();
                    }
                },
            });
        }, 5000);
    });
</script>
</body>

</html>
