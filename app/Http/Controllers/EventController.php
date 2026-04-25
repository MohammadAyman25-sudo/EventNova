<?php

namespace App\Http\Controllers;

use App\DTOs\Event\UpdateEventDTO;
use App\Http\Requests\CreateEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use App\Services\Event\EventService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    public function create(string $locale)
    {
        return view('event.create');
    }

    public function index(string $locale)
    {
        try {
            $events = (new EventService())->listEvents();

            return view('event.explore', compact('events'));
        } catch (\Exception $exception) {
            \Sentry\captureException($exception);
            Log::error("Error Listing Events: {$exception->getMessage()}");

            return view('event.explore')->withErrors(['error' => $exception->getMessage()]);
        }
    }

    public function organizerEvents(string $locale)
    {
        try {
            $events = (new EventService())->listOrganizerEvents(auth()->user());

            return view('event.explore', compact('events'));
        } catch (\Exception $exception) {
            \Sentry\captureException($exception);
            Log::error("Error Listing Organizer Events: {$exception->getMessage()}");

            return back()->withErrors(['message' => $exception->getMessage()]);
        }
    }

    public function details(string $locale, Event $event)
    {
        $this->authorize('view', $event);

        $event->load('organizer');

        return view('event.details', compact('event'));
    }

    public function edit(string $locale, Event $event)
    {
        $this->authorize('update', $event);

        return view('event.edit', compact('event'));
    }

    public function store(CreateEventRequest $request, string $locale)
    {
        try {
            $newEvent = (new EventService())->createEvent($request->user(), $request->getData());

            return redirect()
                ->route('event.details', ['event' => $newEvent])
                ->with('success', trans('event.created.success'));
        } catch (\Exception $exception) {
            \Sentry\captureException($exception);
            Log::error("Error Creating Event: {$exception->getMessage()}");

            return back()->withErrors(['message' => $exception->getMessage()]);
        }
    }

    public function updateEvent(UpdateEventRequest $request, string $locale, Event $event)
    {
        try {
            $validated = collect($request->validated())->except(['banner_image'])->all();
            $dto = UpdateEventDTO::from($validated);
            (new EventService())->updateEvent($request->user(), $event, $dto, $request->file('banner_image'));

            return redirect()
                ->route('event.details', ['event' => $event])
                ->with('success', trans('event.updated.success'));
        } catch (\Exception $exception) {
            \Sentry\captureException($exception);
            Log::error("Error Updating Event: {$exception->getMessage()}");

            return back()->withErrors(['message' => $exception->getMessage()]);
        }
    }

    public function destroy(Request $request, string $locale, Event $event)
    {
        try {
            (new EventService())->deleteEvent($request->user(), $event);

            return redirect()
                ->route('explore.events')
                ->with('message', trans('event.deleted.success'));
        } catch (\Exception $exception) {
            \Sentry\captureException($exception);
            Log::error("Error Deleting Event:{$exception->getMessage()}");

            return back()->withErrors(['message' => $exception->getMessage()]);
        }
    }

    public function publish(Request $request, string $locale, Event $event)
    {
        try {
            (new EventService())->publishEvent($request->user(), $event);

            return redirect()
                ->route('event.details', ['event' => $event])
                ->with('success', trans('event.published.success'));
        } catch (\Exception $exception) {
            \Sentry\captureException($exception);
            Log::error("Error Publishing Event:{$exception->getMessage()}");
            return back()->withErrors(['message' => $exception->getMessage()]);
        }
    }
}
