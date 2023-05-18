<?php

namespace App\Http\Controllers;

use App\Models\Furniture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\DetailResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\FurnitureResource;

class FurnitureController extends Controller
{
    public function index()
    {
        $furniture = Furniture::all();
        return DetailResource::collection($furniture->loadMissing('seller_name:id,username'));
    }

    public function show($id)
    {
        $furnitures = Furniture::with('seller_name:id,username')->findOrFail($id);
        return new DetailResource($furnitures);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required'
        ]);

        $image = null;
        if ($request->file){
            $fileName = $this->generateRandomString();

            $extension = $request->file->extension();

            $image = $fileName.'.'.$extension;

            Storage::putFileAs('image', $request->file, $image);
        }

        $request['image'] = $image;

        $request['seller'] = Auth::user()->id;
        $furniture = Furniture::create($request->all());
        return new DetailResource($furniture->loadMissing('seller_name:id,username'));
    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required'
        ]);
        $furniture = Furniture::findOrFail($id);
        $furniture->update($request->all());

        return new DetailResource($furniture->loadMissing('seller_name:id,username'));   
    }

    public function destroy($id)
    {
        $furniture = Furniture::findOrFail($id);
        $furniture->delete();

        return new DetailResource($furniture->loadMissing('seller_name:id,username'));           
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}