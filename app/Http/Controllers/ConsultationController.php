<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConsultationRequest;
use App\Http\Requests\UpdateConsultationRequest;
use App\Models\Consultation;
use App\Repository\ConsultationRepository;
use App\Repository\PatientRepository;
use App\Repository\PersonnelRepository;
use App\Repository\TypesConsultationRepository;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    protected $typesConsultationRepository;
    protected $personnelRepository;
    protected $consultationRepository;
    protected $patientRepository;

    public function __construct(

        ConsultationRepository $consultationRepository,
        TypesConsultationRepository $typesConsultationRepository,
        PersonnelRepository $personnelRepository,
        PatientRepository $patientRepository

    )
    {
        
        $this->consultationRepository = $consultationRepository;
        $this->typesConsultationRepository = $typesConsultationRepository;
        $this->personnelRepository  = $personnelRepository;
        $this->patientRepository = $patientRepository;

    } 

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listeConsultation = $this->consultationRepository->get_patient_consultation_to_day();
        $dateConsultation = $this->consultationRepository->date_consultation();
        return view('Medecins.listeConsultation', 
            [
                'listeConsultation' => $listeConsultation,
                'dateConsultation' => $dateConsultation
            ]
        );

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreConsultationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    
    public function consultePatient(int $id)
    {   
        // dd($id);
        $patietnInfo = $this->consultationRepository->getPatientById($id);
        return view('Medecins.patientConsulter');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function edit(Consultation $consultation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateConsultationRequest  $request
     * @param  \App\Models\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Consultation $consultation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Consultation $consultation)
    {
        //
    }
}