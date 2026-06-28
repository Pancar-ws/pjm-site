<?php

namespace App\Http\Controllers;

use App\Models\Certification;

class CertificationController extends Controller
{
    public function index()
    {
        $certifications = Certification::all();
        return view('certifications.index', compact('certifications'));
    }
}
