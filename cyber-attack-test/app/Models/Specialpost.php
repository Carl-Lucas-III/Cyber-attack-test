<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialpost extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description'];
    protected $table = 'specialposts'; // specify the table name
}
