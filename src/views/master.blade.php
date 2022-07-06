<html>
<head>
    <title>Store</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

@yield("store")

<!-- JS here -->
<script src="{{ asset('packages/cart/js/jquery-1.12.4.min.js') }}"></script>
<!-- Custom js-->
<script src="{{ asset('packages/cart/js/shopping-cart.js') }}"></script>

</body>
</html>
