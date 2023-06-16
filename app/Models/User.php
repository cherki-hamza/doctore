<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Carbon\Carbon;

class User extends \TCG\Voyager\Models\User
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'prenom',
        'phone_number',
        'city_id',
        'blood_group_id',
        'DateDernierDon',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function bloodGroup()
    {
        return $this->belongsTo(BloodGroup::class);
    }

    public function City()
    {
        return $this->belongsTo(City::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when(
            $filters['bloodGroup'] ?? false,
            fn ($query, $blood_group) => $query->whereHas(
                'bloodGroup',
                fn ($query) => $query->where('id', $blood_group)
            )
        );
        $query->when(
            $filters['city'] ?? false,
            fn ($query, $city) => $query->whereHas(
                'city',
                fn ($query) => $query->where('id', $city)
            )
        );
    }



    public static function getReadyDonors()
    {
        $lastDonationThreshold = Carbon::now()->subDays(56);

        return static::where('DateDernierDon', '<=', $lastDonationThreshold)
            ->get();
    }


    public static function otherBloodGroupsDonorsOf($bloodGroupId)
    {
        switch ($bloodGroupId) {
            case 1:
                return [2, 5, 6];
                break;
            case 2:
                return [6];
                break;
            case 3:
                return [3, 5, 6];
                break;
            case 4:
                return [6];
                break;
            case 5:
                return [6];
                break;
            case 6:
                return [];
                break;
            case 7:
                return [1, 2, 3, 4, 5, 6, 8]; // A+ , A- , B+ ,  B- , O+ , O-
                break;
            case 8:
                return [2, 4, 6];
                break;
            default:
                return [];
                break;
        }
    }

    public static function getOtherDonorsCanDonateTo($bloodGroupId, $city = null)
    {


        $readyDonors = self::getReadyDonors();

        $otherBloodGroups = self::otherBloodGroupsDonorsOf($bloodGroupId);


        /* dd($otherBloodGroups);
        exit(); */

        if (!empty($otherBloodGroups)) {
            $query = User::with('bloodGroup')
                ->whereIn('blood_group_id', $otherBloodGroups) // 1 A+  1  == 2 5 6
                //->paginate();
                ->whereNotIn('id', $readyDonors->pluck('id')->toArray());



            /* if ($city) {
                $query->where('city_id', $city);
            } */

            /* dd($query->get());
            exit(); */

            /* return $query->inRandomOrder()
                ->paginate(10, ['*'], 'other-donors')
                ->appends(request()->except('other-donors')); */
            return $query->inRandomOrder()->paginate(10);
        }

        return [];
    }

    public static function getAllReadyToGiveDonors()
    {
        $lastDonationThreshold = Carbon::now()->subDays(56);

        return User::with('bloodGroup', 'City')
            ->where('DateDernierDon', '<=', $lastDonationThreshold)
            ->paginate(10);
    }
}
