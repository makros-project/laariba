<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAnggotaIdToIuransTable extends Migration
{
    public function up()
    {
        Schema::table('iurans', function (Blueprint $table) {
            $table->foreignId('anggota_id')->constrained('anggota')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('iurans', function (Blueprint $table) {
            $table->dropForeign(['anggota_id']);
            $table->dropColumn('anggota_id');
        });
    }
}
