<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('membership_id')->nullable()->after('email'); // Tambah kolom membership_id
            $table->foreign('membership_id')->references('id')->on('memberships')->onDelete('set null'); // Tambah foreign key
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['membership_id']); // Hapus foreign key dulu
            $table->dropColumn('membership_id');   // Baru drop kolom
        });
    }
};
