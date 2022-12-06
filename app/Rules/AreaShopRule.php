<?php

namespace App\Rules;

use App\Models\providerShopBranch;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class AreaShopRule implements Rule
{

    private $lat;
    private $long;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($lat,$long)
    {
        $this->lat=$lat;
        $this->long=$long;
       
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {        

        if (auth('user')->check()) {
            $userLocation = auth('user')->user()->userLocation;
            if ($userLocation && !isset($this->lat) && !isset($this->long)) {
                $this->lat = $userLocation->latitude;
                $this->long = $userLocation->longitude;
            }else{
                $this->lat = 30.012537910528884;
                $this->long = 31.290307;
            }
        }else{
            if (!isset($this->lat) && !isset($this->long)){
                $this->lat = 30.012537910528884;
                $this->long = 31.290307;
            }

        }
        $unit = "km";
        $distance = 30;
        $constant = $unit == "km" ? 6371 : 3959;

        $haversine = "(
            6371 * acos(
                cos(radians(" .  $this->lat . "))
                * cos(radians(`latitude`))
                * cos(radians(`longitude`) - radians(" . $this->long . "))
                + sin(radians(" .  $this->lat . ")) * sin(radians(`latitude`))
            )
        )";
      return  providerShopBranch::where('shop_id',request()->shop_id)->select(DB::raw("$haversine AS distance, id as id , name as name,shop_id as shop_id"),'latitude','longitude')
                ->orderby("distance", "asc")
                ->having("distance", "<=", $distance)->exists();

        
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The shop not In your area.';
    }
}
