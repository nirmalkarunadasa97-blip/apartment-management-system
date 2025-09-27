@extends('layer.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Change Password</h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-warning">

                            <form method="POST"
                                action="{{ route('change_password.update', ['change_password' => $data->id]) }}">
                                @csrf
                                @method('PUT')
                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Current Password</label>
                                                <div class="input-group">

                                                    <input type="password" name="current_password" class="form-control"
                                                        style="border-right: none;" id="current_password">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text pass" id="toggleCurrentPassword"><i
                                                                class="fas fa-eye"></i></span>
                                                    </div>
                                                </div>
                                                @error('current_password')
                                                    <small class="text-danger"> {{ $message }} </small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-8">
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
                                                    <small class="text-danger"> {{ $message }} </small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Confirm Password</label>
                                                <div class="input-group">

                                                    <input type="password" name="password_confirmation" class="form-control"
                                                        style="border-right: none;" id="password_confirmation">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text pass"
                                                            id="togglePasswordConfirmation"><i
                                                                class="fas fa-eye"></i></span>
                                                    </div>
                                                </div>
                                                @error('password_confirmation')
                                                    <small class="text-danger"> {{ $message }} </small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-dark w-100">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        const toggleCurrentPassword = document.querySelector('#toggleCurrentPassword');
        const Currentpassword = document.querySelector('#current_password');

        toggleCurrentPassword.addEventListener('click', function(e) {

            const type = Currentpassword.getAttribute('type') === 'password' ? 'text' : 'password';
            Currentpassword.setAttribute('type', type);

            this.querySelector('i').classList.toggle('fa-eye-slash');
        });


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
@endsection
