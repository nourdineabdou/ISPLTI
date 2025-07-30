<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @isset($title)
            {{ $title }}
        @else
            Facture
        @endisset
    </title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin: 0;
            padding: 0;
        }
        .receipt {
            width: 80mm;
            margin: auto;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .header {
            text-align: center;
            margin-bottom: 10px;
        }
        .header img {
            max-width: 60px;
            margin-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 18px;
        }
        .header p {
            margin: 5px 0;
        }
        .details, .totals {
            width: 100%;
            margin-bottom: 10px;
        }
        .details th, .details td, .totals th, .totals td {
            text-align: left;
            padding: 5px;
        }
        .details th {
            background: #f4f4f4;
        }
        .totals {
            border-top: 1px solid #ddd;
            margin-top: 10px;
        }
        .totals th {
            text-align: right;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="receipt">
    <!-- Header Section -->
    <div class="header">
        <img src="{{ asset('app-assets/images/logo/logo-dark.png') }}" alt="Restaurant Logo">
        <h1>
            {{ config('app.name') }}
        </h1>
        <p>123 Main Street, City</p>
        <p>Phone: (123) 456-7890</p>
        <p>Receipt #: 000123 | Date: {{ now()->format('Y-m-d H:i:s') }}</p>
    </div>

    {{ $slot }}

    <!-- Footer Section -->
    <div class="footer">
        <p>Merci pour votre visite!</p>
        <p>&copy; {{ now()->year }} {{ config('app.name') }}</p>
    </div>
</div>
</body>
</html>

