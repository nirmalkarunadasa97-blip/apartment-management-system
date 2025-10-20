<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CEYLON FLAT</title>
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    @stack('styles')

    <script src="https://js.stripe.com/v3/"></script>
</head>

<body class="hold-transition">
    <!-- Display Success or Error Message -->
    @if (session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div style="color: red;">{{ session('error') }}</div>
    @endif
    <div class="d-flex flex-column justify-content-center align-items-center vh-100 bg-light"
        style="background: url('{{ asset('assets/img/reg.jpeg') }}') no-repeat center center fixed;
             background-size: cover;">
        <div class="register-box container" style="width: 100% !important">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-success">
                        <div class="card-body">
                            <form id="payment-form" action="{{ route('payment.process') }}" method="POST">

                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <input type="hidden" name="lease_application_id"
                                            value="{{ $apartmentApplicationId }}">

                                        <input type="hidden" name="apartment_id" value="{{ $apartmentId }}">
                                        <input type="hidden" name="resident_id" value="{{ $residentId }}">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="amount">Amount</label>
                                                <input type="number" name="amount" class="form-control" id="amount"
                                                    placeholder="Amount" value="{{ old('amount') }}">
                                                @error('amount')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Payment Type</label>
                                                <select name="payment_type_id" id="payment_type_id"
                                                    class="form-control">

                                                    <option value="">Select</option>
                                                    @foreach ($paymentTypes as $item)
                                                        <option
                                                            {{ old('payment_type_id') == $item->payment_type_id ? 'selected' : '' }}
                                                            value="{{ $item->payment_type_id }}">
                                                            {{ $item->type }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('payment_type_id')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror

                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="card-element">Credit or Debit Card</label>
                                                <div id="card-element">
                                                    <!-- Stripe Elements will create card input fields here -->
                                                </div>
                                                <div id="card-errors" role="alert" style="color: red;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('apartment_payment.index') }}" class="btn btn-dark">Back</a>
                                    <button type="submit" class="btn btn-dark">Pay Now</button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Initialize Stripe
        var stripe = Stripe("{{ config('services.stripe.key') }}");
        var elements = stripe.elements();

        // Create Card Element
        var card = elements.create('card');
        card.mount('#card-element');

        // Handle Form Submission
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Display Error
                    document.getElementById('card-errors').textContent = result.error.message;
                } else {
                    // Send Token to Server
                    stripeTokenHandler(result.token);
                }
            });
        });

        // Handle Token Submission
        function stripeTokenHandler(token) {
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Submit Form
            form.submit();
        }
    </script>
</body>

</html>
