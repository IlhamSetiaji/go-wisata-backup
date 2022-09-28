<?php

namespace App\Http\Controllers;

use App\Models\EventBooking;
use App\Models\EventBooking as ModelsEventBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;

class FullCalendarController extends Controller
{
    public function getEvent()
    {
        if (request()->ajax()) {
            $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
            $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');
            $events = EventBooking::whereDate('start', '>=', $start)->whereDate('end',   '<=', $end)
                ->get(['id', 'title', 'start', 'end']);
            return response()->json($events);
        }
        return view('FrontEnd/calendarbooking');
    }
    public function createEvent(Request $request)
    {
        $data = Arr::except($request->all(), ['_token']);
        dd($data);
        $events = EventBooking::insert($data);
        return response()->json($events);
    }

    public function deleteEvent(Request $request)
    {
        $event = EventBooking::find($request->id);
        return $event->delete();
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = EventBooking::whereDate('start', '>=', $request->start)
                ->whereDate('end',   '<=', $request->end)
                ->get(['id', 'title', 'start', 'end']);
            return response()->json($data);
        }
        return view('FrontEnd/calendarbooking');
    }

    public function action(Request $request)
    {
        if ($request->ajax()) {
            if ($request->type == 'add') {
                $event = EventBooking::create([
                    'title'        =>    $request->title,
                    'start'        =>    $request->start,
                    'end'        =>    $request->end
                ]);

                return response()->json($event);
            }

            if ($request->type == 'update') {
                $event = EventBooking::find($request->id)->update([
                    'title'        =>    $request->title,
                    'start'        =>    $request->start,
                    'end'        =>    $request->end
                ]);

                return response()->json($event);
            }

            if ($request->type == 'delete') {
                $event = EventBooking::find($request->id)->delete();

                return response()->json($event);
            }
        }
    }
}
