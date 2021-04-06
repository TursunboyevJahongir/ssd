<?php

namespace App\Http\Actions;

use App\Enums\IncomeEnum;
use App\Models\Income;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class GetIncomesAction
{

    public function __invoke(Request $request, string $date = null): Factory|View|Application
    {
        $title = 'Incomes';

        $incomes = Income::query();
        $start_date = null;
        $end_date = null;
        $incomes->orderByDesc('created_at');
        if (!is_null($request->start_date)) {
            $start_date = Carbon::createFromTimestamp(strtotime($request->start_date));
            $incomes->where('created_at', '>=', $start_date);
            $start_date = $request->start_date;

        }
        if (!is_null($request->end_date)) {
            $end_date = Carbon::createFromTimestamp(strtotime($request->end_date));
            $incomes->where('created_at', '<=', $end_date);
            $end_date = $request->end_date;
        }
        if (!is_null($date) && $date == 'today') {
            $incomes->whereBetween('created_at', [Carbon::today(), Carbon::now()]);
        } elseif (!is_null($date) && $date == 'month') {
            $incomes->whereBetween('created_at', [Carbon::now()->subDays(30), Carbon::now()]);
        } elseif (!is_null($date) && $date == 'pension') {
            $incomes->where('type', IncomeEnum::pension());
        }

        $sum = 0;
        $all = $incomes->get();
        foreach ($all as $one) {
            $sum += $one->price;
        }

        $incomes = $incomes->paginate(20);
        return view('Income.index', compact('title', 'incomes', 'start_date', 'end_date', 'date', 'sum'));
    }
}
