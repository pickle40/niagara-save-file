<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Niagara File</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconfonts/ionicons/css/ionicons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconfonts/typicons/src/font/typicons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.addons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/shared/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/demo_1/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('icons/favicon.png') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('plugins/css/select2.min.css') }}">

    @yield('css')
    <!-- End-CSS -->

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}

  <style>
  </style>

</head>

<body>

    <div class="container-scroller" id="app">

        <!-- TopNav -->
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
                <a class="navbar-brand brand-logo" href="{{ url('/dashboard') }}">
                    <h2 class="mt-2" style="letter-spacing:0.1em">NIAGARA</h2>
                </a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center">
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- End-TopNav -->

        <div class="container-fluid page-body-wrapper">
            <!-- SideNav -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                {{-- <!-- <h5 class="navbar-brand">Welcome, {{ Auth::user()->nama_depan }}</h5>   --> --}}
                <div class="navbar-brand"
                    style="margin-right:0;border-top:0.5px solid rgb(212,212,212,0.3);border-bottom:0.5px solid rgb(212,212,212,0.3)">
                    <div class="row" style="color:white;margin:auto">
                        <div class="col-12 mt-1">
                            {{-- <h6 style="margin-left:20px">{{ Auth::user()->nama_depan }} --}}
                            <!-- <h5 style="margin-left:20px"> Raisa Saraswati</h5> -->
                        </div>
                        <div class="col-12 ">
                            {{-- <p style="color:#d4d4d4;margin-left:20px;margin-bottom:0">{{ Auth::user()->posisi }}</p> --}}
                        </div>
                    </div>
                </div>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/dashboard') }}">
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#save-file" aria-expanded="false"
                            aria-controls="save-file">
                            <span class="menu-title">Save File</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="save-file">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/save-file')}}">Save File</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/save-file-history-input')}}">History Log Add File</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/save-file-history-delete')}}">History Log Delete File</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#save-file-gambar" aria-expanded="false"
                            aria-controls="save-file-gambar">
                            <span class="menu-title">Save File Gambar</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="save-file">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/save-file-gambar')}}">Save File Gambar</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/save-file-gambar-history-input')}}">History Log Add File Gambar</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/save-file-gambar-history-delete')}}">History Log Delete File Gambar</a>
                                </li>
                            </ul>
                        </div>
                    </li>

            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-danger" type="submit">Logout</button>
                </form>
            </li>
    </ul>


    </nav>
    <!-- End-SideNav -->

    <div class="main-panel">
        <div class="content-wrapper" id="content-web-page">
            @yield('content')
        </div>
        <div class="content-wrapper" id="content-web-search" hidden="">
            <div class="row">
                <div class="col-12 text-left">
                    <h3 class="d-block">Cari Halaman</h3>
                    <h5 class="mt-3 d-block"><span class="result-1"></span> <span class="result-2"></span></h5>
                </div>
                <div class="col-12 mt-3">
                    <div class="row" id="page-result-parent">
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer" id="footer-content">
            {{-- <div class="container-fluid clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2019 <a
                href="http://www.bootstrapdash.com/" target="_blank">Bootstrapdash</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i
                class="mdi mdi-heart text-danger"></i>
            </span>
          </div> --}}
        </footer>
    </div>
    </div>
    </div>

    <!-- Javascript -->
    <!-- <script src="{{ asset('js/app.js') }}"></script> -->
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assets/vendors/js/vendor.bundle.addons.js') }}"></script>
    <script src="{{ asset('assets/js/shared/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/shared/misc.js') }}"></script>
    <script src="{{ asset('plugins/js/jquery.form-validator.min.js') }}"></script>
    <script src="{{ asset('plugins/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('plugins/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/templates/script.js') }}"></script>
    <script src="{{ asset('plugins/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('plugins/js/select2.min.js') }}"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#UserDropdown').dropdown()
        $('#notificationDropdown').dropdown()
    });
    $(document).on('input', 'input[name=search_page]', function() {
        if ($(this).val() != '') {
            $('#content-web-page').prop('hidden', true);
            $('#content-web-search').prop('hidden', false);
            var search_word = $(this).val();
            $.ajax({
                url: "{{ url('/search') }}/" + search_word,
                method: "GET",
                success: function(response) {
                    $('.result-1').html(response.length + ' Hasil Pencarian');
                    $('.result-2').html('dari "' + search_word + '"');
                    var lengthLoop = response.length - 1;
                    var searchResultList = '';
                    for (var i = 0; i <= lengthLoop; i++) {
                        var page_url = "{{ url('/', ':id') }}";
                        page_url = page_url.replace('%3Aid', response[i].page_url);
                        searchResultList += '<a href="' + page_url +
                            '" class="page-result-child mb-4 w-100"><div class="col-12"><div class="card card-noborder b-radius"><div class="card-body"><div class="row"><div class="col-12"><h5 class="d-block page_url">' +
                            response[i].page_name +
                            '</h5><p class="align-items-center d-flex justify-content-start"><span class="icon-in-search mr-2"><i class="mdi mdi-chevron-double-right"></i></span> <span class="breadcrumbs-search page_url">' +
                            response[i].page_title +
                            '</span></p><div class="search-description"><p class="m-0 p-0 page_url">' +
                            response[i].page_content.substring(0, 500) +
                            '...</p></div></div></div></div></div></div></a>';
                    }
                    $('#page-result-parent').html(searchResultList);
                    $('.page_url:contains("' + search_word + '")').each(function() {
                        var regex = new RegExp(search_word, 'gi');
                        $(this).html($(this).text().replace(regex,
                            '<span style="background-color: #607df3;">' +
                            search_word + '</span>'));
                    });
                }
            });
        } else {
            $('#content-web-page').prop('hidden', false);
            $('#content-web-search').prop('hidden', true);
        }
    });
    </script>
    @yield('script')
    <!-- End-Javascript -->
</body>

</html>