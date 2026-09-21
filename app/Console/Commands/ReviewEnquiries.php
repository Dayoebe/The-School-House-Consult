<?php

namespace App\Console\Commands;

use App\Models\ConsultationRequest;
use App\Models\ContactMessage;
use Illuminate\Console\Command;

class ReviewEnquiries extends Command
{
    protected $signature = 'site:enquiries {type=consultations : consultations or messages} {--id= : Read one enquiry}';

    protected $description = 'Review private website enquiries from the server console';

    public function handle(): int
    {
        $model = match ($this->argument('type')) {
            'consultations' => ConsultationRequest::class,
            'messages' => ContactMessage::class,
            default => null,
        };
        if (! $model) {
            $this->error('Choose consultations or messages.');

            return self::INVALID;
        }
        if ($id = $this->option('id')) {
            $enquiry = $model::find($id);
            if (! $enquiry) {
                $this->error('Enquiry not found.');

                return self::FAILURE;
            }
            $this->table(['Field', 'Value'], collect($enquiry->getAttributes())->map(fn ($value, $key) => [$key, strip_tags((string) $value)])->all());

            return self::SUCCESS;
        }
        $this->table(['ID', 'Name', 'Status', 'Received'], $model::latest()->limit(50)->get()->map(fn ($item) => [$item->id, strip_tags($item->full_name), $item->status, $item->created_at->toDateTimeString()])->all());

        return self::SUCCESS;
    }
}
