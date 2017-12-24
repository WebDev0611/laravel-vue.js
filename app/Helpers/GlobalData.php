<?php

namespace App\Helpers;

use App\Plan;
use App\Countries;
use Auth;
use DB;

class GlobalData
{

    public static function getRemainingTourCount() {

        $Plan = Plan::where('subkey', Auth::user()->subkey)->first();
        if (is_null($Plan)) {
            return "";
        } else {
            $activeTours = Auth::user()->public_tours;
            $allowance = $Plan->max_tours;
            $left = $allowance - $activeTours;

            if ($Plan->subkey == 'platinum') {
                $left = '∞';
            }

            return $left;
        }
    }

    public static function checkIfNewUser() {

        $user = Auth::user();

        if ($user->first_login) {

            $user->first_login = false;
            $user->save();

            return true;

        } else {
            return false;
        }

    }


    public static function isFreeSub()
    {
        $user = Auth::user();

        if ($user->subkey == 'free') {

            return true;

        } else {
            return false;
        }
    }

    public static function getCountries()
    {

        $countries = Countries::where('supported', true)->get();

        return $countries;

    }

    public static function getColorScheme() {
        if(!empty($_GET['color_scheme'])) {               
            DB::table('settings')
            ->where('uid', 1)
            ->update(['style_sheet' => '#'.$_GET['color_scheme']]);            
        }
        $scheme = DB::table('settings')->where('uid', 1)->first();
        return $scheme->style_sheet;
    }

}