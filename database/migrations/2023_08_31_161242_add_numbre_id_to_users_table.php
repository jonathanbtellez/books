<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

			//Check if the column not exist
            if(Schema::hasTable('users') && !Schema::hasColumn('users','number_id')){
				// 1. create column
				// 2. Indicate where the column going to be insert
				// 3. the column can be null
				$table->string('number_id')->after('id')->nullable();
			}
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
		//Check if the column exist
        Schema::table('users', function (Blueprint $table) {
			if(Schema::hasTable('users') && Schema::hasColumn('users','number_id')){
				$table->dropColumn('number_id');
			}
        });
    }
};
