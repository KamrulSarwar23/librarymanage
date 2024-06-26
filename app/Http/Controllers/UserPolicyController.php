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
            'fine_amount' => 'required|integer',
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
                ['days' => $validatedData['days'], 
                'policy' => $validatedData['policy'],
                'fine_amount' => $validatedData['fine_amount']
                ]
            );

            if (empty($criteria)) {
                flash()->success('Policy ceated successfully!');
            } else {
                flash()->success('Policy updated successfully!');
            }

            return view("admin.policy.index", compact('policy'));
        }
    }
}
