@extends('layouts.app')

@section('title', 'Fake Person Generator')

@section('content')

<link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js" defer></script>
<style>
    .card {
        background: linear-gradient(180deg, rgba(255, 255, 255, .06), rgba(255, 255, 255, .02));
        border: 1px solid rgba(148, 163, 184, .15);
        border-radius: 20px;
        padding: 20px 18px;
        backdrop-filter: blur(6px);
        box-shadow: 0 10px 25px rgba(2, 6, 23, .35);
    }

    h1 {
        margin: 0 0 8px;
        font-size: clamp(22px, 3.6vw, 32px);
        letter-spacing: .2px;
        text-align: center;
    }

    .sub {
        color: var(--muted);
        font-size: 14px;
    }

    .grid {
        display: grid;
        grid-template-columns: 1.2fr .8fr;
        gap: 200px;
    }

    @media (max-width:800px) {
        .grid {
            grid-template-columns: 1fr;
        }
    }

    label {
        font-size: 12px;
        color: var(--muted);
        display: block;
        margin-bottom: 6px;
        margin-top: 12px;
        font-weight: 600;
    }


    input[type="text"],
    input[type="url"],
    textarea,
    select,
    input[type="number"],
    input[type="file"] {
        width: 100%;
        background: #144c8842;
        border: 1px solid rgba(148, 163, 184, .18);
        color: var(--text);
        border-radius: 12px;
        padding: 12px 14px;
        outline: none;
        resize: vertical;
        min-height: 44px;
    }

    input:focus,
    textarea:focus,
    select:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 6px var(--ring);
    }

    .row {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 10px;
    }

    @media (max-width:560px) {
        .row {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    .btns {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 12px;
    }

    button {
        background: #144c88;
        border: none;
        color: #fff;
        font-weight: 700;
        padding: 10px 14px;
        border-radius: 12px;
        cursor: pointer;
        transition: transform .08s ease, filter .2s ease;
    }

    button:hover {
        filter: brightness(1.02)
    }

    button:active {
        transform: translateY(1px);
    }

    .danger {
        background: #b33335;
        color: #fff;
    }

    .qr-wrap {
        display: grid;
        place-items: center;
        min-height: 330px;
        min-width: 330px;
        border: 6px solid #000;
        padding: 10px;
    }

    .inline {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .right {
        width: fit-content;
        float: right;
    }
    
    .tab-active-btn{
        background: #144c88;
    }
    .generate-btn{
        background: #2b9320;
    }

</style>
<div class="max-w-xl mx-auto mt-10 mb-10">
    <div class="bg-white border border-gray-200 rounded-xl">
        <ul class="flex justify-center divide-x divide-gray-200" role="tablist">
            <li class="flex-1">
                <a href="{{ route('generateqr') }}" class="flex items-center justify-center w-full py-4 font-medium transition duration-200 border-b-2 border-r border-gray-200 text-gray-400 hover:text-blue-500 first:rounded-l-xl">
                    Smart Link QR
                </a>
            </li>
            <li class="flex-1">
                <a href="{{ route('generatecontactqr') }}" class="flex items-center justify-center w-full py-4 font-medium transition duration-200 border-b-2 border-r border-gray-200 text-gray-400 hover:text-blue-500">
                    My Contact QR
                </a>
            </li>
            <li class="flex-1">
                <a href="{{ route('generateappqr') }}" class="flex items-center justify-center w-full py-4 font-medium transition duration-200 border-b-2 border-r border-gray-200 tab-active-btn text-white last:rounded-r-xl">
                    App Download QR
                </a>
            </li>
        </ul>
    </div>
</div>
<section class="relative flex items-center justify-center text-center overflow-hidden w-full">
    <!-- Hero Content -->
    <div class="relative z-10 px-6 max-w-7xl mt-5">
        <p class="mb-8 text-base md:text-lg text-gray-600">
            Generate a single QR code that automatically detects the device and sends users to your app’s Play Store or App Store page — simple, smart, and instant.
        </p>
    </div>
</section>

<div class="container mx-auto">
    <section class="card my-6">
        <h1>App Download QR Code Generator</h1>
        <p class="sub">Enter your platform URLs below and click Generate. The page will detect your device and open the correct link.</p>
        <div class="grid">
            <div class="left">
                <label>Android app (Play Store URL):</label>
                <input id="androidUrl" type="url" placeholder="https://play.google.com/store/apps/details?id=com.example.app">

                <label>iOS app (App Store URL):</label>
                <input id="iosUrl" type="url" placeholder="https://apps.apple.com/app/id1234567890">
                
                <div class="row" style="margin-top:10px">
                    <div>
                        <label>Colors</label>
                        <div class="inline">
                            <input type="color" id="darkColor" value="#111827" title="Dark modules" />
                            <input type="color" id="lightColor" value="#ffffff" title="Light background" />
                        </div>
                    </div>
                </div>

                <div class="btns">
                    <button id="generate" class="generate-btn">Generate</button>
                    <button id="download" class="ghost">Download PNG</button>
                    <button id="clear" class="danger">Clear</button>
                </div>
            </div>

            <div class="right card">
                <div class="qr-wrap">
                    <div id="qrcode" aria-live="polite" aria-label="QR code output area"></div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    window.addEventListener('DOMContentLoaded', () => {
        const $ = (sel) => document.querySelector(sel);
        const androidUrl = $('#androidUrl');
        const iosUrl = $('#iosUrl');
        const out = $('#qrcode');
        const btnGen = $('#generate');
        const btnDl = $('#download');
        const btnClear = $('#clear');
        const darkColor = $('#darkColor');
        const lightColor = $('#lightColor');

        function isAndroidPlayStoreUrl(url) {
            // More flexible Play Store URL validation allowing query parameters
            const playStoreRegex = /^https:\/\/play\.google\.com\/store\/apps\/details\?id=[a-zA-Z0-9._-]+(&.*)?$/;
            return playStoreRegex.test(url);
        }


        function isIosAppStoreUrl(url) {
            // Accept optional country code and app name before /id
            const appStoreRegex = /^https:\/\/apps\.apple\.com(\/[a-zA-Z\-]+)*\/app\/[a-zA-Z0-9\-]+\/id\d{6,}$/;
            return appStoreRegex.test(url);
        }




        function makeQR() {
            const androidURL = androidUrl.value.trim();
            const iosURL = iosUrl.value.trim();
            if (!androidURL || !iosURL) {
                out.innerHTML = '<span style="color:#94a3b8">Enter links above and click Generate</span>';
                return;
            }

            // Validate URLs
            if (!isAndroidPlayStoreUrl(androidURL)) {
                out.innerHTML = '<span style="color:#b33335">Invalid Android Play Store URL.</span>';
                return;
            }
            if (!isIosAppStoreUrl(iosURL)) {
                out.innerHTML = '<span style="color:#b33335">Invalid iOS App Store URL.</span>';
                return;
            }

            // AJAX to get text for QR code
            fetch('{{ route("getappurl") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        android_url: androidURL,
                        ios_url: iosURL
                    })
                })
                .then(response => response.json())
                .then(data => {
                    let text = data.text; // The server should return {text: "..."}
                    const size = 320;
                    const correctLevel = QRCode.CorrectLevel.H;
                    const margin = 2;

                    out.innerHTML = '';
                    const qr = new QRCode(out, {
                        text: text,
                        width: size,
                        height: size,
                        colorDark: darkColor.value || '#000000',
                        colorLight: lightColor.value || '#ffffff',
                        correctLevel: correctLevel
                    });

                    out.style.padding = margin + 'px';
                    out.style.background = '#ffffff';
                })
                .catch(() => {
                    out.innerHTML = '<span style="color:#b33335">Could not generate QR code.</span>';
                });
        }



        function downloadPNG() {
            const canvas = out.querySelector('canvas');
            if (!canvas) return;
            const dataURL = canvas.toDataURL('image/png');
            const a = document.createElement('a');
            a.href = dataURL;
            a.download = 'qr-code.png';
            a.click();
        }

        function clearAll() {
            fieldText.value = '';
            out.innerHTML = '<span style="color:#94a3b8">Cleared. Enter links above and click Generate</span>';
        }

        btnGen.addEventListener('click', makeQR);
        btnDl.addEventListener('click', downloadPNG);
        btnClear.addEventListener('click', clearAll);

        out.innerHTML = '<span style="color:#94a3b8">Enter links above and click Generate</span>';
    });

</script>



@endsection
