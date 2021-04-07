<?php

namespace App\Http\Actions;

use App\Models\Law;
use App\Models\Prisoner;
use Illuminate\Http\Request;

class PrisonersAction
{

    public function __invoke(Request $request, Law $law = null)
    {
        $title = 'Prisoners';
        $districtId = null;
        $imprisonment_regime = $request->imprisonment_regime ?: null;
        $gender = !is_null($request->gender) ? $request->gender : 'all';

        $prisoners = Prisoner::query();
        $prisoners->orderByDesc('created_at');
        $laws = Law::query()->get();

        $lawId = null;
        if (!is_null($law)) {
            $prisoners->whereHas('crimes', function ($query) use ($law) {
                return $query->where('law_id', '=', $law->id);
            });
            $lawId = $law->id;
        }

        if ($gender !== 'all') {
            {
                $prisoners->whereHas('user', function ($query) use ($gender) {
                    return $query->where('gender', '=', $gender);
                });
            }
        }
        if ($request->imprisonment_regime)
            $prisoners->where('imprisonment_regime', 'like', "%" . $request->imprisonment_regime . "%");

        $prisoners = $prisoners->get();

        return view('Prisoner.index',
            compact('title', 'prisoners', 'gender', 'laws', 'imprisonment_regime', 'lawId'));
    }
}
