<?php

namespace App\Http\Actions;

use App\Enums\IncomeEnum;
use App\Models\Cost;
use App\Models\District;
use App\Models\Income;
use App\Models\Region;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class GetDistrictsFromRegionAction
{

    public function __invoke(Request $request, Region $region)
    {
        $districts = District::query()->where('region_id', $region->id)->get();
        return [
            'districts' => $districts
        ];
    }
}
