<?php

namespace App\Http\Controllers;

use App\Models\ConsultationReport;
use App\Models\Prescription;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $report_id)
    {
        $consultationReport = ConsultationReport::findOrFail($report_id);
        $this->authorize('create', [Prescription::class, $consultationReport]);

        // Validation and storing logic
    }

    /**
     * Display the specified resource.
     */
    public function show(Prescription $perscription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prescription $perscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prescription $perscription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prescription $perscription)
    {
        //
    }
}
