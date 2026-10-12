<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminSiteSettingController extends Controller
{
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'tagline' => ['nullable', 'string', 'max:180'],
            'mission' => ['nullable', 'string', 'max:500'],
            'email' => ['required', 'email:rfc', 'max:180'],
            'phone_displays' => ['required', 'array', 'min:1', 'max:3'],
            'phone_displays.*' => ['required', 'string', 'max:30'],
            'phone_values' => ['required', 'array', 'size:'.count($request->input('phone_displays', []))],
            'phone_values.*' => ['required', 'regex:/^\+[1-9][0-9]{7,14}$/'],
            'whatsapp' => ['required', 'url:http,https', 'max:255'],
            'address' => ['required', 'string', 'max:500'],
            'map_query' => ['required', 'string', 'max:255'],
        ]);

        $validated['phones'] = array_combine($validated['phone_displays'], $validated['phone_values']);
        unset($validated['phone_displays'], $validated['phone_values']);

        SiteSetting::query()->updateOrCreate(['id' => 1], $validated);

        foreach ($validated as $key => $value) {
            config()->set("site.{$key}", $value);
        }

        return back()->with('status', 'Site settings saved. The public website now uses these details.');
    }
}
