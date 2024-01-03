<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDateAttendanceToLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lessons', function (Blueprint $table) {
            if(!Schema::hasColumn('lessons', 'date_attendance')) {
                $table->date('date_attendance')->nullable()->default(NULL);
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lessons', function (Blueprint $table) {
            if(Schema::hasColumn('lessons', 'date_attendance')) {
                $table->dropColumn('date_attendance');
            }
        });
    }
}
