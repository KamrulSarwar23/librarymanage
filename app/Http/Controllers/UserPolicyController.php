<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserPolicyController extends Controller
{

    public function create()
    {
        $policy = Policy::first();

        if ($policy) {
            return view("admin.policy.index", compact('policy'));
        } else {
            return view("admin.policy.index", compact('policy'));
        }
    }

    public function store(Request $request)
    {
        $rules = [
            'id' => 'sometimes|nullable',
            'days' => 'required',
            'policy' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);


        if ($validator->fails()) {
            flash()->error('All fields are required');
            return redirect()->back();
        } else {
            $validatedData = $validator->validated();
            $criteria = [];

            if ($request->has('id')) {
                $criteria['id'] = $request->input('id');
            }

            $policy = Policy::updateOrCreate(
                $criteria,
                ['days' => $validatedData['days'], 'policy' => $validatedData['policy']]
            );

            if (empty($criteria)) {
                flash()->success('Policy was ceated successfully!');
            } else {
                flash()->success('Policy was updated successfully!');
            }

            return view("admin.policy.index", compact('policy'));
        }
    }
}
