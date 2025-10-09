<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Open App Store</title>
  <script>
    function redirectToStore() {
      const androidUrl = "{{ $app_url_info->android_url }}"; 
      const iosUrl = "{{ $app_url_info->ios_url }}"; 
      const fallbackUrl = "https://example.com"; 

      const ua = navigator.userAgent.toLowerCase();

      // Reliable Android detection
      if (ua.indexOf("android") > -1) {
        window.location.replace(androidUrl);
      }
      // Reliable iOS detection
      else if (/iphone|ipad|ipod/.test(ua)) {
        window.location.replace(iosUrl);
      }
	   // Windows
      else if (ua.includes("windows")) {
        window.location.replace(androidUrl);
      }
	   // macOS
      else if (ua.includes("macintosh") || ua.includes("mac os")) {
        window.location.replace(iosUrl);
      }
	  
      // Anything else (Windows, Mac, etc.)
      else {
        window.location.replace(fallbackUrl);
      }
    }

    window.onload = redirectToStore;
  </script>
</head>
<body>
  <p>Redirecting to the correct app store…</p>
</body>
</html>
