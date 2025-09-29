<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

Route::get('/', 'HomeController@home')->name('home');
Route::get('privacypolicy', 'HomeController@privacypolicy')->name('privacypolicy');
Route::get('termsofuse', 'HomeController@termsofuse')->name('termsofuse');
Route::get('generateqr', 'HomeController@generateQr')->name('generateqr');

/*Route::get('/favicon-proxy', function (\Illuminate\Http\Request $request) {
    $domain = $request->query('domain');
    if (!$domain) return response('No domain', 400);

    $url = "https://www.google.com/s2/favicons?sz=128&domain={$domain}";
    $response = Http::get($url);

    return response($response->body(), 200)->header('Content-Type', 'image/png');
})->name('faviconproxy');*/


Route::get('/favicon-proxy', function (Request $request) {
    $domain = strtolower($request->query('domain')); // e.g. youtube.com, www.instagram.com
    if (!$domain) return response('No domain', 400);

    // Extract main brand (remove www. and .com/.org/etc.)
    $brand = preg_replace('/^(www\.)|(\..*)$/', '', $domain);

    $url = "https://cdn.simpleicons.org/{$brand}";
    
    $color = $request->query('color');

    // Fetch SVG with redirects
    $response = Http::get($url);
    

    if ($response->failed()) {
        
        
        $firstLetter = strtoupper(substr($brand, 0, 1));
        $svgFallback = '<svg xmlns="http://www.w3.org/2000/svg" width="128" height="128">
      <rect width="100%" height="100%" fill="none"/>
      <text x="50%" y="50%" font-size="72" text-anchor="middle" dominant-baseline="central" fill="'.$color.'" font-family="Arial, sans-serif">'.$firstLetter.'</text>
    </svg>';

        return response($svgFallback, 200)->header('Content-Type', 'image/svg+xml');
        
        
        return response('Logo not found', 404);
    }

    // Optional dynamic color
    
    $svg = preg_replace('/fill="[^"]*"/', 'fill="' . $color . '"', $response->body());
    
    return response($svg, 200)->header('Content-Type', 'image/svg+xml');
})->name('faviconproxy');

