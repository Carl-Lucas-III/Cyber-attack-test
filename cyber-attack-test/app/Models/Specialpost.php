<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Specialpost extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description'];
    protected $table = 'specialposts'; // specify the table name

    public $incrementing = false;

    protected $keyType = 'string';

    protected $primaryKey = 'id';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Uuid::uuid4()->toString();
        });
    }
}
