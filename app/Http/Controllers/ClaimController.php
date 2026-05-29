<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\Report;
use Illuminate\Http\Request;

class ClaimController extends Controller
{
    /**
     * Simpan permintaan klaim/kontak baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'report_id' => 'required|exists:reports,id',
            'pesan_validasi' => 'required|string|min:10',
            'no_wa' => 'required|string|min:9|max:15',
            'bukti_gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Cek apakah user mencoba mengklaim laporannya sendiri
        $report = Report::findOrFail($request->report_id);
        if ((int)$report->user_id == (int)auth()->id()) {
            return redirect()->back()->with('error', 'Anda tidak dapat mengklaim laporan Anda sendiri.');
        }

        // Cek apakah user sudah pernah klaim laporan ini
        $existingClaim = Claim::where('report_id', $request->report_id)
            ->where('user_id', auth()->id())
            ->first();

        if ($existingClaim) {
            return redirect()->back()->with('error', 'Anda sudah mengirimkan permintaan untuk laporan ini.');
        }

        $buktiGambarName = null;
        if ($request->hasFile('bukti_gambar')) {
            $image = $request->file('bukti_gambar');
            $image->storeAs('public/claims', $image->hashName());
            $buktiGambarName = $image->hashName();
        }

        Claim::create([
            'report_id' => $request->report_id,
            'user_id' => auth()->id(),
            'pesan_validasi' => $request->pesan_validasi,
            'no_wa' => $request->no_wa,
            'bukti_gambar' => $buktiGambarName,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Permintaan Anda telah dikirim ke admin.');
    }

    /**
     * Tampilkan daftar klaim untuk admin
     */
    public function index()
    {
        $claims = Claim::with(['report', 'user'])->latest()->get();
        
        $pendingClaims = $claims->where('status', 'pending');
        $rejectedClaims = $claims->where('status', 'rejected');
        $acceptedClaims = $claims->where('status', 'accepted');
        
        $claims = $pendingClaims->concat($rejectedClaims)->concat($acceptedClaims);

        return view('admin.claims', compact('claims'));
    }

    /**
     * Update status klaim (Accept/Reject)
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:accepted,rejected',
            'catatan_admin' => 'nullable|string',
        ]);

        $claim = Claim::findOrFail($id);
        $claim->update([
            'status' => $request->status,
            'catatan_admin' => $request->catatan_admin,
        ]);

        $message = $request->status == 'accepted' ? 'Permintaan diterima.' : 'Permintaan ditolak.';
        
        return redirect()->back()->with('success', $message);
    }
}
