<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminServiceController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $request->merge(['slug' => $request->filled('slug') ? Str::slug($request->string('slug')->toString()) : Str::slug($request->string('title')->toString())]);
        $validated = $this->validatedService($request);
        $validated['activities'] = $this->activities($validated['activities']);
        $validated['is_active'] = $request->boolean('is_active');

        Service::create($validated);

        return back()->with('status', 'Service created. Its public visibility follows the selected status.');
    }

    public function update(Request $request, int $serviceId): RedirectResponse
    {
        $service = Service::query()->findOrFail($serviceId);
        $request->merge(['slug' => $request->filled('slug') ? Str::slug($request->string('slug')->toString()) : Str::slug($request->string('title')->toString())]);
        $validated = $this->validatedService($request, $service);
        $validated['activities'] = $this->activities($validated['activities']);
        $validated['is_active'] = $request->boolean('is_active');

        $service->update($validated);

        return back()->with('status', $service->title.' updated on the website.');
    }

    public function destroy(int $serviceId): RedirectResponse
    {
        $service = Service::query()->findOrFail($serviceId);
        $title = $service->title;
        $service->delete();

        return back()->with('status', $title.' deleted.');
    }

    private function validatedService(Request $request, ?Service $service = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:160'],
            'slug' => ['required', 'string', 'max:180', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/', Rule::unique('services', 'slug')->ignore($service)],
            'category' => ['required', Rule::in(array_keys(config('site.service_groups')))],
            'icon' => ['required', Rule::in(['book', 'building', 'chat', 'compass', 'document', 'growth', 'heart', 'leadership', 'people', 'research', 'story', 'technology'])],
            'description' => ['required', 'string', 'max:1500'],
            'introduction' => ['required', 'string', 'max:5000'],
            'activities' => ['required', 'string', 'max:8000'],
            'audience' => ['required', 'string', 'max:1500'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:999'],
            'is_active' => ['nullable', 'boolean'],
        ]);
    }

    private function activities(string $activities): array
    {
        return collect(preg_split('/\r\n|\r|\n/', $activities))
            ->map(fn (string $activity): string => trim($activity))
            ->filter()
            ->values()
            ->all();
    }
}
