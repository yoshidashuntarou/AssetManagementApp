<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Asset;
use App\Models\User;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Auth;

class AssetController extends Controller
{

        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showAssetList()
    {   
        $parentIdArray = array(); //子を持つ全てのデータのidを取得
        $assetsArray = array(); //最新の子のデータをまとめる

        for ($i = 1; $i <= Asset::count(); $i++) {
            $asset = Asset::find($i);
            if(optional($asset)->parent_asset_id != null) {
                $parentIdArray[] = $asset->parent_asset_id;
            }
        }

        for ($i = 1; $i <= Asset::count(); $i++) {
            for ($parentIdCount = 1; $parentIdCount <= count($parentIdArray); $parentIdCount++) {
                if(in_array($i, $parentIdArray)) {
                    // dd($parentIdArray);
                    goto firstLoop;
                }
            }
            $assetsArray[] = Asset::find($i);
            firstLoop:
        }


        //ユーザー情報の取得
        $user = auth()->user();

        $data = [
            'id' => $user['id'],
            'name' => $user['name'],
            'room' => $user['room'],
            'email' => $user['email'],
            'assets' => $assetsArray
        ];
        return view('app.list', $data);
    }


    public function showAssetRegisterForm()
    {

        return view('app.assetRegister');
        // return redirect(route('assetRegister'));
    }


    public function showAssetDetail($asset_id)
    {
        $choseAsset = Asset::find($asset_id); //指定されたデータの取得

        //存在しないidを指定されたらlistにリダイレクト
        if ($choseAsset == null) {
            return redirect('list');
        }

        //子を持つ全てのデータを取得
        $parentIdArray = array(); 
        for ($i = 1; $i <= Asset::count(); $i++) {
            $asset = Asset::find($i);
            if($asset->parent_asset_id != null) {
                $parentIdArray[] = $asset->parent_asset_id;
            }
        }

        //子も持つデータをurlパラメータに指定されたらlistにリダイレクトさせる
        if (in_array($asset_id, $parentIdArray)) {
            return redirect('list');
        }

        $assetsArray = array();
        $assetsArray[] = $choseAsset;


        $parentAsset = Asset::find($choseAsset->parent_asset_id);
        while ($parentAsset != null) {
            $assetsArray[] = $parentAsset;
            $parentAsset = Asset::find($parentAsset->parent_asset_id);
        }


        return view('app.assetDetail', ['assets' => $assetsArray]);
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

        $request['registered_person_id'] = auth()->id();

        $registeringAsset = new Asset;
        $registeringAsset->create($request->all());

        return redirect('list');
    }


    public function showAssetEdit($asset_id)
    {
        $choseAsset = Asset::find($asset_id);
        $childAsset = Asset::where('parent_asset_id', $choseAsset->id)->first();

        if ($childAsset != null) {
            return redirect('list');
        }

        return view('app.assetEdit', ['asset' => $choseAsset, 'asset_id' => $asset_id]);
    }


    public function assetEdit(Request $request, $asset_id)
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


        $request['registered_person_id'] = auth()->id();
        $request['parent_asset_id'] = $asset_id;

        $registeringAsset = new Asset;
        $registeringAsset->create($request->all());

        return redirect(route('assetDetail', [
            'asset_id' => Asset::count(),
        ]));
    }


    public function showUserEdit()
    {
        $user = auth()->user();

        return view('app.userEdit', ['user' => $user]);
    }


    public function userEdit(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'room' => ['max:255'],
        ]);

        $user = auth()->user();
        $user->name = $request->name;
        $user->room = $request->room;
        $user->save();

        return redirect('user');
    }

    

}
