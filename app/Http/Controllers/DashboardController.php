<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
 
    public function index()
    {
        $events = Event::where('user_id', Auth::user()->id)->get();
        foreach($events as $event){
            $event['items'] = json_decode($event['items']);
        }
        return view('dashboard.index', ['events' => $events]);
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
