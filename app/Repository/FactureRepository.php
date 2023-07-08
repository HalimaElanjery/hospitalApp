<?php

namespace App\Repository;

use App\Interfaces\FactureRepositoryInterface;
use App\Models\Consultation;
use App\Models\Examen;
use App\Models\FactureDispensaire;
use App\Models\Patient;
use App\Models\Prescription;
use App\Models\Produit;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\map;

class FactureRepository implements FactureRepositoryInterface
{
    public function getAll()
    {
        $factures = FactureDispensaire::with([
            'consultation.patient',
            'consultation.examens.examenLaboratoire',
            'consultation.prescription.produit'
        ])
            ->where('isNotPayed', false)
            // ->latest()
            ->distinct()
            ->get();
        
        $facturesInfo = $factures->groupBy(function ($facture) {
            $consultation = $facture->consultation;
            $patient = $consultation->patient;
            return $facture->num_facture_patient . '-' . $consultation->patient->matricule . '-' . $consultation->patient->nom_patient;
        })->map(function ($groupedFactures, $key) {
            $facture = $groupedFactures->first();
            $consultation = $facture->consultation;

            $prescriptions = $consultation->prescription;
            $produits = $prescriptions->map(function ($prescription) {
                $produit = $prescription->produit;
                return [
                    'produit_nom' => $produit->designation_produits,
                    'quantite' => $prescription->quantite,
                    'categorie' => $produit->categorie,
                    'prix_unitaire' => $produit->prix_vente_produits,
                    'prix_totale' => $prescription->prix_total,
                ];
            });

            $examens = $consultation->examens;
            
            $examenLaboratoires = $examens->map(function ($examen) {
                $examenLaboratoire = $examen->examenLaboratoire;
                return [
                    'designation_examens_labo' => $examenLaboratoire->designation_examens_labo,
                    'prix_examen' => $examenLaboratoire->prix_examen,
                ];
            });

            return [
                'id' => $facture->id,
                'facture' => $facture->id,
                'prixTotal' => $prescriptions->sum('prix_total') + $consultation->prix + $examenLaboratoires->sum('prix_examen'),
                'prixFacture' => $facture->reste,
                'matricule' => $consultation->patient->matricule,
                'patient' => $consultation->patient->nom_patient . " " . $consultation->patient->prenom_patient,
                'montant' => (float) $facture->montant,
                'reste' => (float) $facture->reste,
                'consultation_prix' => $consultation->prix,
                'produits' => $produits,
                'etat' => $facture->isNotPayed
            ];
        });

        // dd($facturesInfo);

        return $facturesInfo;
    }

    public function getFacture(int $numFacture)
    {
        $factures = FactureDispensaire::with([
            'consultation.patient',
            'consultation.examens.examenLaboratoire',
            'consultation.prescription.produit'
        ])
            ->where('id', $numFacture)

            ->get();
        $facturesInfo = $factures->groupBy(function ($facture) {
            $consultation = $facture->consultation;
            $patient = $consultation->patient;
            return "dataDetails";
        })->map(function ($groupedFactures, $key) {
            $facture = $groupedFactures->first();
            $consultation = $facture->consultation;

            
            $prescriptions = $consultation->prescription;
            $produits = $prescriptions->map(function ($prescription) {
                $produit = $prescription->produit;
                return [
                    'produit_nom' => $produit->designation_produits,
                    'quantite' => $prescription->quantite,
                    'categorie' => $produit->categorie,
                    'prix_unitaire' => $produit->prix_vente_produits,
                    'prix_totale' => $prescription->prix_total,
                ];
            });

            $examens = $consultation->examens;
            
            $examenLaboratoires = $examens->map(function ($examen) {
                $examenLaboratoire = $examen->examenLaboratoire;
                return [
                    'designation_examens_labo' => $examenLaboratoire->designation_examens_labo,
                    'prix_examen' => $examenLaboratoire->prix_examen,
                ];
            });

            return [
                'id' => $facture->id,
                'facture' => $facture->id,
                'prixTotal' => $prescriptions->sum('prix_total') + $consultation->prix + $examenLaboratoires->sum('prix_examen'),
                'prixFacture' => $facture->reste,
                'matricule' => $consultation->patient->matricule,
                'patient' => $consultation->patient->nom_patient . " " . $consultation->patient->prenom_patient,
                'montant' => (float) $facture->montant,
                'reste' => (float) $facture->reste,
                'consultation_prix' => $consultation->prix,
                'laboratoire_prix' => is_null($examenLaboratoires) ? null :$examenLaboratoires->sum('prix_examen') ,
                'produits' => is_null($produits) ? null : $produits,
                'etat' => $facture->isNotPayed
            ];
        });

        return $facturesInfo;
    }

    // $consultations = Consultation::with(['patient', 'prescription.produit'])
    //         ->whereHas('patient', function ($query) {
    //             $query->whereNotNull('id');
    //         })
    //         ->get()
    //         ->map(function ($consultation) {
    //             $patient = $consultation->patient;
    //             $produits = $consultation->prescription->pluck('produit_id');
    //             $medicaments = Produit::whereIn('id', $produits)
    //                 // ->select(['designation_produits', 'categorie'])
    //                 ->get()
    //                 ->map(function($medicaments){
    //                     return [
    //                         'nomProduit' => $medicaments->designation_produits,
    //                         'categorie' => $medicaments->categorie,
    //                     ];
    //                 });                
    //             return [
    //                 'id' => $patient->id,
    //                 'matricule' => $patient->matricule,
    //                 'nom' => $patient->nom_patient,
    //                 'prenom' => $patient->prenom_patient,
    //                 'sexe' => $patient->sexe_patient,
    //                 'age' => $patient->Age_patient,
    //                 'IsHospitaled' => !is_null($patient->IsHospitaled) ? null : 'Hospiliser',
    //                 'medicaments' => $medicaments,
    //             ];
    //         });



    //     dd($consultations);
    //     return $consultations;
}
