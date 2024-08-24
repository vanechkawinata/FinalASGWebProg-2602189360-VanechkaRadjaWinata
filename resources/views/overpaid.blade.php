<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('overpayment.title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .overpayment-container {
            margin-top: 50px;
            max-width: 500px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .overpayment-container h1 {
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: 700;
            text-align: center;
        }

        .overpayment-container p {
            font-size: 18px;
            text-align: center;
            margin-bottom: 30px;
        }

        .overpayment-container .btn {
            width: 100%;
            padding: 10px;
            font-size: 16px;
        }

        .btn-decline {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="overpayment-container mx-auto">
            <h1>@lang('overpayment.title')</h1>
            <p>
                @lang('overpayment.message', ['amount' => number_format($amount, 2)])
            </p>
            <form method="POST" action="{{ route('overpaid') }}">
                @csrf
                <input type="hidden" name="amount" value="{{ $amount }}">
                <input type="hidden" name="payment_amount" value="{{ $payment_amount }}">
                <input type="hidden" name="price" value="{{ $price }}">

                <button type="submit" name="action" value="accept" class="btn btn-primary">@lang('overpayment.accept')</button>
                <button type="submit" name="action" value="decline" class="btn btn-secondary btn-decline">@lang('overpayment.decline')</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
