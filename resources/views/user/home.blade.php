@extends('layouts.app')

@section('title', 'QR Generator - Home')

@section('content')
<!-- Hero Section -->
<section id="home" class="relative h-screen flex items-center  overflow-hidden w-full" style="height: 600px;">
    <!-- Background Image with overlay -->
    <div class="absolute inset-0">
        <img src="{{ asset('public/images/header.png') }}" alt="Hero Background" class="w-full h-full object-cover">
        <div class="absolute inset-0 opacity-60"></div>
    </div>

    <!-- Hero Content -->
    <div class="relative z-10 text-white px-12 max-w-[30rem]">
        <h1 class="text-4xl text-11 font-bold leading-tight drop-shadow-lg">
            QR Generator – Turn Any Link Into a QR Code Instantly
        </h1>
        <p class="mt-6">Generate clean, customizable QR codes in seconds.</p>
        <a href="{{ route('generateqr') }}" class="inline-block mt-8 px-10 py-4 bg-[#BF3639] text-lg font-semibold rounded-xl shadow hover:bg-red-700 transition">
            🚀 Start Generating Now
        </a>
    </div>
</section>
<section class="relative flex items-center justify-center text-center overflow-hidden w-full bg-gray-50">
    <!-- Hero Content -->
    <div class="relative z-10 px-6 max-w-7xl mt-5">
        <h2 class="mb-8 text-[#144C88]" style="font-size: 25px;">
            Fast, simple, and free QR code generation.
        </h2>
        <p class="mb-8 text-base md:text-lg text-gray-600">
            Whether you’re a student, professional, or business owner, our QR Code Generator makes it easy to create QR codes for links, websites, or campaigns. No sign-up required. No hidden fees. Just fast, free, and reliable QR codes—your way.
        </p>
    </div>
</section>

<!-- About Section -->
<section id="about" class="py-8 bg-white">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">
        <!-- Image -->
        <div class="order-1 md:order-1">
            <img src="{{ asset('public/images/aboutus.png') }}" alt="About Us" class="rounded-2xl shadow-lg w-full object-cover">
        </div>
        <!-- Content -->
        <div class="order-2 md:order-2 text-left">
            <h2 class="text-3xl md:text-4xl font-bold text-[#144C88] mb-4">📖 About Us</h2>
            <p class="text-gray-600 text-lg leading-relaxed">
                At QR Generator, our mission is simple: make QR code creation quick, easy, and customizable for everyone.
                <br><br>
                We know that not all QR codes should look the same, which is why we let you personalize colors and generate codes that fit your brand, project, or personal style.
                <br><br>
                Built with simplicity in mind, QR Generator is:
            </p>
            <br>
            <ul class="list-disc pl-8">
                <li><strong>Fast:</strong> Enter a URL and generate instantly.</li>
                <li><strong>Customizable:</strong> Change QR colors to match your theme.</li>
                <li><strong>Free Forever:</strong> No subscriptions, no hidden costs.</li>
                <li><strong>Reliable:</strong> Download high-quality QR codes that work anywhere.</li>
            </ul>
            <br>
            <p class="text-gray-600 text-lg leading-relaxed">Whether you’re creating QR codes for business cards, product labels, social media, or events, QR Generator gives you the tools you need to stand out.</p>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="py-8 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">
        <!-- Content (switch order) -->
        <div class="order-2 md:order-1 text-left">
            <h2 class="text-3xl md:text-4xl font-bold mb-4 text-gray-600">📬 Contact Us</h2>
            <p class="italic text-lg mb-6 text-gray-600">Your feedback powers our next update.</p>
            <p class="mb-8 text-base md:text-lg text-gray-600">
                Have questions, suggestions, or ideas? We’d love to hear from you. Reach out to us anytime and help us improve QR Generator to serve you better.
            </p>
            <a href="mailto:business@bellatrixnc.com" class="inline-block px-8 py-3 bg-[#BF3639] text-lg font-semibold rounded-xl shadow hover:bg-red-700 transition text-white">
                ✉️ Send Feedback
            </a>
        </div>
        <!-- Image -->
        <div class="order-1 md:order-2">
            <img src="{{ asset('public/images/contactus.png') }}" alt="Contact Us" class="rounded-2xl shadow-lg w-full object-cover">
        </div>
    </div>
</section>

<!-- Smooth Scroll -->
<script>
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

</script>
@endsection
