<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'role', 'biography', 'photograph', 'email', 'phone', 'social_links', 'publish_contact', 'is_active', 'sort_order'];

    protected function casts(): array
    {
        return ['social_links' => 'array', 'publish_contact' => 'boolean', 'is_active' => 'boolean'];
    }
}
