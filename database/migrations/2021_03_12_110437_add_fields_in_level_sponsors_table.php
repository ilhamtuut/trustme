<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsInLevelSponsorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('level_sponsors', function (Blueprint $table) {
            $table->double('old_omset',20,4)->default(0)->after('percent');
            $table->double('new_omset',20,4)->default(0)->after('old_omset');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('level_sponsors', function (Blueprint $table) {
            //
        });
    }
}
