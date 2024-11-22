<?php

namespace App\Http\Controllers;

use App\Models\JobOffer;
use Illuminate\Http\Request;

class JobOfferController extends Controller
{
    public function index()
    {
        $jobOffers = JobOffer::all();
        return view('job_offers.index', compact('jobOffers'));
    }

    public function create()
    {
        return view('job_offers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'type' => 'required|in:CDI,CDD,alternance,stage',
            'description' => 'required',
        ]);

        JobOffer::create($request->all());

        return redirect()->route('job-offers.index')
            ->with('success', 'Offre d\'emploi créée avec succès.');
    }

    public function show(JobOffer $jobOffer)
    {
        return view('job_offers.show', compact('jobOffer'));
    }
}