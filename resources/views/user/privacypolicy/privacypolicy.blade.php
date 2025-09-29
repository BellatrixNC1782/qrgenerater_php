@extends('layouts.app')

@section('content')
<div class="bg-gray-100 py-10">
    <div class="max-w-5xl mx-auto px-4">
        <div class="bg-white shadow-xl rounded-2xl p-8 md:p-12">

            <!-- Header -->
            <div class="text-center mb-10">
                <h1 class="text-4xl font-bold text-gray-900">Privacy Policy</h1>
                <p class="text-gray-500 mt-2">Effective Date: 01/05/2025</p>
            </div>

            <!-- Intro -->
            <p class="text-gray-700 leading-relaxed">
                At <strong>QR Generator</strong>, we respect your privacy. Our tool is designed to be simple and secure, and we do not collect personal data from users when generating QR codes.
            </p>
           
            <ul class="list-disc list-inside mt-3 text-gray-700 space-y-2">
                <li><strong>No Sign-Up Required:</strong> You can generate QR codes without creating an account.</li>
                <li><strong>No Tracking:</strong> We don’t store your links, QR codes, or personal information.</li>
                <li><strong>Secure Usage:</strong> All data entered stays on your device and is used only to generate the QR code.</li>
            </ul>
            <p class="mt-3 text-gray-700">By using QR Generator, you can rest assured that your information is safe, private, and never shared with third parties.</p>

            <!-- Contact -->
            <h3 class="mt-8 text-2xl font-semibold text-gray-800">Contact Us</h3>
            <p class="mt-2 text-gray-700">If you have questions or concerns, please reach us:</p>
            <ul class="mt-3 space-y-2 text-gray-700">
                <li>📧 Email: <a href="mailto:business@bellatrixnc.com" class="text-blue-600 hover:underline">business@bellatrixnc.com</a></li>
                <li>🌐 Website: <a href="{{ route('home') }}" target="_blank" class="text-blue-600 hover:underline">QR Generator</a></li>
            </ul>

        </div>
    </div>
</div>
@endsection
