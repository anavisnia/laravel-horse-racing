<?php

namespace App\Http\Controllers;

use App\Models\Horse;
use Illuminate\Http\Request;
use Validator;
use PDF;

class HorseController extends Controller
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
    public function index()
    {
        $horses = Horse::all();
        $horses = $horses->sortBy('name');
        return view('horse.index', ['horses' => $horses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('horse.create');
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
            'horse_name' => ['required', 'min:3', 'max:100'],
            'horse_runs' => ['required', 'numeric', 'min:1', 'gt:horse_wins'],
            'horse_wins' => ['required', 'numeric', 'gt:-1'],
            'horse_about' => ['required', 'min:1'],
        ]
        );
        if($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $horse = new Horse;
        $horse->name = $request->horse_name;
        $horse->runs = $request->horse_runs;
        $horse->wins = $request->horse_wins;
        $horse->about = $request->horse_about;
        $horse->save();
        return redirect()->route('horse.index')->
        with('success_message', 'This horse hase been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Horse  $horse
     * @return \Illuminate\Http\Response
     */
    public function show(Horse $horse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Horse  $horse
     * @return \Illuminate\Http\Response
     */
    public function edit(Horse $horse)
    {
        return view('horse.edit', ['horse' => $horse]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Horse  $horse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Horse $horse)
    {
        $validator = Validator::make($request->all(),
        [
            'horse_name' => ['required', 'min:3', 'max:100'],
            'horse_runs' => ['required', 'numeric', 'min:1', 'gt:horse_wins'],
            'horse_wins' => ['required', 'numeric', 'gt:-1'],
            'horse_about' => ['required', 'min:1'],
        ]
        );
        if($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        if($request->horse_wins > $request->horse_runs) {
            $request->flash();
            return redirect()->back()->
            with('info_message', 'Horse wins cannot be bigger than horse runs!');
        }

        $horse->name = $request->horse_name;
        $horse->runs = $request->horse_runs;
        $horse->wins = $request->horse_wins;
        $horse->about = $request->horse_about;
        $horse->save();
        return redirect()->route('horse.index')->
        with('success_message', 'This horse hase been edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Horse  $horse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Horse $horse)
    {
        if($horse->includedInRace->count() !== 0) {
            return redirect()->route('horse.index')->
            with('info_message', 'This horse participates in a race!');
        }
        $horse->delete();
        return redirect()->route('horse.index')->
        with('success_message', 'This horse hase been deleted!');
    }

    public function pdf(Horse $horse)
    {
        $pdf = PDF::loadView('horse.pdf', ['horse' => $horse]);
        return $pdf->download('horse-name' . $horse->name . '.pdf');
    }
}
