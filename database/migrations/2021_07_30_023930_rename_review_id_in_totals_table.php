<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameReviewIdInTotalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('totals', function (Blueprint $table) {
            $table->renameColumn('review_id','company_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('totals', function (Blueprint $table) {
            
            $table->renameColumn('company_id','review_id');
        });
    }
}

