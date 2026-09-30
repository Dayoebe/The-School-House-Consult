<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Support\RichText;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminProgramController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $request->merge([
            'slug' => $request->filled('slug') ? Str::slug($request->string('slug')->toString()) : Str::slug($request->string('title')->toString()),
            'description' => RichText::sanitize($request->string('description')->toString()),
        ]);
        $validated = $this->validatedProgram($request);
        unset($validated['featured_image_upload'], $validated['remove_featured_image'], $validated['gallery_images'], $validated['remove_gallery_images']);

        if ($request->hasFile('featured_image_upload')) {
            $validated['featured_image'] = 'storage/'.$request->file('featured_image_upload')->store('programs', 'public');
        }

        $program = Program::create($validated);
        $this->storeGalleryImages($request, $program);

        return back()->with('status', 'Programme created. Its public visibility follows the selected status.');
    }

    public function update(Request $request, int $programId): RedirectResponse
    {
        $program = Program::query()->findOrFail($programId);
        $request->merge([
            'slug' => $request->filled('slug') ? Str::slug($request->string('slug')->toString()) : Str::slug($request->string('title')->toString()),
            'description' => RichText::sanitize($request->string('description')->toString()),
        ]);
        $validated = $this->validatedProgram($request, $program);
        unset($validated['featured_image_upload'], $validated['remove_featured_image'], $validated['gallery_images'], $validated['remove_gallery_images']);

        if ($request->boolean('remove_featured_image')) {
            $this->deleteManagedImage($program->featured_image);
            $validated['featured_image'] = null;
        }
        if ($request->hasFile('featured_image_upload')) {
            $this->deleteManagedImage($program->featured_image);
            $validated['featured_image'] = 'storage/'.$request->file('featured_image_upload')->store('programs', 'public');
        }

        $program->update($validated);
        $this->removeSelectedGalleryImages($request, $program);
        $this->storeGalleryImages($request, $program);

        return back()->with('status', $program->title.' updated on the website.');
    }

    public function destroy(int $programId): RedirectResponse
    {
        $program = Program::query()->findOrFail($programId);
        $title = $program->title;
        $this->deleteManagedImage($program->featured_image);
        $program->images()->each(fn ($image) => $this->deleteManagedImage($image->path));
        $program->delete();

        return back()->with('status', $title.' deleted.');
    }

    private function validatedProgram(Request $request, ?Program $program = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'slug' => ['required', 'string', 'max:200', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/', Rule::unique('programs', 'slug')->ignore($program)],
            'description' => ['required', 'string', 'max:10000', function (string $attribute, mixed $value, \Closure $fail): void {
                if (RichText::plainText((string) $value) === '') {
                    $fail('The programme description field is required.');
                }
            }],
            'target_audience' => ['nullable', 'string', 'max:500'],
            'duration' => ['nullable', 'string', 'max:180'],
            'status' => ['required', Rule::in(['draft', 'published'])],
            'featured_image_upload' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'remove_featured_image' => ['nullable', 'boolean'],
            'gallery_images' => ['nullable', 'array', 'max:12'],
            'gallery_images.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'remove_gallery_images' => ['nullable', 'array'],
            'remove_gallery_images.*' => ['integer'],
        ]);
    }

    private function storeGalleryImages(Request $request, Program $program): void
    {
        $nextOrder = (int) $program->images()->max('sort_order') + 1;
        foreach ($request->file('gallery_images', []) as $file) {
            $program->images()->create([
                'path' => 'storage/'.$file->store('programs/gallery', 'public'),
                'sort_order' => $nextOrder++,
            ]);
        }
    }

    private function removeSelectedGalleryImages(Request $request, Program $program): void
    {
        $images = $program->images()->whereKey($request->input('remove_gallery_images', []))->get();
        foreach ($images as $image) {
            $this->deleteManagedImage($image->path);
            $image->delete();
        }
    }

    private function deleteManagedImage(?string $path): void
    {
        if ($path && str_starts_with($path, 'storage/programs/')) {
            Storage::disk('public')->delete(Str::after($path, 'storage/'));
        }
    }
}
