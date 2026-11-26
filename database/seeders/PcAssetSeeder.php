<?php

namespace Database\Seeders;

use App\Models\PcAsset;
use App\Models\User;
use Illuminate\Database\Seeder;

class PcAssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (PcAsset::query()->exists()) {
            return;
        }

        $admin = User::query()->where('role', User::ROLE_ADMIN)->first();
        if (! $admin) {
            return;
        }

        $samples = [
            [
                'nomor_aset'       => 'AST-IT-001',
                'nama_departemen'  => 'IT',
                'tipe_perangkat'   => 'Workstation',
                'merk_spesifikasi' => 'Dell Precision 3660, Intel Core i7-12700, 32GB RAM, 1TB SSD',
                'nomor_seri'       => 'SN-DELL-88391',
                'status_kondisi'   => 'Baik',
            ],
            [
                'nomor_aset'       => 'AST-HRD-002',
                'nama_departemen'  => 'HRD',
                'tipe_perangkat'   => 'Laptop',
                'merk_spesifikasi' => 'Lenovo ThinkPad E14, Intel Core i5-1135G7, 16GB RAM, 512GB SSD',
                'nomor_seri'       => 'SN-LNV-22910',
                'status_kondisi'   => 'Baik',
            ],
            [
                'nomor_aset'       => 'AST-FIN-003',
                'nama_departemen'  => 'Finance',
                'tipe_perangkat'   => 'PC Desktop',
                'merk_spesifikasi' => 'HP ProDesk 400 G7, Intel Core i5-10500, 8GB RAM, 256GB SSD',
                'nomor_seri'       => 'SN-HP-44102',
                'status_kondisi'   => 'Rusak Ringan',
            ],
            [
                'nomor_aset'       => 'AST-OPS-004',
                'nama_departemen'  => 'Operasional',
                'tipe_perangkat'   => 'All-in-One PC',
                'merk_spesifikasi' => 'Asus Vivo AiO V241, Intel Core i3-1115G4, 8GB RAM, 512GB SSD',
                'nomor_seri'       => 'SN-ASUS-99120',
                'status_kondisi'   => 'Dalam Perbaikan',
            ],
            [
                'nomor_aset'       => 'AST-MKT-005',
                'nama_departemen'  => 'Marketing',
                'tipe_perangkat'   => 'Laptop',
                'merk_spesifikasi' => 'MacBook Pro 14 M2, 16GB Unified Memory, 512GB SSD',
                'nomor_seri'       => 'SN-APL-77412',
                'status_kondisi'   => 'Baik',
            ],
            [
                'nomor_aset'       => 'AST-IT-006',
                'nama_departemen'  => 'IT',
                'tipe_perangkat'   => 'Workstation',
                'merk_spesifikasi' => 'HP Z4 G4, Intel Xeon W-2223, 64GB RAM, 2TB SSD',
                'nomor_seri'       => 'SN-HPZ-33291',
                'status_kondisi'   => 'Rusak Berat',
            ],
        ];

        foreach ($samples as $sample) {
            $admin->pcAssets()->create($sample);
        }
    }
}
