<?php

use App\Models\User;
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
        Schema::table('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
        });

        // Generate UUIDs for existing records
        $posts = User::all();
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('id');
        });
    }
};
