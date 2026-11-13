<?php

namespace App\Http\Controllers;

use App\Models\PcAsset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PcAssetController extends Controller
{
    
    private function rules(?int $ignoreId = null): array
    {
        return [
            'nomor_aset'       => ['required', 'string', 'max:30', Rule::unique('pc_assets', 'nomor_aset')->ignore($ignoreId)],
            'nama_departemen'  => ['required', 'string', 'max:100'],
            'tipe_perangkat'   => ['required', Rule::in(PcAsset::TIPE_PERANGKAT)],
            'merk_spesifikasi' => ['required', 'string', 'max:255'],
            'nomor_seri'       => ['required', 'string', 'max:60'],
            'status_kondisi'   => ['required', Rule::in(PcAsset::STATUS_KONDISI)],
        ];
    }

    
    private function messages(): array
    {
        return [
            'required' => ':attribute wajib diisi.',
            'max'      => ':attribute maksimal :max karakter.',
            'unique'   => ':attribute sudah terdaftar, gunakan yang lain.',
            'in'       => ':attribute tidak valid.',
        ];
    }

    
    public function index(): View
    {
        $assets = PcAsset::latest()->paginate(10);   

        return view('pc_assets.index', compact('assets'));
    }

    
    public function create(): View
    {
        return view('pc_assets.create');
    }

    
    public function store(Request $request): RedirectResponse
    {
        
        $validated = $request->validate($this->rules(), $this->messages());

        PcAsset::create($validated);   

        return redirect()->route('pc-assets.index')
            ->with('success', 'Aset ' . $validated['nomor_aset'] . ' berhasil ditambahkan.');
    }

    
    public function show(PcAsset $pcAsset): View
    {
        return view('pc_assets.show', compact('pcAsset'));
    }

    
    public function edit(PcAsset $pcAsset): View
    {
        return view('pc_assets.edit', compact('pcAsset'));
    }

    
    public function update(Request $request, PcAsset $pcAsset): RedirectResponse
    {
        $validated = $request->validate($this->rules($pcAsset->id), $this->messages());

        $pcAsset->update($validated);

        return redirect()->route('pc-assets.index')
            ->with('success', 'Aset ' . $pcAsset->nomor_aset . ' berhasil diperbarui.');
    }

    
    public function destroy(PcAsset $pcAsset): RedirectResponse
    {
        $nomor = $pcAsset->nomor_aset;
        $pcAsset->delete();

        return redirect()->route('pc-assets.index')
            ->with('success', 'Aset ' . $nomor . ' berhasil dihapus.');
    }
}
