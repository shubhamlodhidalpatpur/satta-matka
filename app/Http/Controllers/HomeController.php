<?php

namespace App\Http\Controllers;

use App\Models\Market;
use Carbon\Carbon;
use Illuminate\Http\Request;

use function Laravel\Prompts\select;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $markets = Market::leftjoin('matka_results','matka_results.market_id','markets.market_id')->where('aankdo_date',Carbon::now()->format('Y-m-d'))
        ->select('markets.market_name','matka_results.*')
        ->get();
        return view('home',compact('markets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function panelChart(){
        return view('MatkaPanelChart');
    }
}
