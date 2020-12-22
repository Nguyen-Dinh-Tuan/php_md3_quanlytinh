<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Customer;
use Illuminate\Http\Request;
use voku\helper\ASCII;

class CustomerController extends Controller
{
    public function create()
    {
        $cities =  City::all();
        return view('customers.create', compact('cities'));
    }
    public function store(Request $request)
    {
        $customer = new Customer();
        $customer->name = $request->input('name');
        $customer->email= $request->input('email');
        $customer->dob = $request->input('dob');
        $customer->city_id = $request->input('city_id');
        $customer->save();

        return redirect()->route('customers.index');

    }
    public function index()
    {
//        $customers = Customer::all();
//        $cities = City::all();
//        return view('customers.list', compact('customers', 'cities'));
        $customers = Customer::all();
        $cities = City::all();
        return view('customers.list', compact('customers', 'cities'));
    }

    public function filterByCity(Request $request)
    {
        $idCity = $request->input('city_id');
        $cityFilter = City::findOrFail($idCity);
        $customers = Customer::where('city_id', $cityFilter->id)->get();
        $totalCustomerFilter = count($customers);
        $cities = City::all();

        return view('customers.list', compact('customers', 'cities', 'totalCustomerFilter', 'cityFilter'));



    }



    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        $cities =City::all();

        return view('customers.edit', compact('customer', 'cities'));
    }
    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->name = $request->input('name');
        $customer->email = $request->input('email');
        $customer->dob = $request->input('dob');
        $customer->city_id = $request->input('city_id');
        $customer->save();

        return redirect()->route('customers.index');
    }
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return redirect()->route('customers.index');
    }


}
