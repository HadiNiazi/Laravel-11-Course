<?php

namespace App\Models;

use App\Models\Scopes\PublishedScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Post extends Model
{
    use HasFactory;

    // protected $table = 'blog_posts';

    // protected $primaryKey = 'post_id';

    protected $fillable = ['user_id', 'title', 'description', 'status', 'image'];

    // protected $guarded = [];

    protected function title(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucfirst($value),
            // get: fn (string $value) => strtoupper($value),
            set: fn (string $value) => strtolower($value),

        );
    }

    // protected static function booted()
    // {
    //     static::addGlobalScope(new PublishedScope);
    // }

    // protected static function booted()
    // {
    //     static::addGlobalScope('ancient', function (Builder $builder) {
    //         $builder->where('status', 1);
    //     });
    // }

    // === local scope   === //

    protected function scopePublished($query)
    {
        $query->where('status', 1);
    }

    protected function casts(): array
    {
        return [
            'status' => 'boolean'
        ];
    }

    // protected $hidden = ['image', 'status'];

    protected $visible = ['title', 'description'];

    public function user()
    {
        // user_id
        // return $this->belongsTo(User::class, 'user_id', 'id');
        return $this->belongsTo(User::class);
    }

    // public function users():BelongsToMany
    // {
    //     return $this->belongsToMany(User::class, 'post_user', 'user_id', 'post_id');
    // }

    public function users():BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

}
