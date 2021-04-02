<?php

namespace App\Http\Actions\First;

use App\Enums\IncomeEnum;
use App\Http\Requests\AddIncomeRequest;
use App\Models\Income;
use Illuminate\Http\RedirectResponse;

class AddIncomeAction
{

    public function __invoke(AddIncomeRequest $request): RedirectResponse
    {
        $all = $request->validated();
        $all['type'] = $request->type == 'on' ? IncomeEnum::pension() : IncomeEnum::other();
        Income::create($all);
        return redirect()->back()->with(['message' => 'Saved']);
    }
}
