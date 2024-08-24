<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form</title>
    <style>
        /* Add some basic styling */
    </style>
</head>

<body>
    <div class="payment-container">
        <h1>Payment Form</h1>

        <h5>{{ $price }}</h5>

        @if (session('success'))
            <div class="success-message">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="error-message">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('updatePaid') }}">
            @csrf
            <label for="payment_amount">Enter Payment Amount:</label>
            <input type="number" id="payment_amount" name="payment_amount" required>

            <input type="hidden" id="price" name="price" value="{{ $price }}">

            <button type="submit">Pay Now</button>
        </form>
    </div>
</body>

</html>