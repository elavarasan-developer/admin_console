<!doctype html>
<html
    lang="en"
    class="layout-wide customizer-hide"
    data-assets-path="../assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Register | Admin Console</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/assets/img/favicon/favicon.ico')}}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('assets/assets/vendor/fonts/iconify-icons.css')}}" />

    <!-- Core CSS -->
    <!-- build:css assets/vendor/css/theme.css  -->

    <link rel="stylesheet" href="{{ asset('assets/assets/vendor/css/core.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/assets/css/demo.css')}}" />

    <!-- Vendors CSS -->

    <link rel="stylesheet" href="{{ asset('assets/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />

    <!-- endbuild -->

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/assets/vendor/css/pages/page-auth.css')}}" />

    <!-- Helpers -->
    <script src="{{ asset('assets/assets/vendor/js/helpers.js')}}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->

    <script src="{{ asset('assets/assets/js/config.js')}}"></script>
</head>

<body>
    <!-- Content -->

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register Card -->
                <div class="card px-sm-6 px-0">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center mb-6">
                            <a href="index.html" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                    <span class="text-primary">
                                        Logo
                                    </span>
                                </span>
                                <span class="app-brand-text demo text-heading fw-bold">Sneat</span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <!-- <h4 class="mb-1">Adventure starts here 🚀</h4> -->
                        <h4 class="mb-1">Register 🚀</h4>
                        <p class="mb-6">Make your app management easy and fun!</p>

                        <form id="formAuthentication" class="mb-6">
                            <div class="mb-6">
                                <label for="username" class="form-label">Username</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="username"
                                    name="username"
                                    placeholder="Enter your username"
                                    autofocus />
                            </div>
                            <div class="mb-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" />
                            </div>
                            <div class="form-password-toggle">
                                <label class="form-label" for="password">Password</label>
                                <div class="input-group input-group-merge">
                                    <input
                                        type="password"
                                        id="password"
                                        class="form-control"
                                        name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="icon-base bx bx-hide"></i></span>
                                </div>
                            </div>
                            <div class="my-2">
                                <div class="form-check mb-0">
                                    <!-- <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" />
                                    <label class="form-check-label" for="terms-conditions">
                                        I agree to
                                        <a href="javascript:void(0);">privacy policy & terms</a>
                                    </label> -->
                                </div>
                            </div>
                            <button class="btn btn-primary d-grid w-100">Sign up</button>
                        </form>

                        <p class="text-center">
                            <span>Already have an account?</span>
                            <a href="auth-login-basic.html">
                                <span>Sign in instead</span>
                            </a>
                        </p>
                    </div>
                </div>
                <!-- Register Card -->
            </div>
        </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->

    <!-- Place this after your form or in a separate JS file -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#formAuthentication').on('submit', function(e) {
            e.preventDefault();

            let form = $(this);
            let formData = {
                name: $('#username').val(),
                email: $('#email').val(),
                password: $('#password').val(),
                password_confirmation: $('#password').val(), // confirm with same value
                device_name: 'web' // optional, useful for token naming
            };

            $.ajax({
                url: '/api/register',
                type: 'POST',
                data: formData,
                success: function(response) {
                    console.log('Registration successful:', response);

                    // Store token in localStorage
                    localStorage.setItem('auth_token', response.token);
                    alert('Registration successful!');

                    // Redirect or update UI
                    window.location.href = '/dashboard'; // or wherever
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        let errorMsg = '';
                        for (const key in errors) {
                            errorMsg += `${errors[key][0]}\n`;
                        }
                        alert(errorMsg);
                    } else {
                        alert('Registration failed. Please try again.');
                    }
                    console.error(xhr.responseText);
                }
            });
        });
    </script>


    <script src="{{ asset('assets/assets/vendor/libs/jquery/jquery.js')}}"></script>

    <script src="{{ asset('assets/assets/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{ asset('assets/assets/vendor/js/bootstrap.js')}}"></script>

    <script src="{{ asset('assets/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

    <script src="{{ asset('assets/assets/vendor/js/menu.js')}}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->

    <script src="{{ asset('assets/assets/js/main.js')}}"></script>

    <!-- Page JS -->

    <!-- Place this tag before closing body tag for github widget button. -->
    <script async defer src="https://buttons.github.io/buttons.js')}}"></script>
</body>

</html>