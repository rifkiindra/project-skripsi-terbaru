<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Artwork extends Model
{
    use HasFactory;

    protected $table = 'artworks';

    protected $fillable = [
    'member_id',
    'team_id',
    'judul',
    'klien',
    'kategori',
    'member_id',
    'start',
    'deadline',
    'status',
    'is_archived',
    'sketsa_image',
    'color_image',
    'final_image',
    'hasil',
    'hasil_url',
    'gambar',
];

 protected $attributes = [
    'is_archived' => 0,
];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function setJudulAttribute($value)
    {
        $this->attributes['judul'] = ucwords($value);
    }

    public function setKategoriAttribute($value)
    {
        $this->attributes['kategori'] = strtolower($value);
    }

    public function team()
    {
        return $this->belongsTo(User::class, 'team_id');
    }

     public function progresses()
    {
        return $this->hasMany(ArtworkProgress::class);
    }

    public function latestProgress()
    {
        return $this->hasOne(ArtworkProgress::class)->latestOfMany();
    }

}
