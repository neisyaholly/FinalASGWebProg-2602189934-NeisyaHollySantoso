<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Handle Overpayment</title>
    <style>
        /* Add some basic styling */
    </style>
</head>

<body>
    <div class="overpayment-container">
        <h1>Overpayment</h1>
        <p>Sorry you overpaid ${{ number_format($amount, 2) }}, would you like to enter a balance?</p>

        <form method="POST" action="{{ route('process.overpayment') }}">
            @csrf
            <input type="hidden" name="amount" value="{{ $amount }}">
            <input type="hidden" name="payment_amount" value="{{ $payment_amount }}">
            <input type="hidden" name="price" value="{{ $price }}">

            <button type="submit" name="action" value="yes">Yes, add to wallet</button>
            <button type="submit" name="action" value="no">No, correct amount</button>
        </form>
    </div>
</body>

</html>