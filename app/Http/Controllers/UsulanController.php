<?php

namespace App\Http\Controllers;

use App\Models\Usulan;
use App\Models\Indikator;
use App\Models\Responden;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsulanController extends Controller
{
    public function index()
    {
        $indikators = Indikator::where('is_display', true)->get();
        $respondenId = session('responden_id');
        $usulanList = [];

        if ($respondenId) {
            $usulanList = Usulan::with('indikator')
                ->where('responden_id', $respondenId)
                ->get();
        }

        return view('usulan.form', compact('indikators', 'usulanList', 'respondenId'));
    }

    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'instansi' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
        ]);

        $responden = Responden::create($validated);
        session(['responden_id' => $responden->id]);

        return redirect()->route('usulan.index')->with('success', 'Data responden berhasil disimpan');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'indikator' => 'required|exists:indikators,id',
            'tingkat_bok' => 'required|in:Provinsi,Kabupaten/Kota,Puskesmas',
            'saran_kegiatan' => 'required|string',
            'detail_kegiatan' => 'required|string',
            'keriteria_penerima_bok' => 'required|string',
            'volume' => 'required|integer|min:1',
            'satuan' => 'required|string|max:50',
            'frekuensi_tahun' => 'required|integer|min:1',
            'anggaran' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            dd("error cok! faillll", $validator->errors());
            return back()->withErrors($validator)->withInput();
        }
        $validated = (object) $validator->validated();

        $respondenId = session('responden_id');

        if (!$respondenId) {
            return redirect()->route('usulan.index')->with('error', 'Silakan isi data responden terlebih dahulu');
        }

        $validated->responden_id = $respondenId;
        Usulan::create([
            'responden_id' => $respondenId,
            'indikator_id' => $validated->indikator,
            'tingkat_bok' => $validated->tingkat_bok,
            'saran_kegiatan' => $validated->saran_kegiatan,
            'detail_kegiatan' => $validated->detail_kegiatan,
            'keriteria_penerima_bok' => $validated->keriteria_penerima_bok,
            'volume' => $validated->volume,
            'volume_satuan' => $validated->satuan,
            'frekuensi_tahun' => $validated->frekuensi_tahun,
            'anggaran' => $validated->anggaran,
            'output' => $validated->volume * $validated->frekuensi_tahun,
            'output_satuan' => $validated->satuan,
        ]);

        return redirect()->route('usulan.index')->with('success', 'Usulan berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $usulan = Usulan::findOrFail($id);
        $respondenId = session('responden_id');

        if ($usulan->responden_id != $respondenId) {
            return redirect()->route('usulan.index')->with('error', 'Tidak memiliki akses');
        }

        $usulan->delete();
        return redirect()->route('usulan.index')->with('success', 'Usulan berhasil dihapus');
    }

    public function cancel()
    {
        $respondenId = session('responden_id');

        if ($respondenId) {
            Usulan::where('responden_id', $respondenId)->delete();
            Responden::find($respondenId)->delete();
            session()->forget('responden_id');
        }

        return redirect()->route('usulan.index')->with('success', 'Semua usulan berhasil dibatalkan');
    }

    public function rekap(Request $request)
    {
        $query = Usulan::with(['responden', 'indikator']);

        // Filter
        if ($request->filled('tingkat')) {
            $query->where('tingkat', $request->tingkat);
        }

        if ($request->filled('indikator_id')) {
            $query->where('indikator_id', $request->indikator_id);
        }

        if ($request->filled('nama_responden')) {
            $query->whereHas('responden', function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->nama_responden . '%');
            });
        }

        if ($request->filled('instansi')) {
            $query->whereHas('responden', function ($q) use ($request) {
                $q->where('instansi', 'like', '%' . $request->instansi . '%');
            });
        }

        $usulanList = $query->orderBy('created_at', 'desc')->paginate(20);
        $indikators = Indikator::all();

        return view('usulan.rekap', compact('usulanList', 'indikators'));
    }

    public function indikator(Request $request)
    {
        $query = Indikator::query();

        // Global Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nomor', 'like', '%' . $search . '%')
                    ->orWhere('nama', 'like', '%' . $search . '%')
                    ->orWhere('tingkat', 'like', '%' . $search . '%')
                    ->orWhere('unit_timker', 'like', '%' . $search . '%');
            });
        }

        // Filter by tingkat
        if ($request->filled('tingkat')) {
            $query->where('tingkat', $request->tingkat);
        }

        // Filter by RENSTRA/RIBK/RPJMN
        if ($request->filled('filter_type')) {
            $filterType = $request->filter_type;
            if ($filterType === 'RENSTRA') {
                $query->where('is_RENSTRA', true);
            } elseif ($filterType === 'RIBK') {
                $query->where('is_RIBK', true);
            } elseif ($filterType === 'RPJMN') {
                $query->where('is_RPJMN', true);
            }
        }

        $indikators = $query->where('is_display', true)
            ->orderBy('nomor')
            ->paginate(20);

        return view('usulan.indikator', compact('indikators'));
    }
}
