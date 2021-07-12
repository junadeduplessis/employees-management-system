<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function index(Request $request)
    {
        $states = State::all();

        if ($request->has('search')) {
            $states = State::where('country_id', 'like', "%{$request->search}%")->orWhere('name', 'like', "%{$request->search}%")->get();
        }

        return view('states.index', compact('states'));
    }

    public function create()
    {
        return view('states.create');
    }

    public function store()
    {

    }
}
