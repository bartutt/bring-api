<?php

namespace App\Services;

use App\Models\Actor;
use App\Models\Event;
use App\Models\EventActor;
use App\Models\Festival;
use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Element
{ 

    public $request;

    public function __construct() {
        $this->request = Request::capture();
    }

    public function delete($element)
    {
        try {
            $element->deleteQuietly();
            Session::flash('success', $element->name . ' ble slettet'); 
        } catch (\Throwable $th) {
            Session::flash('failure', 'Kunne ikke slette ' . $element->name); 
        }
    }

    public function save($element)
    {
        $element->name = $this->request->input('name') ?? null;
        $element->image_id = $this->getImageId();
        $element->intro = $this->request->input('intro') ?? null;
        $element->description = $this->request->input('description') ?? null;

        if(get_class($element) === Event::class){
            $element->date = $this->request->input('date') ? $this->request->input('date') : null;
            $element->festival_id = $this->getFestivalId();
            $element->venue_id = $this->request->input('venueId');
        }

        if(get_class($element) === Festival::class){
            $element->year = $this->request->input('year');
        }
        

        if($element->save()){
            Session::flash('success', $element->name . ' ble lagret'); 
            return $element;
        } else {
            Session::flash('failure', $element->name . ' ble ikke lagret'); 
            return null;
        }


    }

    public function getFestivalId()
    {
        $year = (int) $this->request->input('year');

        $festival = Festival::where(['year' => $year])->first();

        if(!$festival){
            return null;
        }

        return $festival->id;
    }
    
    /* TODO */
    public function addActors($event)
    {
        $actors = $this->request->input('actors') ?? [];
        $removedActors = json_decode($this->request->input('removedActors')) ?? [];

       /*  dd($actors); */
        foreach ($actors as $id => $a) {
            $a = (object) $a;
            $actor = Actor::where(['id' => $id])->orWhere(['name' => $a->name])->first() ?? new Actor();
            $actor->name = $a->name;
            $actor->save();

            $eventActor = EventActor::where(['actor_id' => $id, 'event_id' => $event->id])->first() ?? new EventActor();
            $eventActor->actor_id = $actor->id;
            $eventActor->event_id = $event->id;
            $eventActor->instrument = $a->instrument;

            $eventActor->save();
        }

        foreach ($removedActors as $id) {
            $el = EventActor::where(['actor_id' => $id, 'event_id' => $event->id])->first() ?? new EventActor();
            $el->deleteQuietly();
        }
    }


    public function getImageId()
    {
 
        $image = $this->request->input('image');

        $image = json_decode($image);

        if(!$image){
            return null;
        }

        if(is_int($image)){
            return $image;
        }
        
        return $image->id;
    }
}
