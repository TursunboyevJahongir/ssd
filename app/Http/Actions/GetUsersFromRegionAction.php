<?php

namespace App\Http\Actions;

use App\Enums\IncomeEnum;
use App\Http\Resources\GetUserAddressResource;
use App\Http\Resources\GetUserResource;
use App\Models\Cost;
use App\Models\District;
use App\Models\Income;
use App\Models\Region;
use App\Models\User;
use App\Models\UserAddress;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class GetUsersFromRegionAction
{

    public function __invoke(Request $request, Region $region = null, District $district = null)
    {
        $users = UserAddress::query()->distinct('user_id');
        if (!is_null($region)) {
            $users->where('region_id', $region->id);
        }
        if (!is_null($district)) {
            $users->where('district_id', $district->id);
        }
        $users = $users->with('user')->get()->all();

        return  GetUserAddressResource::collection($users);
    }
}
