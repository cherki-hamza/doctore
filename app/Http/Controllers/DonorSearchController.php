<?php

namespace App\Http\Controllers;

use App\Http\Requests\DonorSearchRequest;
use App\Models\BloodGroup;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;

class DonorSearchController extends Controller
{


    public function index(Request $request)
    {
        $request->flush();
        $cities = City::all();
        $bloodGroups = BloodGroup::all();
        $allReadyToGiveDonors = User::getReadyDonors();

        return view('searchForm', compact('cities', 'bloodGroups', 'allReadyToGiveDonors'));
    }


    public function search(Request $request)
    {

        $request->validate([
            'blood_group_id' => 'required|string',
            'city_id'        => 'nullable|string',
        ], [
            'blood_group_id.required' => 'Le Blood Group is Required'
        ]);

        /* $app = User::getOtherDonorsCanDonateTo($request->blood_group_id, $request->city_id);
        dd($app);
        exit();
 */
        $query = null;
        $city = null;
        $blog_group = null;

        if ($request->city_id !== null) {

            $city = City::where('id', $request->city_id)->first();
            $city_name = $city->name;

            $donors =  User::where('city_id', $request->city_id)->paginate(10);
        }


        if ($request->blood_group_id != null) {

            $blog_group = BloodGroup::where('id', $request->blood_group_id)->first();
            $blog_group_name = $blog_group->BloodGroup;

            $donors =  User::where('blood_group_id', $request->blood_group_id)->paginate(10);
        }


        if ($request->blood_group_id !== null && $request->city_id !== null) {


            $city = City::where('id', $request->city_id)->first();
            $city_name = $city->name;

            $blog_group = BloodGroup::where('id', $request->blood_group_id)->first();
            $blog_group_name = $blog_group->BloodGroup;

            $donors =  User::where('city_id', $request->city_id)
                ->where('blood_group_id', $request->blood_group_id)
                ->inRandomOrder()
                ->paginate(10);
        }

        $allReadyToGiveDonors = User::getReadyDonors();
        $cities = City::all();
        $bloodGroups = BloodGroup::all();


        $users = User::all();

        $request->flash();


        /* $query = User::with('city', 'bloodGroup')
            ->filter(request(['blood_group_id', 'city_id']))
            ->inRandomOrder(); */

        // = $query->paginate(10);

        /* dd($donors);
        exit(); */

        return view('searchResults', [
            'searchedBloodGroup' => $blog_group,
            'searchedCity' => $city,
            'donors' => $donors,
            'allReadyToGiveDonors' => $allReadyToGiveDonors,
            'cities' => $cities,
            'bloodGroups' => $bloodGroups,
            'otherDonors' => User::getOtherDonorsCanDonateTo($request->blood_group_id, $request->city_id),
        ]);
    }


    public function showDonors()
    {
        $donors = User::getAllReadyToGiveDonors();

        return view('donors', compact('donors'));
    }
}