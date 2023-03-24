<?php

use App\Models\Specialpost;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Ramsey\Uuid\Uuid;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('specialposts', function (Blueprint $table) {
            $table->uuid('id')->primary();
        });

        // Generate UUIDs for existing records
        $posts = Specialpost::all();
        foreach ($posts as $post) {
            $post->id = Uuid::uuid4();
            $post->save();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('specialposts', function (Blueprint $table) {
            $table->dropColumn('id');
        });
    }
};
