<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Rawilk\Settings\Facades\Settings;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function settings()
    {
        return view('admin.settings');
    }

    public function settings_data(Request $request)
    {
        // dd($request->all());
        $fb = $request->fb;
        $tw = $request->tw;
        $logo = time() . rand() . $request->file('logo')->getClientOriginalName();
        $request->file('logo')->move(public_path('uploads/images'));

        settings([
            'fb' => $fb,
            'tw' => $tw,
            'logo' => $logo,
        ]);

        return redirect()->back();
    }
}
