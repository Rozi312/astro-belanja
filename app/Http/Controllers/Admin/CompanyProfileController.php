<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyProfileRequest;
use App\Models\CompanyProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CompanyProfileController extends Controller
{
    public function edit(): View
    {
        $profile = CompanyProfile::query()->oldest('id')->first();

        return view('admin.profile.edit', compact('profile'));
    }

    public function update(CompanyProfileRequest $request): RedirectResponse
    {
        $profile = CompanyProfile::query()->oldest('id')->first();
        $data = $request->validated();
        $data['is_active'] = true;

        if ($request->hasFile('image')) {
            $this->deleteUploadedImage($profile?->image);
            $data['image'] = $request->file('image')->store('profiles', 'public');
        } else {
            unset($data['image']);
        }

        if ($profile) {
            $profile->update($data);
        } else {
            CompanyProfile::create($data);
        }

        return redirect()->route('admin.profile.edit')
            ->with('success', 'Profil perusahaan berhasil disimpan.');
    }

    private function deleteUploadedImage(?string $path): void
    {
        if ($path && ! str_starts_with($path, 'seed:')) {
            Storage::disk('public')->delete($path);
        }
    }
}
