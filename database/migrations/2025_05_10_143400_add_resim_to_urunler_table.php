<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddResimToUrunlerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('urun', function (Blueprint $table) {
        $table->string('resim')->nullable();
    });
}

public function down()
{
    Schema::table('urun', function (Blueprint $table) {
        $table->dropColumn('resim');
    });
}

}
