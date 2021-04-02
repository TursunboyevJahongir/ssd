<?php

namespace App\Http\Actions\First;

use App\Http\Requests\AddCostRequest;
use App\Models\Cost;
use Illuminate\Http\RedirectResponse;

class AddCostAction
{

    public function __invoke(AddCostRequest $request): RedirectResponse
    {
        $all = $request->validated();
        Cost::create($all);
        return redirect()->back()->with(['message' => 'Saved']);
    }
}
