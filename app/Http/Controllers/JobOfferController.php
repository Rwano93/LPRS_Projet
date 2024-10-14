<?php

namespace App\Http\Controllers;

use App\Models\JobOffer; // Assurez-vous d'importer le modèle JobOffer
use Illuminate\Http\Request;

class JobOfferController extends Controller
{
    // Display all job offers
    public function index()
    {
        $jobOffers = JobOffer::all();
        return view('job_offers.index', compact('jobOffers'));
    }

    // Show the form for creating a new job offer
    public function create()
    {
        return view('job_offers.create');
    }

    // Store a newly created job offer
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'type' => 'required',
            'company_id' => 'required|exists:companies,id',
        ]);

        JobOffer::create($request->all());

        return redirect()->route('job_offers.index')->with('success', 'Job offer created successfully.');
    }

    // Display a specific job offer
    public function show(JobOffer $jobOffer)
    {
        return view('job_offers.show', compact('jobOffer'));
    }

    // Show the form for editing a job offer
    public function edit(JobOffer $jobOffer)
    {
        return view('job_offers.edit', compact('jobOffer'));
    }

    // Update a specific job offer
    public function update(Request $request, JobOffer $jobOffer)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'type' => 'required',
            'company_id' => 'required|exists:companies,id',
        ]);

        $jobOffer->update($request->all());

        return redirect()->route('job_offers.index')->with('success', 'Job offer updated successfully.');
    }

    // Delete a job offer
    public function destroy(JobOffer $jobOffer)
    {
        $jobOffer->delete();
        return redirect()->route('job_offers.index')->with('success', 'Job offer deleted successfully.');
    }
}
