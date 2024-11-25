<?php

namespace App\Http\Controllers\Panel;

use App\City;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CityController extends Controller
{

    public function dashboard()
    {
        $country_groups = \DB::table('country_groups')
            ->when(auth()->user()->country_group != null, function($query){
                return $query->where('id', auth()->user()->country_group);
            })
            ->when(auth()->user()->country_group == null, function($query){
                return $query->whereIn('code', ['ro','bg','ru', 'tr']);
            })
            ->get();
        return view('panel.city.dashboard', compact('country_groups'));
    }

    public function index($country_group_code)
    {
        $country_group = \DB::table('country_groups')
            ->where('code', $country_group_code)
            ->first();
        if(!auth()->user()->country_group == null && auth()->user()->country_group != $country_group->id){
            abort(404);
        }
        $cities = City::where('country_group', $country_group_code)->get();
        return view('panel.city.index', compact('cities', 'country_group', 'country_group_code'));
    }

    public function edit($country_group_code, $slug )
    {
        $country_group = \DB::table('country_groups')
            ->where('code', $country_group_code)
            ->first();
        if(!auth()->user()->country_group == null && auth()->user()->country_group != $country_group->id){
            abort(404);
        }
        $city = City::where('country_group', $country_group_code)->where('slug', $slug)->first();
        return view('panel.city.edit', compact('city', 'country_group', 'country_group_code'));
    }

    public function store($country_group_code, Request $request)
    {
        $request_data = $request->input('city');
        $data = [
            'native' => $request_data['native'],
            'en' => $request_data['en'],
            'slug' => \Str::slug($request_data['en'], '-'),
            'country_group' => $country_group_code
        ];
        City::create($data);
        return redirect()->back()->with('success', 'City added successfully');
    }

    public function update(Request $request)
    {
        $city_id = $request->input('city_id');
        $zone = $request->input('country_group');
        $request_data = $request->input('city');
        $data = [
            'native' => $request_data['native'],
            'en' => $request_data['en']
        ];
        City::where('id', $city_id)->update($data);
        return redirect()->route('panel.city.index', ['country_group_code'=>$zone])->with('success', 'City edit successfully');
    }

    public function delete($id)
    {
        City::where('id', $id)->delete();
        return redirect()->back()->with('success', 'City removed successfully');
    }
}
