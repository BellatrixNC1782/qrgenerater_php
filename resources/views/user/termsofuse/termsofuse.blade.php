@extends('layouts.app')

@section('content')
<div class="bg-gray-100 py-10">
    <div class="max-w-5xl mx-auto px-4">
        <div class="bg-white shadow-xl rounded-2xl p-8 md:p-12">

            <!-- Header -->
            <div class="text-center mb-10">
                <h1 class="text-4xl font-bold text-gray-900">Terms &amp; Conditions</h1>
                <p class="text-gray-500 mt-2">
                    Effective Date: 01/05/2025
                </p>
            </div>

            <!-- Intro -->
            <p class="text-gray-700 leading-relaxed">
                By using <strong>QR Generator</strong>, you agree to the following terms:
            </p>
           
            <ul class="list-disc list-inside mt-3 text-gray-700 space-y-2">
                <li><strong>Free Service:</strong> Our QR code generator is free for personal and business use.</li>
                <li><strong>Proper Use:</strong> You are responsible for ensuring that the links you generate QR codes for do not contain harmful, illegal, or offensive content.</li>
                <li><strong>No Warranty:</strong> We provide QR Generator “as is.” While we strive for accuracy and reliability, we are not liable for any issues that arise from the use of QR codes created with our tool.</li>
                <li><strong>Intellectual Property:</strong> All branding, design, and content on QR Generator are owned by us and may not be copied or used without permission.</li>
            </ul>

            
            <p class="mt-2 text-gray-700">By continuing to use QR Generator, you acknowledge and accept these terms.</p>

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
