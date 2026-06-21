<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArtworkProgress extends Model
{
    use HasFactory;

    protected $table = 'artwork_progress';

    /**
     * Mass Assignment
     */
    protected $fillable = [
        'artwork_id',
        'stage',
        'image',
        'note',
        'approval_status',
    ];

    /**
     * Casting
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * RELATIONSHIP
     */

    // progress milik artwork
    public function artwork()
    {
        return $this->belongsTo(Artwork::class);
    }

    /**
     * ACCESSOR (AUTO URL GAMBAR)
     * jadi di blade cukup:
     * $progress->image_url
     */
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return asset('images/no-image.png');
        }

        return asset('uploads/artworks/' . $this->image);
    }

    /**
     * SCOPES (BIAR QUERY MU TERLIHAT SENIOR 😄)
     */

    public function scopeSketsa($query)
    {
        return $query->where('stage', 'sketsa');
    }

    public function scopeColor($query)
    {
        return $query->where('stage', 'color');
    }

    public function scopeFinal($query)
    {
        return $query->where('stage', 'final');
    }

    public function scopeLatestFirst($query)
    {
        return $query->latest();
    }
}
 