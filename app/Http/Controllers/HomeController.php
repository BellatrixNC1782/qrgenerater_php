<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfileVisitor;
use App\Models\Appurls;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class HomeController extends Controller {

    public function home(Request $request) {
        
        $response = Http::get('http://ip-api.com/json/' . $request->ip());
        if ($response->ok()) {
            $geo = $response->json();

            ProfileVisitor::create([
                'ip' => $request->ip(),
                'browser' => $request->header('User-Agent'),
                'system' => php_uname(),
                'country' => $geo['country'] ?? null,
                'country_code' => $geo['countryCode'] ?? null,
                'region' => $geo['regionName'] ?? null,
                'city' => $geo['city'] ?? null,
                'timezone' => $geo['timezone'] ?? null,
                'lat' => is_numeric($geo['lat'] ?? null) ? floatval($geo['lat']) : null,
                'lng' => is_numeric($geo['lon'] ?? null) ? floatval($geo['lon']) : null,
                'isp' => $geo['isp'] ?? null,
                'organization' => $geo['org'] ?? null,
                'guid' => \Str::uuid(),
                'page_type' => 'home',
            ]);
        }
        
        return view('user.home');
    }
    
    public function privacypolicy(){
        return view('user.privacypolicy.privacypolicy');
    }
        
    public function termsofuse(){
        return view('user.termsofuse.termsofuse');
    }
    
    public function generateQr(){
        return view('user.generateqr');
    }
    
    public function generateContactQr(){
        return view('user.generatecontactqr');
    }
    
    public function generateAppQr(){
        return view('user.generateappqr');
    }
    
    public function getAppUrl(Request $request){
        $save_url = new Appurls();
        $save_url->android_url = $request->android_url;
        $save_url->ios_url = $request->ios_url;
        
        $save_url->save();
        
        $url_text = route('redirectstore',['store_id' => base64_encode($save_url->id)]);
        
        return response()->json(['text' => $url_text]);
    }
    
    public function redirectStore($store_id){
        $store_id = base64_decode($store_id);
        
        $app_url_info = Appurls::find($store_id);
        
        return view('user.redirectstore',compact('app_url_info'));
    }
}
