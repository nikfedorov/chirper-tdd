<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChirpStoreRequest;
use App\Models\Chirp;
use Illuminate\Http\RedirectResponse;
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
}
