<?php

use App\Models\Post;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Ramsey\Uuid\Uuid;

class AddUuidToPostsTable extends Migration
{
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->uuid('id')->primary();
        });

        // Generate UUIDs for existing records
        $posts = Post::all();
        foreach ($posts as $post) {
            $post->id = Uuid::uuid4();
            $post->save();
        }
    }

    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('id');
        });
    }
}
