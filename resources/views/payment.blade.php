<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('payment.title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .payment-container {
            margin-top: 50px;
            max-width: 500px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .payment-container h1 {
            margin-bottom: 30px;
            font-size: 24px;
            font-weight: 700;
            text-align: center;
        }

        .payment-container h5 {
            margin-bottom: 20px;
            font-size: 20px;
            text-align: center;
            color: #28a745;
        }

        .success-message, .error-message {
            text-align: center;
            margin-bottom: 20px;
        }

        .success-message {
            color: #28a745;
        }

        .error-message {
            color: #dc3545;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="payment-container mx-auto">
            <h1>@lang('payment.title')</h1>

            <h5>Rp{{ number_format($price, 0, ',', '.') }}</h5>

            @if (session('success'))
                <div class="alert alert-success success-message">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger error-message">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('paid') }}">
                @csrf
                <div class="mb-3">
                    <label for="payment_amount" class="form-label">@lang('payment.amount')</label>
                    <input type="number" class="form-control" id="payment_amount" name="payment_amount" required>
                </div>

                <input type="hidden" id="price" name="price" value="{{ $price }}">

                <button type="submit" class="btn btn-primary w-100">@lang('payment.pay_now')</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
