<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Maskapai extends Model
{
    use HasFactory;

    protected $table = 'maskapai'; 
    protected $fillable = ['slug', 'nama_maskapai', 'logo'];

    // Optionally, we can add the following to make sure the slug is generated before saving
    public static function boot()
    {
        parent::boot();

        // Automatically generate the slug when creating or updating a Maskapai record
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->nama_maskapai);
                $existingSlugCount = Maskapai::where('slug', 'LIKE', "{$model->slug}%")->count();
                if ($existingSlugCount > 0) {
                    $model->slug .= '-' . ($existingSlugCount + 1);
                }
            }
        });
    }
}
