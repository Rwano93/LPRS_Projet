<?php

namespace App\Http\Controllers;

use App\Models\Company; // Assurez-vous d'importer le modèle Company
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    // Display all companies
    public function index()
    {
        $companies = Company::all();
        return view('companies.index', compact('companies'));
    }

    // Show the form for creating a new company
    public function create()
    {
        return view('companies.create');
    }

    // Store a newly created company
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'website' => 'required|url',
        ]);

        Company::create($request->all());

        return redirect()->route('companies.index')->with('success', 'Company created successfully.');
    }

    // Display a specific company
    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }

    // Show the form for editing a company
    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    // Update a specific company
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'website' => 'required|url',
        ]);

        $company->update($request->all());

        return redirect()->route('companies.index')->with('success', 'Company updated successfully.');
    }

    // Delete a company
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('companies.index')->with('success', 'Company deleted successfully.');
    }
}
