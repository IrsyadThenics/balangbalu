<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Tampilkan daftar laporan
     */
    public function index()
    {
        $reports = Report::latest()->get();
        return view('user.home', compact('reports'));
    }

    /**
     * Tampilkan form tambah laporan
     */
    public function create()
    {
        return view('user.report');
    }

    /**
     * Simpan laporan baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'foto_laporan'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'nama_laporan'      => 'required|string|max:255',
            'jenis_laporan'     => 'required|in:kehilangan,menemukan',
            'lokasi_laporan'    => 'required',
            'deskripsi_laporan' => 'required',
            'tanggal_laporan'   => 'required|date',
            'waktu_laporan'     => 'required',
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->id(); // Simpan ID user login

        if ($request->hasFile('foto_laporan')) {
            $image = $request->file('foto_laporan');
            $image->storeAs('public/reports', $image->hashName());
            $data['foto_laporan'] = $image->hashName();
        }

        if ($request->tanggal_laporan) {
            $data['tanggal_laporan'] = Carbon::parse($request->tanggal_laporan);
        }

        if ($request->waktu_laporan) {
            $data['waktu_laporan'] = Carbon::parse($request->tanggal_laporan . ' ' . $request->waktu_laporan);
        }

        Report::create($data);

        if (auth()->user()->role == 'admin') {
            return redirect()->route('admin.home')->with('success', 'Laporan berhasil dibuat!');
        }
        return redirect()->route('user.home')->with('success', 'Laporan berhasil dibuat!');
    }

    /**
     * Tampilkan form edit laporan
     */
    public function edit(string $id)
    {
        $report = Report::findOrFail($id);

        // Pengecekan != untuk fleksibilitas tipe data Oracle
        if ($report->user_id != auth()->id() && auth()->user()->role != 'admin') {
            abort(403, 'Anda tidak memiliki akses untuk mengedit laporan ini.');
        }

        return view('user.edit', compact('report'));
    }

    /**
     * Update data laporan
     */
    public function update(Request $request, string $id)
    {
        $report = Report::findOrFail($id);

        if ($report->user_id != auth()->id() && auth()->user()->role != 'admin') {
            abort(403, 'Anda tidak memiliki akses untuk mengubah laporan ini.');
        }

        $request->validate([
            'foto_laporan'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'nama_laporan'      => 'required|string|max:255',
            'jenis_laporan'     => 'required|in:kehilangan,menemukan',
            'lokasi_laporan'    => 'required',
            'deskripsi_laporan' => 'required',
            'tanggal_laporan'   => 'required|date',
            'waktu_laporan'     => 'required',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto_laporan')) {
            if ($report->foto_laporan) {
                Storage::delete('public/reports/' . $report->foto_laporan);
            }
            $image = $request->file('foto_laporan');
            $image->storeAs('public/reports', $image->hashName());
            $data['foto_laporan'] = $image->hashName();
        }

        if ($request->tanggal_laporan) {
            $data['tanggal_laporan'] = Carbon::parse($request->tanggal_laporan);
        }

        if ($request->waktu_laporan) {
            $data['waktu_laporan'] = Carbon::parse($request->tanggal_laporan . ' ' . $request->waktu_laporan);
        }

        $report->update($data);

        if (auth()->user()->role == 'admin') {
            return redirect()->route('admin.home')->with('success', 'Laporan berhasil diperbarui!');
        }
        return redirect()->route('user.home')->with('success', 'Laporan berhasil diperbarui!');
    }

    /**
     * Hapus laporan
     */
    public function destroy(string $id)
    {
        $report = Report::findOrFail($id);

        if ($report->user_id != auth()->id() && auth()->user()->role != 'admin') {
            abort(403, 'Anda tidak memiliki akses untuk menghapus laporan ini.');
        }

        if ($report->foto_laporan) {
            Storage::delete('public/reports/' . $report->foto_laporan);
        }

        $report->delete();

        return redirect()->back()->with('success', 'Laporan berhasil dihapus!');
    }
}
