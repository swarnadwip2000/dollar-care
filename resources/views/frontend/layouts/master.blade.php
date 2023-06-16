<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="Swarnadwip Nath" />
    <meta name="generator" content="Hugo 0.84.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @yield('meta')
    <title{{ env('APP_NAME') }} | @yield('title')</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
        <!-- Font -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
            rel="stylesheet" />
        <link rel="shortcut icon" type="image/png" href="{{ asset('admin_assets/img/favicon.ico') }}">
        <!-- Bootstrap core CSS -->
        <link href="{{ asset('frontend_assets/css/bootstrap.min.css') }}" rel="stylesheet" />
        <link rel="stylesheet" type="text/css"
            href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" />
        <link rel="stylesheet" type="text/css"
            href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css" />
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
        <link href="{{ asset('frontend_assets/css/menu.css') }}" rel="stylesheet" />
        <link href="{{ asset('frontend_assets/css/style.css') }}" rel="stylesheet" />
        <link href="{{ asset('frontend_assets/css/responsive.css') }}" rel="stylesheet" />
        <!-- Custom styles for this template -->
        <link rel="stylesheet" type="text/css"
            href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
        @stack('styles')
</head>

<body>
    <main>
        @include('frontend.includes.header')
        @yield('content')
        @include('frontend.includes.footer')
    </main>
    <!-- Scroll top -->
    {{-- <a href="#top-btn" alt="Top" title="Back to top" id="scrl">
        <div class="scroll_btm">
            <div class="scroll_btm_btn">
                <div class="scroll_text">
                    <h3>SCROLL up</h3>
                </div>
            </div>
        </div>
    </a> --}}
    <div class="float-btn">
        <a href=""><span><i class="fa-regular fa-comment"></i></span>Chat With Us</a>
     </div>
    <!-- Modal -->
    <div class="modal_1">
        <div class="mn-btn">
            <a href="#"><span>Ask a Question</span></a>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script src="{{ asset('frontend_assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="{{ asset('frontend_assets/js/custom.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>

    <script>
        @if (Session::has('message'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("{{ session('message') }}");
        @endif

        @if (Session::has('error'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("{{ session('error') }}");
        @endif

        @if (Session::has('info'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.info("{{ session('info') }}");
        @endif

        @if (Session::has('warning'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.warning("{{ session('warning') }}");
        @endif
    </script>
    <script>
        $(document).ready(function() {
            toastr.options = {
                // 'closeButton': true,
                // 'debug': false,
                // 'newestOnTop': false,
                // 'progressBar': false,
                'positionClass': 'toast-top-center',
                // 'preventDuplicates': false,
                'showDuration': '10',
                'hideDuration': '10',
                'timeOut': '800',
                'extendedTimeOut': '800',
                // 'showEasing': 'swing',
                // 'hideEasing': 'linear',
                // 'showMethod': 'fadeIn',
                // 'hideMethod': 'fadeOut',
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#form-submit').on('click', function() {
                var name = $('#name').val();
                var email = $('#email').val();
                var message = $('#message').val();
                var url = "{{ route('newsletter') }}";
                if (name == '') {
                    $('#name_msg').text('Name is required');
                    return false;
                }
                if (email == '') {
                    $('#email_msg').text('Email is required');
                    return false;
                }
                if (message == '') {
                    $('#message_msg').text('Message is required');
                    return false;
                }
                // alert(url);
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'name': name,
                        'email': email,
                        'message': message,
                    },
                    success: function(data) {
                        if (data.success == true) {
                            $('#name_msg').text(' ');
                            $('#email_msg').text(' ');
                            $('#message_msg').text(' ');
                            $('#name').val('');
                            $('#email').val('');
                            $('#message').val('');
                            toastr.success(data.message);
                        } else {
                            toastr.error(data.error);
                        }
                    }
                });
            });
        });
    </script>
    @stack('scripts')
</body>

</html>
