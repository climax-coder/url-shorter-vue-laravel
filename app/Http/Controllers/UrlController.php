<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UrlController extends Controller
{
    public function store(Request $request) {
        $request->validate(['long_url' => 'required|url']);
        $longUrl = $request->input('long_url');

        $existingUrl = Url::where('long_url', $longUrl)->first();
        if ($existingUrl) {
            return response()->json(['short_url' => url('/'.$existingUrl->short_code)]);
        }

        $shortCode = $this->generateUniqueShortCode();
        $url = Url::create(['long_url' => $longUrl, 'short_code' => $shortCode]);
        
        return response()->json(['short_url' => url('/'.$url->short_code)]);
    }

    private function generateUniqueShortCode() {
        $shortCode = Str::random(6);
        while (Url::where('short_code', $shortCode)->exists()) {
            $shortCode = Str::random(6);
        }
        return $shortCode;
    }

    public function redirect($hash) {
        $url = Url::where('short_code', $hash)->firstOrFail();
        return redirect($url->long_url);
    }
}
