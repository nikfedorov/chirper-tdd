<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChirpStoreRequest;
use App\Http\Requests\ChirpUpdateRequest;
use App\Models\Chirp;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ChirpController extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->authorizeResource(Chirp::class, 'chirp');
    }

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
        return view('chirps.edit', compact('chirp'));
    }

    /**
     * Update a Chirp.
     */
    public function update(ChirpUpdateRequest $request, Chirp $chirp): RedirectResponse
    {
        $chirp->update($request->validated());

        return redirect()->route('chirps.index');
    }

    /**
     * Delete a Chirp.
     */
    public function destroy(Chirp $chirp): RedirectResponse
    {
        $chirp->delete();

        return redirect(route('chirps.index'));
    }
}
