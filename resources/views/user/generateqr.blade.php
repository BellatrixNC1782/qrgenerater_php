@extends('layouts.app')

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
        margin: 50px 0px;
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
        margin-bottom: 6px
    }

    input[type="text"],
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
                <a href="{{ route('generateqr') }}"
                   class="flex items-center justify-center w-full py-4 font-medium transition duration-200 border-b-2 border-r border-gray-200 tab-active-btn text-white first:rounded-l-xl">
                    Smart Link QR
                </a>
            </li>
            <li class="flex-1">
                <a href="{{ route('generatecontactqr') }}"
                   class="flex items-center justify-center w-full py-4 font-medium transition duration-200 border-b-2 border-r border-gray-200 text-gray-400 hover:text-blue-500">
                    My Contact QR
                </a>
            </li>
            <li class="flex-1">
                <a href="{{ route('generateappqr') }}"
                   class="flex items-center justify-center w-full py-4 font-medium transition duration-200 border-b-2 border-r border-gray-200 text-gray-400 hover:text-blue-500 last:rounded-r-xl">
                    App Download QR
                </a>
            </li>
        </ul>
    </div>
</div>

<div class="container mx-auto">
    <section class="card my-12">
        <h1>Smart Link QR Code Generator</h1>
        <p class="sub">Type any text or URL, choose color options and export your QR as PNG.</p>
        <div class="grid">
            <div class="left">
                <label for="qrText">Text / URL</label>
                <textarea id="qrText" placeholder="https://example.com" rows="4"></textarea>

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
        const fieldText = $('#qrText');
        const darkColor = $('#darkColor');
        const lightColor = $('#lightColor');
        const out = $('#qrcode');
        const btnGen = $('#generate');
        const btnDl = $('#download');
        const btnClear = $('#clear');

        // --- Get favicon from URL ---
        function getAutoLogoURL(text) {
            try {
                let urlStr = text.trim();
                if (!/^https?:\/\//i.test(urlStr)) {
                    urlStr = 'https://' + urlStr; // default to https
                }
                const url = new URL(urlStr);
                
                const domain = url.hostname;
                const color = darkColor.value || '#000000';
                return '{{ route("faviconproxy") }}?domain=' + domain + '&color=' + encodeURIComponent(color);
                
            } catch (e) {
                return null;
            }
        }



        function makeQR() {
            const text = fieldText.value.trim();
            if (!text) {
                out.innerHTML = '<span style="color:#94a3b8">Enter text above and click Generate</span>';
                return;
            }

            const size = 320;
            const correctLevel = QRCode.CorrectLevel.H;
            const margin = 2;

            out.innerHTML = '';
            const qr = new QRCode(out, {
                text,
                width: size,
                height: size,
                colorDark: darkColor.value || '#000000',
                colorLight: lightColor.value || '#ffffff',
                correctLevel,
            });

            out.style.padding = margin + 'px';
            out.style.background = lightColor.value || '#ffffff';

            setTimeout(() => {
                const imgTag = out.querySelector('img');
                if (!imgTag) return;

                const canvas = document.createElement('canvas');
                canvas.width = size;
                canvas.height = size;
                const ctx = canvas.getContext('2d');

                const qrImg = new Image();
                qrImg.onload = () => {
                    ctx.drawImage(qrImg, 0, 0, size, size);

                    // --- Try auto favicon ---
                    const logoUrl = getAutoLogoURL(text);
                    
                    if (logoUrl) {
                        const logo = new Image();
                        logo.crossOrigin = "anonymous";
                        logo.onload = () => {
                            const logoSize = size * 0.20;
                            const padding = 8;
                            const centerX = size / 2;
                            const centerY = size / 2;

                            // White background
                            ctx.beginPath();
                            ctx.arc(centerX, centerY, logoSize / 2 + padding, 0, Math.PI * 2);
                            ctx.fillStyle = lightColor.value || '#ffffff';
                            ctx.fill();

                            // Clip + draw
                            ctx.save();
                            ctx.beginPath();
                            ctx.arc(centerX, centerY, logoSize / 2, 0, Math.PI * 2);
                            ctx.clip();
                            ctx.drawImage(
                                logo,
                                centerX - logoSize / 2,
                                centerY - logoSize / 2,
                                logoSize,
                                logoSize
                            );
                            ctx.restore();
                        };
                        logo.src = logoUrl;
                    } else {
                        // --- Fallback: Letter ---
                        const logoText = text[0].toUpperCase();
                        const logoSize = size * 0.18;
                        const padding = 8;
                        const centerX = size / 2;
                        const centerY = size / 2;

                        ctx.beginPath();
                        ctx.arc(centerX, centerY, logoSize / 2 + padding, 0, Math.PI * 2);
                        ctx.fillStyle = lightColor.value || '#ffffff';
                        ctx.fill();

                        ctx.fillStyle = darkColor.value || '#000000';
                        ctx.font = `${logoSize * 0.6}px Arial`;
                        ctx.textAlign = "center";
                        ctx.textBaseline = "middle";
                        ctx.fillText(logoText, centerX, centerY);
                    }
                };
                qrImg.src = imgTag.src;

                out.innerHTML = '';
                out.appendChild(canvas);
            }, 300);
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
            out.innerHTML = '<span style="color:#94a3b8">Cleared. Enter text above and click Generate</span>';
        }

        btnGen.addEventListener('click', makeQR);
        btnDl.addEventListener('click', downloadPNG);
        btnClear.addEventListener('click', clearAll);

        out.innerHTML = '<span style="color:#94a3b8">Enter text above and click Generate</span>';
    });
</script>



@endsection
