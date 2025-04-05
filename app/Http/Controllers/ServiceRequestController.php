<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceRequest;

class ServiceRequestController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'category'    => 'required|string',
            'description' => 'required|string',
            'is_urgent'   => 'required|boolean',
        ]);

        $data['client_id'] = auth()->id();
        $serviceRequest = ServiceRequest::create($data);

        return response()->json($serviceRequest, 201);
    }

    public function index()
{
    $requests = ServiceRequest::all();
    return response()->json($requests);
}


}
