<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'tagline', 'mission', 'email', 'phones', 'whatsapp', 'address', 'map_query'])]
class SiteSetting extends Model
{
    protected function casts(): array
    {
        return [
            'phones' => 'array',
        ];
    }
}
