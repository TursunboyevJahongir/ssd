<?php

namespace App\Http\Actions;

use App\Enums\IncomeEnum;
use App\Http\Resources\GetUserAddressResource;
use App\Http\Resources\GetUserResource;
use App\Http\Resources\PrisonerResource;
use App\Models\Cost;
use App\Models\District;
use App\Models\Income;
use App\Models\Prisoner;
use App\Models\Region;
use App\Models\User;
use App\Models\UserAddress;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PrisonerAction
{

    public function __invoke(Request $request, Prisoner $id = null)
    {
        return  new PrisonerResource($id);
    }
}
