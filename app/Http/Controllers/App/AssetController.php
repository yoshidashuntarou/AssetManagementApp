<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Asset;

class AssetController extends Controller
{
    public function showAssetList()
    {
        return view('app.list');
    }

    public function showAssetRegisterForm()
    {
        return view('app.assetRegister');
    }

    public function assetRegister(Request $request)
    {
        $request->validate([
            'administrator' => 'required|string|max:255',
            'place' => 'required|max:255',
            'asset_code' => 'required|max:255',
            'asset_name' => 'required|max:255',
            'acquisition_date' => 'required|date',
            'model' => 'required|max:255',
            'number_of_assets' => 'required|numeric',
            'operational_verification' => 'required|max:15'
        ]);

        Asset::create($request->all());

        return redirect('list');
    }
}
