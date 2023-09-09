<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Blog extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getImageAttribute($value)
    {
        $storage = Storage::disk('public');
        
        if(!empty($value) && $storage->exists($value)) {
            return Storage::disk('public')->url($value);
        }

        return $value;
    }

}
