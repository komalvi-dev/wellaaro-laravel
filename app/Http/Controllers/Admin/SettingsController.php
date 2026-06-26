<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function show()
    {
        $settings = SiteSetting::orderBy('group')->orderBy('key')->get()->groupBy('group');

        return view('admin.settings.show', compact('settings'));
    }

    public function update(Request $request)
    {
        $settingsData = $request->validate([
            'settings'   => 'required|array',
            'settings.*' => 'nullable|string',
        ]);

        $allowedKeys = SiteSetting::pluck('key')->all();

        foreach ($settingsData['settings'] as $key => $value) {
            if (!in_array($key, $allowedKeys, true)) {
                continue;
            }
            SiteSetting::set($key, $value, auth()->id());
        }

        return redirect()->route('admin.settings.show')
            ->with('success', 'Settings saved successfully.');
    }
}
