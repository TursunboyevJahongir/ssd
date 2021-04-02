<?php

namespace App\Http\Actions\First;

use App\Enums\IncomeEnum;
use App\Models\Cost;
use App\Models\Income;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\Pure;

class GetCostsAction
{

    public function __invoke(Request $request, string $date = null): Factory|View|Application
    {
        $title = 'Costs';

        $costs = Cost::query();
        $start_date = null;
        $end_date = null;
        $costs->orderByDesc('created_at');
        if (!is_null($request->start_date)) {
            $start_date = Carbon::createFromTimestamp(strtotime($request->start_date));
            $costs->where('created_at', '>=', $start_date);
            $start_date = $request->start_date;

        }
        if (!is_null($request->end_date)) {
            $end_date = Carbon::createFromTimestamp(strtotime($request->end_date));
            $costs->where('created_at', '<=', $end_date);
            $end_date = $request->end_date;
        }
        if (!is_null($date) && $date == 'today') {
            $costs->whereBetween('created_at', [Carbon::today(), Carbon::now()]);
        } elseif (!is_null($date) && $date == 'month') {
            $costs->whereBetween('created_at', [Carbon::now()->subDays(30), Carbon::now()]);
        }

        $sum = 0;
        $all = $costs->get();
        foreach ($all as $one) {
            $sum += $one->price;
        }

        $costs = $costs->paginate(20);
        return view('First.costs.index', compact('title', 'costs', 'start_date', 'end_date', 'date', 'sum'));
    }
}
