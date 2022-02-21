<?php

    use App\Models\Country;
    use App\Models\TypeVisa;
    use App\Models\User;
    use App\Models\Center;
    use App\Models\Dossier;
    use Illuminate\Support\Facades\DB;

	function getCountries() {
		$countries = Country::orderBy('name')->get();
        return $countries;
    }

    function getCenters() {
        $centers = Center::orderBy('name')->get();
        return $centers;
    }

    function getTypeVisas() {
        $typeVisas = TypeVisa::orderBy('name')->get();
        return $typeVisas;
    }

    function getCountry($code) {
        $country = Country::where('code', $code)->first();
        return $country->name;
    }

    function getAgent($agent_id) {
        $agent = User::find($agent_id);
        return $agent->surname . ' ' . $agent->name;
    }

    function getCenter($center_id) {
        $center = Center::find($center_id);
        return $center->name;
    }

    function getUserName($user_id) {
        $user = User::find($user_id);
        return $user->surname . ' ' . $user->name;
    }

    function getTypeVisaPrice($type_visa_id) {
        $typeVisa = TypeVisa::find($type_visa_id);
        return $typeVisa->price;
    }

    function is_connected() {
        $connected = @fsockopen("www.stripe.com", 80); 
        //website, port  (try 80 or 443)
        if ($connected){
            $is_conn = true; //action when connected
            fclose($connected);
        }else{
            $is_conn = false; //action in connection failure
        }
        return $is_conn;

    }

    function getDossierCount() {
        $count = 0;
        if(Auth::user()->hasRole('super-admin') || Auth::user()->hasRole('frontal-agent'))
            $count = Dossier::where('state', '!=', '')->count();
        elseif(Auth::user()->hasRole('client'))
            $count = Dossier::where('state', '!=', '')->where('user_id', Auth::id())->count();
        else
            $dossiers = Dossier::join('users', 'users.id', '=', 'dossiers.user_id')->where('users.center_id', 'dossiers.center_id')->where('state', '!=', '')->count();

        return $count;
    }

    function getDossierStateCount($state) {
        $count = 0;
        $length = 0;
            switch($state) {
                case 70: $length = 114; break;
                case 20: $length = 45; break;
                case 30: $length = 68; break;
                case 40: $length = 91; break;
                default: $length = 22;
            }

            if(Auth::user()->hasRole('super-admin') || Auth::user()->hasRole('frontal-agent'))
                $count = Dossier::where(DB::raw('length(state)'), '=', $length)->count();
            elseif(Auth::user()->hasRole('client'))
                $count = Dossier::where('user_id', Auth::id())->where(DB::raw('length(state)'), '=', $length)->count();
            else
                $count = Dossier::join('users', 'users.id', '=', 'dossiers.user_id')->where(DB::raw('length(state)'), '=', $length)->where('users.center_id', 'dossiers.center_id')->count();

        return $count;
    }
 ?>