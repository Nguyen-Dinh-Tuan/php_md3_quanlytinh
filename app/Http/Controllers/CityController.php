<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index(){
        $cities = City::all();
        return view('cities.list', compact('cities'));
    }
    public function create(){
        return view('cities.create');
    }
    public function store(Request $request){
        $city = new City();
        $city->name = $request->input('name');
        $city->save();

        return redirect()->route('cities.index');
    }
    public function edit($id)
    {
        $city = City::findOrFail($id);
        return view('cities.edit', compact('city'));
    }
    public function update(Request $request,$id)
    {
        $city= City::find($id);
        $city->fill($request->all());
        $city->name = $request->input('name');
        $city->save();
        return redirect()->route('cities.index');

    }
    public function delete($id)
    {
        $city = City::find($id);
        $city->customers()->delete();
        $city->delete();
        return redirect()->route('cities.index');
    }
}
