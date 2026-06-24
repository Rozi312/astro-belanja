<?php

namespace App\Http\Controllers;

use App\Http\Requests\PartnershipInquiryRequest;
use App\Models\CompanyProfile;
use App\Models\PartnershipInquiry;
use Illuminate\Http\RedirectResponse;

class AstroController extends Controller
{
    public function about()
    {
        $profile = CompanyProfile::query()->oldest('id')->first();

        return view('pages.about', compact('profile'));
    }

    public function partnership()
    {
        return view('pages.partnership');
    }

    public function storePartnership(PartnershipInquiryRequest $request): RedirectResponse
    {
        PartnershipInquiry::create($request->validated());

        return back()->with('success', 'Penawaran kerja sama berhasil dikirim. Tim Astro akan segera menghubungi Anda.');
    }
}
