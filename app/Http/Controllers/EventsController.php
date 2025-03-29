<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\User;

class EventsController extends Controller
{
    public function index()
    {
        $search = request('search');

        if($search){
            $events = Event::where('title', 'like', '%'.$search.'%')->where('private', 0)->orderBy('date', 'asc')->get();
        }else{
            $events = Event::where('private', 0)->orderBy('date', 'asc')->get();
        }

        return view('events.index', ['events' => $events, 'search' => $search]);
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        if($request->hasFile('image') && $request->file('image')->isValid()){
            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName()) . strtotime("now") . "." . $extension;
            $requestImage->move(public_path('assets/img/events'), $imageName);
        }

        Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'city' => $request->city,
            'date' => $request->date,
            'private' => !isset($request->private) ? 0 : 1,
            'image' => $imageName,
            'meta_participants' => $request->meta_participants,
            'items' => isset($request->items) ? json_encode($request->items) : null,
            'user_id' => Auth::user()->id
        ]);
        
        return redirect()->back()->with(['msg' => 'Evento criado com sucesso!', 'time' => date("Y-m-d H:i:s")]);
    }

    public function show($id)
    {
        $event = Event::where('id', $id)->firstOrFail();
        $event['items'] = json_decode($event['items']);
        $eventOwner = User::where('id', $event['user_id'])->firstOrFail();
        return view('events.show', ['event' => $event, 'eventOwner' => $eventOwner]);
    }

    public function destroy($id)
    {
        Event::where('id', $id)->firstOrFail()->delete();
        return redirect('/dashboard')->with(['msg' => 'Evento removido com sucesso!', 'time' => date("Y-m-d H:i:s")]);
    }

    public function update(Request $request)
    {
        dd($request);
    }
}
