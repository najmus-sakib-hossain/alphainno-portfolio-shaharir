<?php

namespace App\Http\Controllers\Api;

use App\Models\Certificate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CertificateController extends Controller
{
    public function getCertificates()
    {
        $certificates = Certificate::where('is_active', true)->get();

        return response()->json([
            'status' => 'success',
            'data' => $certificates
        ]);
    }
}
