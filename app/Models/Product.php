<?php

namespace App\Models;

use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    use HasImage;

    protected $fillable = [
        'team_id',
        'user_id',
        'name',
        'sku',
        'description',
        'specification',
        'photo_path',
    ];

    protected $casts = [
        'created_at' => "datetime:F d, Y",
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    protected $appends = [
        'photo_path',
    ];
}
