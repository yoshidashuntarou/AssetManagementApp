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

    public function showAssetList(Request $request)
    {   

        // dd($request->key_word);

        $haveChildrenAssetIdArray = array(); //子を持つ全てのデータのidを取得
        $parentAssetsArray = array(); //最高の親データをまとめる


        //子を持つ全ての親データを取得
        $lastAsset = Asset::orderBy('id', 'desc')->take(1)->first(); 
        if (!empty($lastAsset)) {
            $lastAssetId = $lastAsset->id;
        } else {
            $lastAssetId = 0;
        }

        for ($i = 1; $i <= $lastAssetId; $i++) {
            $asset = Asset::find($i);
            // dd(optional($asset)->parent_asset_id);
            if(optional($asset)->parent_asset_id != null) {
                $haveChildrenAssetIdArray[] = $asset->parent_asset_id;
            }
        }

        // dd($haveChildrenAssetIdArray);

        //上記で取得した親データに親がいなかったら$assetsArray[]に追加
        for ($i = 1; $i <= $lastAssetId; $i++) {
            for ($parentIdCount = 1; $parentIdCount <= count($haveChildrenAssetIdArray); $parentIdCount++) {
                if(in_array($i, $haveChildrenAssetIdArray)) {
                    // dd($parentIdArray);
                    goto firstLoop;
                }
            }
            $parentAssetsArray[] = Asset::find($i);
            firstLoop:
        }


        if (!empty($request->key_word)) {
            unset($parentAssetsArray[0]);
        }

        //ユーザー情報の取得
        $user = auth()->user();

        $data = [
            'id' => $user['id'],
            'name' => $user['name'],
            'room' => $user['room'],
            'email' => $user['email'],
            'assets' => $parentAssetsArray
        ];

        return view('app.list', $data);
    }


    public function showAssetRegisterForm()
    {
        return view('app.assetRegister');
    }


    public function showAssetDetail($asset_id)
    {
        $choseAsset = Asset::find($asset_id); //指定されたデータの取得

        //存在しないidを指定されたらlistにリダイレクト
        if ($choseAsset == null) {
            return redirect('list');
        }

        //子を持つ全ての親データを取得
        $lastAsset = Asset::orderBy('id', 'desc')->take(1)->first(); 
        if (!empty($lastAsset)) {
            $lastAssetId = $lastAsset->id;
        } else {
            $lastAssetId = 0;
        }

        $parentIdArray = array(); 
        for ($i = 1; $i <= $lastAssetId; $i++) {
            $asset = Asset::find($i);
            if(optional($asset)->parent_asset_id != null) {
                $parentIdArray[] = optional($asset)->parent_asset_id;
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
            'asset_owner' => 'required|string|max:255',
            'asset_user' => 'required|string|max:255',
            'place' => 'required|max:255',
            'asset_code' => 'required|max:255',
            'asset_name' => 'required|max:255',
            'acquisition_date' => 'required|date',
            'model' => 'required|max:255',
            'number_of_assets' => 'required|numeric',
            'operational_verification' => 'required|max:15'
        ]);

        //変更後のコード（最高の親のparent_asset_idを自分のidにする）
        // $lastId = Asset::all()->last()->id + 1;
        // $request['parent_asset_id'] = $lastId;

        $request['registered_user_id'] = auth()->id();



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
            'asset_owner' => 'required|string|max:255',
            'asset_user' => 'required|string|max:255',
            'place' => 'required|max:255',
            'asset_code' => 'required|max:255',
            'asset_name' => 'required|max:255',
            'acquisition_date' => 'required|date',
            'model' => 'required|max:255',
            'number_of_assets' => 'required|numeric',
            'operational_verification' => 'required|max:15'
        ]);


        $parentId = Asset::find($asset_id)->parent_asset_id;
        // dd($parentId);

        if($parentId == null) {
            $parentId = $asset_id;
        }

        $request['registered_user_id'] = auth()->id();
        $request['parent_asset_id'] = $asset_id; //ここを$parentIdにする

        $registeringAsset = new Asset;
        $registeringAsset->create($request->all());

        $lastAsset = Asset::orderBy('id', 'desc')->take(1)->first(); 
        if (!empty($lastAsset)) {
            $lastAssetId = $lastAsset->id;
        } else {
            $lastAssetId = 0;
        }


        return redirect(route('assetDetail', [
            'asset_id' => $lastAssetId,
        ]));
    }


    

    public function assetDelete($asset_id)
    {
        $haveChildrenAssetIdArray = array(); //子を持つ全てのデータのidを取得
        $parentAssetsIdArray = array(); //最高の親データをまとめる

        //子を持つ全ての親データを取得
        $lastAsset = Asset::orderBy('id', 'desc')->take(1)->first(); 
        if (!empty($lastAsset)) {
            $lastAssetId = $lastAsset->id;
        } else {
            $lastAssetId = 0;
        }


        for ($i = 1; $i <= $lastAssetId; $i++) {
            $asset = Asset::find($i);
            if(optional($asset)->parent_asset_id != null) {
                $haveChildrenAssetIdArray[] = $asset->parent_asset_id;
            }
        }

        //上記で取得した親データに親がいなかったら$parentAssetsArray[]に追加
        for ($i = 1; $i <= $lastAssetId; $i++) {
            for ($parentIdCount = 1; $parentIdCount <= count($haveChildrenAssetIdArray); $parentIdCount++) {
                if(in_array($i, $haveChildrenAssetIdArray)) {
                    // dd($parentIdArray);
                    goto firstLoop;
                }
            }
            $asset = Asset::find($i);
            $parentAssetsIdArray[] = optional($asset)->id;
            firstLoop:
        }

        //子も持つデータをurlパラメータに指定されたらlistにリダイレクトさせる
        if (!in_array($asset_id, $parentAssetsIdArray)) {
            return redirect('list');
        }


        $choseAsset = Asset::find($asset_id); //指定されたデータの取得     

        $deleteAssetsArray[] = $choseAsset;


        $parentAsset = Asset::find($choseAsset->parent_asset_id);
        while ($parentAsset != null) {
            $deleteAssetsArray[] = $parentAsset;
            $parentAsset = Asset::find($parentAsset->parent_asset_id);
        }


        for ($i = 0; $i < count($deleteAssetsArray); $i++) {
            // $deleteAssetId[] = $assetsArray[$i]->id;
            Asset::where('id', $deleteAssetsArray[$i]->id)->delete();
        }

        return redirect('list');

    }

    public function showAssetSearch()
    {
        return view('app.assetSearch');
    }

    public function assetSearch(Request $request)
    {        
        if ($request->search_conditions == 0) {
            $result = Asset::orWhere('asset_owner', $request->asset_owner)->orWhere('asset_user', $request->asset_user)->orWhere('place', $request->place)->orWhere('asset_code', $request->asset_code)->orWhere('asset_name', $request->asset_name)->orWhere('acquisition_date', $request->acquisition_date)->orWhere('model', $request->model)->orWhere('number_of_assets', $request->number_of_assets)->orWhere('operational_verification', $request->operational_verification)->get();
        } else if ($request->search_conditions == 1) {
            $result = Asset::get();
            // dd($result);
            if(!empty($request->asset_owner)) {
                $result = $result->where('asset_owner', $request->asset_owner);
            }
            if(!empty($request->asset_user)) {
                $result = $result->where('asset_user', $request->asset_user);
            }
            if(!empty($request->place)) {
                $result = $result->where('place', $request->place);
            }
            if(!empty($request->asset_code)) {
                $result = $result->where('asset_code', $request->asset_code);
            }
            if(!empty($request->asset_name)) {
                $result = $result->where('asset_name', $request->asset_name);
            }
            if(!empty($request->acquisition_date)) {
                $result = $result->where('acquisition_date', $request->acquisition_date);
            }
            if(!empty($request->model)) {
                $result = $result->where('model', $request->model);
            }
            if(!empty($request->number_of_assets)) {
                $result = $result->where('number_of_assets', $request->number_of_assets);
            }
            if(!empty($request->operational_verification)) {
                $result = $result->where('operational_verification', $request->operational_verification);
            }
            
            $result = $result->toArray();
            $result = array_merge($result);

        } else {
            return view('top');
        }


        for ($i = 0; $i < count($result); $i++) {
            $asset = Asset::where('parent_asset_id', $result[$i]['id'])->first();
            // dd($result[$i]['id']);
            if (!empty($asset)) {
                unset($result[$i]);
            }
        }



        $data = [
            'assets' => $result
        ];

        return view('app.list', $data);
    }

}
