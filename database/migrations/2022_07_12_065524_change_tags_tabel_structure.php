<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tags', function ($table) {
            $table->dropForeign(['post_id']);
            $table->dropColumn('post_id');
            $table->renameColumn('title', 'tag_title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tags', function ($table) {
            $table->dropForeign(['post_id']);
            $table->renameColumn('tag_title', 'title');
            $table->dropColumn('post_id');
        });
    }
};
