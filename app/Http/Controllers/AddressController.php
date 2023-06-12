<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class AddressController extends Controller
{
    public function fetchCities(Request $request): mixed
    {
        $fetchedCities = Http::get('https://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi=' . $request->province_id);
        $cities = json_decode($fetchedCities)->kota_kabupaten;
        return response()->json($cities);
    }
}
