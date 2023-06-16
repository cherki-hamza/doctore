<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\BloodGroup;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        $cities = City::all();
        $bloodGroups = BloodGroup::all();

        return view('auth.register', compact('cities', 'bloodGroups'));
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        Auth::login($user);
        return redirect('/');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:10', 'unique:users'],
            'city_id' => ['required', 'exists:cities,id'],
            'blood_group_id' => ['required', 'exists:blood_groups,id'],
            'DateDernierDon' => ['required', 'date'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'prenom' => $data['prenom'],
            'phone_number' => $data['phone_number'],
            'city_id' => $data['city_id'],
            'blood_group_id' => $data['blood_group_id'],
            'DateDernierDon' => $data['DateDernierDon'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
