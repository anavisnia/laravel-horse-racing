<?php

namespace App\Http\Controllers;

use App\Models\Better;
use App\Models\Horse;
use Illuminate\Http\Request;
use Validator;

class BetterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $horses = Horse::all();
        $horses = $horses->sortBy('name');
        $betters = Better::all();

        if ($request->horse_id) {
            $betters = Better::where('horse_id', $request->horse_id)->get();
            $filterBy = $request->horse_id;
            $betters->append(['horse_id' => $request->horse_id]);
        } else {
            $betters = $betters->sortByDESC('bet');
        }

        if ($request->sort && 'asc' == $request->sort) {
            $betters = $betters->sortBy('name');
            $sortBy = 'asc';
        } elseif($request->sort && 'desc' == $request->sort) {
            $betters = $betters->sortByDESC('name');
            $sortBy = 'desc';
        }

        return view('better.index', ['horses' => $horses, 'betters' => $betters, 'filterBy' => $filterBy ?? 0 ,'sortBy' => $sortBy ?? '']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $horses = Horse::all();
        $horses = $horses->sortBy('name');
        return view('better.create', ['horses' => $horses]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'better_name' => ['required', 'min:3', 'max:100'],
            'better_surname' => ['required', 'min:3', 'max:150'],
            'better_bet' => ['required', 'gt:0', 'lte:5000', 'numeric'],
        ]
        );
        if($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $better = new Better;
        $better->name = $request->better_name;
        $better->surname = $request->better_surname;
        $better->bet = $request->better_bet;
        $better->horse_id = $request->better_horse_id;
        $better->save();
        return redirect()->route('better.index')->
        with('success_message', 'This better hase been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Better  $better
     * @return \Illuminate\Http\Response
     */
    public function show(Better $better)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Better  $better
     * @return \Illuminate\Http\Response
     */
    public function edit(Better $better)
    {
        $horses = Horse::all();
        $horses = $horses->sortBy('name');
        return view('better.edit', ['better' => $better, 'horses' => $horses]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Better  $better
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Better $better)
    {
        $validator = Validator::make($request->all(),
        [
            'better_name' => ['required', 'min:3', 'max:100'],
            'better_surname' => ['required', 'min:3', 'max:150'],
            'better_bet' => ['required', 'min:1'],
        ]
        );
        if($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $better->name = $request->better_name;
        $better->surname = $request->better_surname;
        $better->bet = $request->better_bet;
        $better->horse_id = $request->better_horse_id;
        $better->save();
        return redirect()->route('better.index')->with('success_message', 'This better hase been edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Better  $better
     * @return \Illuminate\Http\Response
     */
    public function destroy(Better $better)
    {
        $better->delete();
        return redirect()->route('better.index')->
        with('info_message', 'This better hase been deleted!');
    }
}
