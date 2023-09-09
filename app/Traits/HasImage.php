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
        return 'https://www.generationsforpeace.org/wp-content/uploads/2018/03/empty.jpg';
    }
}