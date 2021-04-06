<?php

namespace App\Http\Actions;

use App\Enums\IncomeEnum;
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

class GetUsersAction
{

    public function __invoke(Request $request, Region $region = null)
    {
        $title = 'Users';
        $districtId = null;
        $address = $request->address ?: null;

        if ($request->districtId)
            District::query()->findOrFail($request->districtId);

        $users = UserAddress::query();
        $users->orderByDesc('created_at');
        $districts = District::query();
        $regions = Region::query()->get();

        $regionId = null;
        if (!is_null($region)) {
            $users->where('region_id', $region->id);
            $districts->where('region_id', $region->id);
            $regionId = $region->id;
        }

        if (!is_null($request->districtId)) {
            {
                $users->where('district_id', $request->districtId);
            }

            $districtId = $request->districtId;
        }
        if ($request->address)
            $users->where('address', 'like', "%" . $request->address . "%");
        $districts = $districts->get();
        $users = $users->get();

        return view('User.index',
            compact('title', 'users', 'regions', 'regionId', 'districts', 'districtId', 'address'));
    }
}
