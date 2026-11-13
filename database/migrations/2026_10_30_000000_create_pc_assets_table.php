<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('pc_assets', function (Blueprint $table) {
            $table->id();                                        
            $table->string('nomor_aset', 30)->unique();          
            $table->string('nama_departemen', 100);              
            $table->string('tipe_perangkat', 30);                
            $table->string('merk_spesifikasi');                  
            $table->string('nomor_seri', 60);
            $table->string('status_kondisi', 30)->default('Baik');
            $table->timestamps();                                
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('pc_assets');
    }
};
