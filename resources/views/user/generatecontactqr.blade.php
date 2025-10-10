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
        display: block;
        margin: 10px 0 6px;
        font-weight: 600;
        color: var(--muted);
    }

    input[type="text"],
    input.input-text,
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



    .inline {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .right {
        width: fit-content;
        float: right;
    }

    .qr-wrap {
        margin-top: 18px;
        display: flex;
        gap: 24px;
        align-items: center
    }

    #qrcode {
        width: 260px;
        height: 260px;
        padding: 12px;
        border: 1px dashed #ddd;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center
    }

    pre {
        background: #f7f7f7;
        padding: 12px;
        border-radius: 8px;
        overflow: auto
    }

    .tab-active-btn {
        background: #144c88;
    }

    .generate-btn {
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
                <a href="{{ route('generatecontactqr') }}" class="flex items-center justify-center w-full py-4 font-medium transition duration-200 border-b-2 border-r border-gray-200 tab-active-btn text-white">
                    My Contact QR
                </a>
            </li>
            <li class="flex-1">
                <a href="{{ route('generateappqr') }}" class="flex items-center justify-center w-full py-4 font-medium transition duration-200 border-b-2 border-r border-gray-200 text-gray-400 hover:text-blue-500 last:rounded-r-xl">
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
            Create a personalized QR code that instantly shares your contact details — one scan and your info is saved directly to their phone.
        </p>
    </div>
</section>

<div class="container mx-auto">
    <section class="card my-6">
        <h1>My Contact QR Code Generator</h1>
        <p>Fill name, phone and email (and optional fields) then click <strong>Generate QR</strong>. The QR will encode a vCard that phones can add to Contacts.</p>



        <div class="row">
            <div>
                <label for="format">Format</label>
                <select id="format">
                    <option value="mecard">MECARD (simpler, widely supported)</option>
                    <option value="vcard">vCard 3.0 (recommended)</option>
                </select>
            </div>
            <div>

                <label for="fn">Full name</label>
                <input id="fn" class="input-text" placeholder="e.g. John Doe" />
            </div>
            <div>
                <label for="tel">Phone</label>
                <input id="tel" class="input-text" placeholder="+1 555 555 5555" />
            </div>
            <div>
                <label for="email">Email</label>
                <input id="email" class="input-text" placeholder="jane@example.com" />
            </div>
        </div>

        <div class="row">
            <div>
                <label for="org">Organization</label>
                <input id="org" class="input-text" placeholder="Company name (optional)" />
            </div>
            <div>
                <label for="title">Title</label>
                <input id="title" class="input-text" placeholder="Job title (optional)" />
            </div>
            <div>
                <label for="url">Website</label>
                <input id="url" class="input-text" placeholder="https://example.com (optional)" />
            </div>
            <div>
                <label for="adr">Address</label>
                <input id="adr" class="input-text" placeholder="Street;City;Region;Postal;Country (optional)" />
            </div>
        </div>



        <label for="note">Note</label>
        <textarea id="note" class="input-text" rows="2" placeholder="Optional note"></textarea>

        <div class="row" style="margin-top:10px">
            <div>
                <label>Colors</label>
                <div class="inline">
                    <input type="color" id="darkColor" value="#111827" title="Dark modules" />
                    <input type="color" id="lightColor" value="#ffffff" title="Light background" />
                </div>
            </div>
        </div>

        <div id="errorBox" style="display:none;color:#b33335;border:1px solid #b33335;background:#fff5f6;margin-bottom:14px;padding:8px 12px;border-radius:6px;min-height:25px;text-align:left;"></div>

        <div class="controls my-4">
            <button id="generate" class="generate-btn">Generate</button>
            <button id="downloadPng" class="secondary">Download PNG</button>
            <button id="copyText" class="secondary">Copy vCard text</button>
        </div>

        <div class="qr-wrap">
            <div id="qrcode">No QR yet — click Generate</div>
            <div style="flex:1">
                <label>Encoded text</label>
                <pre id="encoded" style="white-space:pre-wrap">—</pre>
            </div>

        </div>
    </section>
</div>

<script>
    const el = id => document.getElementById(id)
    let qr = null

    function makeVCard(data) {
        // vCard 3.0
        const lines = []
        lines.push('BEGIN:VCARD')
        lines.push('VERSION:3.0')
        if (data.fn) lines.push('FN:' + data.fn)
        if (data.org) lines.push('ORG:' + data.org)
        if (data.title) lines.push('TITLE:' + data.title)
        if (data.tel) lines.push('TEL;TYPE=CELL:' + data.tel)
        if (data.email) lines.push('EMAIL;TYPE=INTERNET:' + data.email)
        if (data.adr) lines.push('ADR;TYPE=HOME:;' + data.adr)
        if (data.url) lines.push('URL:' + data.url)
        if (data.note) lines.push('NOTE:' + data.note)
        lines.push('END:VCARD')
        return lines.join('\r\n')
    }

    function makeMeCard(data) {
        // Simple MECARD
        // MECARD:N:Name;TEL:123;EMAIL:...;
        let parts = []
        if (data.fn) parts.push('N:' + data.fn)
        if (data.tel) parts.push('TEL:' + data.tel)
        if (data.email) parts.push('EMAIL:' + data.email)
        if (data.org) parts.push('ORG:' + data.org)
        if (data.url) parts.push('URL:' + data.url)
        if (data.note) parts.push('NOTE:' + data.note)
        return 'MECARD:' + parts.join(';') + ';'
    }

    function getData() {
        return {
            fn: el('fn').value.trim(),
            tel: el('tel').value.trim(),
            email: el('email').value.trim(),
            org: el('org').value.trim(),
            title: el('title').value.trim(),
            url: el('url').value.trim(),
            adr: el('adr').value.trim(),
            note: el('note').value.trim(),
        }
    }

    function showError(msg) {
        const errorBox = el('errorBox');
        errorBox.textContent = msg;
        errorBox.style.display = msg ? 'block' : 'none';
    }

    function validateContactForm() {
        const fullName = el('fn').value.trim();
        const phone = el('tel').value.trim();
        const email = el('email').value.trim();
        let errors = [];
        if (!fullName) errors.push("Please enter full name,");
        if (!phone) errors.push("Please enter phone number,");
        else if (!/^\+?[1-9]\d{0,3}[\s\-]?\(?\d{2,4}\)?[\s\-]?\d{3,4}[\s\-]?\d{3,4}$/.test(phone))
            errors.push("Please enter valid phone number,");
        if (!email) errors.push("Please enter email address.");
        else if (!/^[\w\.-]+@[\w\.-]+\.\w{2,}$/.test(email)) errors.push("Please enter valid email address.");
        if (errors.length > 0) {
            showError(errors.join(' '));
            return false;
        }
        showError("");
        return true;
    }

    function generate() {
        const $ = (sel) => document.querySelector(sel);
        const data = getData()
        const fmt = el('format').value
        const darkColor = $('#darkColor');
        const lightColor = $('#lightColor');
        let text = ''
        if (fmt === 'vcard') text = makeVCard(data)
        else text = makeMeCard(data)

        el('encoded').textContent = text

        // clear old
        const container = el('qrcode')
        container.innerHTML = ''

        // create QR
        qr = new QRCode(container, {
            text: text,
            width: 260,
            height: 260,
            colorDark: darkColor.value || '#000000',
            colorLight: lightColor.value || '#ffffff',
            correctLevel: QRCode.CorrectLevel.H
        })
    }

    function downloadPNG() {
        if (!qr) {
            alert('Generate the QR first');
            return
        }
        // QRCode.js makes an <img> or <canvas> inside #qrcode
        const container = el('qrcode')
        const img = container.querySelector('img')
        const canvas = container.querySelector('canvas')
        if (img) {
            // image -> convert to canvas then download
            const temp = document.createElement('canvas')
            temp.width = img.naturalWidth
            temp.height = img.naturalHeight
            const ctx = temp.getContext('2d')
            ctx.drawImage(img, 0, 0)
            temp.toBlob(blob => {
                const a = document.createElement('a')
                a.href = URL.createObjectURL(blob)
                a.download = 'contact-qr.png'
                a.click()
            })
        } else if (canvas) {
            canvas.toBlob(blob => {
                const a = document.createElement('a')
                a.href = URL.createObjectURL(blob)
                a.download = 'contact-qr.png'
                a.click()
            })
        } else {
            alert('No QR image found')
        }
    }

    document.getElementById('generate').onclick = function(e) {
        e.preventDefault();
        //        if (validateContactForm()) generate();
        generate();
    };
    document.getElementById('downloadPng').onclick = function(e) {
        e.preventDefault();
        //        if (validateContactForm()) downloadPNG();
        downloadPNG();
    };
    document.getElementById('copyText').onclick = function(e) {
        e.preventDefault();
        //        if (validateContactForm()) {
        const txt = el('encoded').textContent;
        navigator.clipboard.writeText(txt);
        //        }
    };

</script>



@endsection
