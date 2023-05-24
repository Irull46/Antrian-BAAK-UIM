<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePanggilansTable extends Migration
{
    public function up()
    {
        Schema::create('panggilans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('posisi_teller_id')->nullable()->constrained('posisi_tellers')->onDelete('set null');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('antrian_id')->nullable()->constrained('antrians')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengguna_antrians');
    }
}
