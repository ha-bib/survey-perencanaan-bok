<?php

namespace App\Http\Controllers;

use App\Models\Usulan;
use App\Models\Indikator;
use App\Models\Responden;
use App\Models\UsulanReaction;
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
            'rincian_menu' => 'required|string',
            'detail_kegiatan' => 'required|string',
            'sasaran_rincian_menu' => 'required|string',
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
            'rincian_menu' => $validated->rincian_menu,
            'detail_kegiatan' => $validated->detail_kegiatan,
            'sasaran_rincian_menu' => $validated->sasaran_rincian_menu,
        ]);

        return redirect()->route('usulan.index')->with('success', 'Usulan berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $usulan = Usulan::findOrFail($id);
        $respondenId = session('responden_id');

        // SECURITY: Use strict comparison to prevent type coercion bypass
        if ((int)$usulan->responden_id !== (int)$respondenId) {
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
        $usulanList = Usulan::with(['responden', 'indikator', 'reactions'])
            ->withCount([
                'reactions as likes_count' => function ($q) {
                    $q->where('reaction', 'like');
                },
                'reactions as dislikes_count' => function ($q) {
                    $q->where('reaction', 'dislike');
                },
            ])
            ->orderBy('created_at', 'desc')
            ->get();

        $indikators = Indikator::all();
        
        // Convert to JSON-friendly array
        $usulanData = $usulanList->map(function ($usulan) {
            return [
                'id' => $usulan->id,
                'rincian_menu' => $usulan->rincian_menu,
                'detail_kegiatan' => $usulan->detail_kegiatan,
                'sasaran_rincian_menu' => $usulan->sasaran_rincian_menu,
                'tingkat_bok' => $usulan->tingkat_bok,
                'likes_count' => $usulan->likes_count,
                'dislikes_count' => $usulan->dislikes_count,
                'created_at' => $usulan->created_at->format('d/m/Y H:i'),
                'created_at_iso' => $usulan->created_at->toIso8601String(),
                'responden' => [
                    'nama' => $usulan->responden->nama,
                    'instansi' => $usulan->responden->instansi,
                    'jabatan' => $usulan->responden->jabatan,
                    'id' => $usulan->responden->id,
                ],
                'indikator' => [
                    'nomor' => $usulan->indikator->nomor,
                    'nama' => $usulan->indikator->nama,
                    'tingkat' => $usulan->indikator->tingkat,
                    'id' => $usulan->indikator->id,
                ],
            ];
        });

        return view('usulan.rekap', [
            'usulanJson' => json_encode($usulanData),
            'indikators' => $indikators,
            'totalUsulan' => $usulanList->count(),
            'totalLikes' => $usulanList->sum('likes_count'),
        ]);
    }

    public function react(Request $request, $id)
    {
        $request->validate([
            'reaction' => 'required|in:like,dislike',
        ]);

        $respondenId = session('responden_id');
        // SECURITY: Must be logged in (filled survey form)
        if (!$respondenId) {
            return response()->json(['message' => 'Harus mengisi survey untuk meng-like/dislike'], 403);
        }

        $usulan = Usulan::findOrFail($id);

        // SECURITY: Cannot like/dislike own usulan
        if ((int)$usulan->responden_id === (int)$respondenId) {
            return response()->json(['message' => 'Tidak bisa like/dislike usulan sendiri'], 403);
        }

        UsulanReaction::updateOrCreate(
            [
                'usulan_id' => $usulan->id,
                'responden_id' => $respondenId,
            ],
            [
                'reaction' => $request->reaction,
            ]
        );

        $likes = $usulan->reactions()->where('reaction', 'like')->count();
        $dislikes = $usulan->reactions()->where('reaction', 'dislike')->count();

        return response()->json([
            'likes' => $likes,
            'dislikes' => $dislikes,
        ]);
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
