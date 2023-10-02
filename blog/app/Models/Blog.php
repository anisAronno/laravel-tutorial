<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

    public function getExcerptAttribute()
    {
        return Str::limit($this->description, Post::EXCERPT_LENGTH);
    }

    public function getNextAttribute()
    {
        return static::select('id', 'title')->where('id', '>', $this->id)->orderBy('id', 'asc')->first();
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function getPreviousAttribute()
    {
        return static::select('id', 'title')->where('id', '<', $this->id)->orderBy('id', 'desc')->first();
    }

    public function user(): BelongsTo
    {
        return  $this->belongsTo(User::class, 'user_id', 'id');
    }

}
