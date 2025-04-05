<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function store(Request $request, $serviceRequestId)
{
    $data = $request->validate([
        'price'       => 'required|numeric',
        'description' => 'required|string',
    ]);

    $data['provider_id'] = auth()->id();
    $data['service_request_id'] = $serviceRequestId;

    $offer = Offer::create($data);

    return response()->json($offer, 201);
}

public function index($serviceRequestId)
{
    $offers = Offer::where('service_request_id', $serviceRequestId)->get();
    return response()->json($offers);
}

}
