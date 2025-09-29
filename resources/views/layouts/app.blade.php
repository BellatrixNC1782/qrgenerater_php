<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Free QR Code Generator | Create & Customize QR Codes Instantly</title>
    <meta name="description" content="Generate free QR codes instantly with our easy QR Code Generator. Enter a URL, customize colors, and download high-quality QR codes in seconds. No sign-up, no fees." />
    <meta name="keywords" content="generate QR code from URL, free QR code creator tool, online QR code generator no sign up, custom color QR code, best free QR code generator, free QR code generator, QR code generator online, QR code maker free, create QR code instantly, customize QR code" />
    <meta name="author" content="QRGenerater" />

    <link rel="shortcut icon" href="{{ asset('public/images/fav.png') }}" type="image/x-icon">

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100 min-h-screen">
    <header class="bg-[#144C88] text-white py-4 shadow">
        <div class="max-w-6xl mx-auto px-4 flex justify-between items-center">
            <h1 class="text-xl font-bold">QR Generator</h1>

            <nav class="hidden md:flex space-x-6 font-medium">
                <a href="{{ route('home') }}" class="transition {{ request()->is('/') ? 'text-yellow-400 font-semibold border-b-2 border-yellow-400' : '' }}">
                    Home
                </a>

                <a href="{{ route('home') }}#about" class="transition {{ request()->is('/') && request()->has('about') ? 'text-yellow-400 font-semibold border-b-2 border-yellow-400' : '' }}">
                    About Us
                </a>
                <a href="{{ route('home') }}#contact" class="transition {{ request()->is('/') && request()->has('about') ? 'text-yellow-400 font-semibold border-b-2 border-yellow-400' : '' }}">
                    Contact Us
                </a>

                <a href="{{ route('generateqr') }}" class="transition {{ request()->routeIs('fake.profile') ? 'text-yellow-400 font-semibold border-b-2 border-yellow-400' : '' }}">
                    Generate QR
                </a>
            </nav>

            <nav class="space-x-4">
                <a href="mailto:business@bellatrixnc.com" class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#BF3639] text-white font-medium rounded-lg hover:bg-red-800 transition shadow">
                    Contact Us
                </a>
            </nav>
        </div>
    </header>


    <main class="">
        @yield('content')
    </main>

    <footer class="bg-[#144C88] text-center text-sm text-white py-6">
        <div class="text-center">
            <div class="mb-2">
                <a href="{{ route('privacypolicy') }}" class="text-white text-decoration-none mx-2">Privacy Policy</a>
                <span class="">|</span>
                <a href="{{ route('termsofuse') }}" class="text-white text-decoration-none mx-2">Terms & Conditions</a>
            </div>
            <div class="small">
                &copy; {{ date('Y') }} QR Generator. All rights reserved.
                | Powered by <a class="text-white" href="https://www.bellatrixnc.com/" target="_blank">BellatrixNC</a>
            </div>
        </div>
    </footer>
</body>

</html>
