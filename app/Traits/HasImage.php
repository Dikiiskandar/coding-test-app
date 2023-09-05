<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

trait HasImage {

    public function photoPath(): Attribute 
    {
        return Attribute::get(function () {
            return $this->attributes['photo_path']
                    ? Storage::disk('public')->url($this->attributes['photo_path'])
                    : $this->defaultPhotoUrl();
        });
    }

    protected function defaultPhotoUrl()
    {
        return 'https://img.freepik.com/free-vector/illustration-gallery-icon_53876-27002.jpg?w=1380&t=st=1693939276~exp=1693939876~hmac=a2b5fb99876e5cf6383586a475a7d1ea76ff070d7cf3fed23a818aa7b433d1a1';
    }
}