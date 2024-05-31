<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <title>Login</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="asset_backend/img/icon.ico" type="image/x-icon" />

    {{--  <!-- Fonts and icons -->  --}}
    <script src="asset_backend/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: ['../assets/css/fonts.min.css']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    {{--  <!-- CSS Files -->  --}}
    <link rel="stylesheet" href="asset_backend/css/bootstrap.min.css">
    <link rel="stylesheet" href="asset_backend/css/atlantis.css">
</head>

<body class="login">
    <div class="msg-data" data-msg="{{ Session::get('msg') }}" data-type="{{ Session::get('type') }}"></div>
    <div class="wrapper wrapper-login wrapper-login-full p-0">
        <div
            class="login-aside w-50 d-flex flex-column align-items-center justify-content-center text-center bg-secondary-gradient">
            <h1 class="title fw-bold text-white mb-3">SMK AL HASANAIN </h1>
            <p class="subtitle text-white op-7">Ayo bergabung dengan komunitas kami untuk masa depan yang lebih baik</p>

        </div>
        <div class="login-aside w-50 d-flex align-items-center justify-content-center bg-white">
            <div class="container container-login container-transparent animated fadeIn">
                <h3 class="text-center">Sign In To Admin</h3>
                <form action="{{ route('proseslogin') }}" method="POST">
                    @csrf
                    <div class="login-form">
                        <div class="form-group">
                            <label for="username" class="placeholder"><b>Username</b></label>
                            <input id="username" name="username" type="text"
                                class="form-control @error('username') is-invalid @enderror" required>
                            @error('username')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password" class="placeholder"><b>Password</b></label>
                            <a href="#" class="link float-right">Forget Password ?</a>
                            <div class="position-relative">
                                <input id="password" name="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" required>
                                @error('password')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                <div class="show-password">
                                    <i class="icon-eye"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tahun_ajaran">
                                <h5>Semester</h5>
                            </label>
                            <select class="custom-select" id="inputGroupSelect02" name="id_semester">
                                <option selected> --pilih Semester--
                                </option>
                                @foreach ($semester as $sm)
                                    <option value="{{ $sm->id_semester }}">
                                        Semester {{ $sm->nama_semester . '-->' . $sm->tahun_ajaran }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group form-action-d-flex mb-3">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="rememberme">
                                <label class="custom-control-label m-0" for="rememberme">Remember Me</label>
                            </div>
                            <!-- <button  class="btn btn-success login" > login</button> -->
                            <button id="login"
                                class="btn btn-secondary col-md-5 float-right mt-3 mt-sm-0 fw-bold  login">Sign
                                In</button>
                        </div>
                        <div class="login-account">
                            <span class="msg">Don't have an account yet ?</span>
                            <a href="#" id="show-signup" class="link">Sign Up</a>
                        </div>
                    </div>
            </div>
        </div>
        </form>
    </div>
    <script src="asset_backend/js/core/jquery.3.2.1.min.js"></script>
    <!-- sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script></script>
    <script src="asset_backend/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script src="asset_backend/js/core/popper.min.js"></script>
    <script src="asset_backend/js/alert-init.js"></script>
    <script src="asset_backend/js/core/bootstrap.min.js"></script>
    <script src="asset_backend/js/atlantis.min.js"></script>

</body>

</html>
