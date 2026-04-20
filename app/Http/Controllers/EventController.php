<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use App\Services\Event\EventService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    public function index()
    {
        try {
            $events = (new EventService())->listEvents();
            return view('event.explore', compact($events));
        } catch (\Exception $exception) {
            \Sentry\captureException($exception);
            Log::error("Error Listing Events: {$exception->getMessage()}");
            return view('event.explore')->withErrors(["error"=>$exception->getMessage()]);
        }
    }

    public function details(Event $event)
    {
        return view('event.details', compact($event));
    }

    public function store(CreateEventRequest $request)
    {
        try {
            $newEvent = (new EventService())->createEvent($request->user(), $request->getData());
            return response()->json([
                'status'=> 'success',
                'message'=>trans('event.created.success'),
                'data' => $newEvent,
            ]);
        } catch (\Exception $exception) {
            \Sentry\captureException($exception);
            Log::error("Error Creating Event: {$exception->getMessage()}");
            return back()->withErrors(["message" => $exception->getMessage()]);
        }
    }

    public function updateEvent(UpdateEventRequest $request, Event $event)
    {
        try {
            (new EventService())->updateEvent($request->user(), $event, $request->getData());
            return redirect()->route('event.details', ['event' => $event->id, 'locale' => app()->getLocale()])
                ->with('success', trans("event.update.success"));
        } catch (\Exception $exception) {
            \Sentry\captureException($exception);
            Log::error("Error Updating Event: {$exception->getMessage()}");
            return back()->withErrors(["message" => $exception->getMessage()]);
        }
    }

    public function destroy(Request $request, Event $event)
    {
        try {
            (new EventService())->deleteEvent($request->user(), $event);
            return back()->with("message", trans("event.delete.success"));
        } catch (\Exception $exception) {
            \Sentry\captureException($exception);
            Log::error("Error Deleting Event:{$exception->getMessage()}");
            return back()->withErrors(["message"=>$exception->getMessage()]);
;        }
    }
}
