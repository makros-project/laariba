<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePinjamanTable extends Migration
{
    public function up()
    {
        Schema::create('pinjaman', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('anggota_id');
            $table->decimal('jumlah', 15, 2);
            $table->date('tanggal_pinjam');
            $table->date('tanggal_jatuh_tempo');
            $table->string('status');
            $table->timestamps();

            $table->foreign('anggota_id')->references('id')->on('anggotas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pinjaman');
    }

}
