<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChirpStoreRequest;
use App\Http\Requests\ChirpUpdateRequest;
use App\Models\Chirp;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class ChirpController extends Controller
{
    /**
     * Show a list of Chirps.
     */
    public function index(): View
    {
        $chirps = Chirp::query()
            ->with('creator')
            ->latest('created_at')
            ->paginate();

        return view('chirps.index', compact('chirps'));
    }

    /**
     * Store a new Chirp.
     */
    public function store(ChirpStoreRequest $request): RedirectResponse
    {
        $request->user()
            ->chirps()
            ->create($request->validated());

        return redirect()->route('chirps.index');
    }

    /**
     * Show a Chirp edit form.
     */
    public function edit(Chirp $chirp): View
    {
        Gate::authorize('update', $chirp);

        return view('chirps.edit', compact('chirp'));
    }

    /**
     * Update a Chirp.
     */
    public function update(ChirpUpdateRequest $request, Chirp $chirp): RedirectResponse
    {
        Gate::authorize('update', $chirp);

        $chirp->update($request->validated());

        return redirect()->route('chirps.index');
    }

    /**
     * Delete a Chirp.
     */
    public function destroy(Chirp $chirp): RedirectResponse
    {
        Gate::authorize('delete', $chirp);

        $chirp->delete();

        return redirect(route('chirps.index'));
    }
}
