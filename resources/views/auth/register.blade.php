<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Apartment management</title>
    <link href="{{ asset('apartmentcss.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    @stack('styles')
</head>

<body class="hold-transition">
    <section class="content-header background-color">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Welcome to Apartment Management System </h1>

                </div>
                <div class="col-sm-6 text-right">
                    <nav>
                        <a href="{{ route('landing') }}" class="btn btn-dark">Home</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <div class="log"
        style="background: url('{{ asset('assets/img/reg.jpeg') }}') no-repeat center center fixed;
             background-size: cover;">
        <div class="register-box">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <form action="{{ route('register.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <div class="input-group">
                                                <input type="text" name="name" class="form-control"
                                                    value="{{ old('name') }}">
                                            </div>
                                            @error('name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <div class="input-group">
                                                <input type="text" name="address" class="form-control"
                                                    value="{{ old('address') }}">
                                            </div>
                                            @error('address')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>NIC Number</label>
                                            <div class="input-group">
                                                <input type="text" name="nic" class="form-control"
                                                    value="{{ old('nic') }}">
                                            </div>
                                            @error('nic')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="nic_copy">NIC Copy</label>
                                            <div class="custom-file">
                                                <input type="file" name="nic_copy" class="custom-file-input"
                                                    id="customFile" accept="image/*" onchange="previewImage(this)">
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                            </div>
                                            @error('nic_copy')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 d-flex align-items-center justify-content-center">
                                        <img id="imagePreview" src="" style="max-width: 200px">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email Address</label>
                                            <div class="input-group">
                                                <input type="email" name="email" class="form-control"
                                                    value="{{ old('email') }}">
                                            </div>
                                            @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>



                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Contact Number</label>
                                            <div class="input-group">
                                                <input type="text" name="contact_number" class="form-control"
                                                    value="{{ old('contact_number') }}">
                                            </div>
                                            @error('contact_number')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <div class="input-group">
                                                <input type="password" name="password" class="form-control"
                                                    style="border-right: none;" id="password">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text pass" id="togglePassword"><i
                                                            class="fas fa-eye"></i></span>
                                                </div>
                                            </div>
                                            @error('password')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                            <div class="input-group">
                                                <input type="password" name="password_confirmation"
                                                    class="form-control" style="border-right: none;"
                                                    id="password_confirmation">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text pass"
                                                        id="togglePasswordConfirmation"><i
                                                            class="fas fa-eye"></i></span>
                                                </div>
                                            </div>
                                            @error('password_confirmation')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-success btn-block">Register</button>
                                    </div>
                                </div>
                                <a href="{{ route('login') }}" class="text-center font-weight">Existing user? Sign in
                                    here</a>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>


    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function(e) {

            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);

            this.querySelector('i').classList.toggle('fa-eye-slash');
        });

        const togglePasswordConfirmation = document.querySelector('#togglePasswordConfirmation');
        const passwordConfirmation = document.querySelector('#password_confirmation');

        togglePasswordConfirmation.addEventListener('click', function(e) {

            const type = passwordConfirmation.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordConfirmation.setAttribute('type', type);

            this.querySelector('i').classList.toggle('fa-eye-slash');
        });
    </script>

    <script>
        function previewImage(input) {
            var preview = document.getElementById('imagePreview');
            var file = input.files[0];
            var reader = new FileReader();

            reader.onloadend = function() {
                preview.src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = "";
            }
        }
    </script>
</body>

</html>
