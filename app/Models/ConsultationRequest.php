<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConsultationRequest extends Model
{
    use HasFactory;

    protected $fillable = ['full_name', 'organisation', 'email', 'phone', 'organisation_type', 'service_id', 'message', 'preferred_contact_method'];

    protected function casts(): array
    {
        return [];
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
