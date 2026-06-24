<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PartnershipInquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PartnershipInquiryController extends Controller
{
    public function index(Request $request): View
    {
        $inquiries = PartnershipInquiry::query()
            ->when($request->filled('search'), fn ($query) => $query->where(fn ($q) => $q
                ->where('name', 'like', '%'.$request->search.'%')
                ->orWhere('email', 'like', '%'.$request->search.'%')))
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->status))
            ->latest()->paginate(10)->withQueryString();

        return view('admin.inquiries.index', compact('inquiries'));
    }

    public function show(PartnershipInquiry $inquiry): View
    {
        return view('admin.inquiries.show', compact('inquiry'));
    }

    public function updateStatus(Request $request, PartnershipInquiry $inquiry): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(['baru', 'diproses', 'diterima', 'ditolak'])],
        ]);
        $inquiry->update($validated);

        return back()->with('success', 'Status pengajuan berhasil diperbarui.');
    }

    public function destroy(PartnershipInquiry $inquiry): RedirectResponse
    {
        $inquiry->delete();

        return redirect()->route('admin.inquiries.index')->with('success', 'Pengajuan berhasil dihapus.');
    }
}
