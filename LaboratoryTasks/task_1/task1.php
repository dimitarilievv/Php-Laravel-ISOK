<?php

enum Specialization: string
{
    case FAMILY_MEDICINE = "family-medicine";
    case CARDIOLOGY = 'cardiology';
    case NEUROLOGY = 'neurology';
    case RADIOLOGY = 'radiology';
}

trait Treatable
{
    public function diagnose(Patient $patient, string $diagnosis): void
    {
        $patient->addDiagnosisToMedicalHistory($diagnosis);
    }
}

class Patient
{
    public int $id;
    public string $name;
    private array $medicalHistory = [];
    private array $treatmentHistory = [];

    public function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function addDiagnosisToMedicalHistory(string $diagnosis)
    {
        $this->medicalHistory[] = $diagnosis;
    }

    public function addTreatmentToTreatmentHistory(string $treatment)
    {
        $this->treatmentHistory[] = $treatment;
    }

    public function getMedicalHistory(): array
    {
        return $this->medicalHistory;
    }

    public function getTreatmentHistory(): array
    {
        return $this->treatmentHistory;
    }

}

class Doctor
{
    public string $id;
    public Specialization $specialization;
    public string $name;
    public int $yearsExperience;
    protected array $patients = [];

    public function __construct(string $id, string $name, int $yearsExperience, Specialization $specialization)
    {
        $this->id = $id;
        $this->name = $name;
        $this->specialization = $specialization;
        $this->yearsExperience = $yearsExperience;
    }

    public function addPatient(Patient $patient): void
    {
        if (!isset($this->patients[$patient->id])) {
            $this->patients[$patient->id] = $patient;
        } else echo 'Already exists that patient!';
    }

    public function printPatients() : void
    {
        foreach ($this->patients as $patient) {
            echo "Name: {$patient->name} ID: {$patient->id}\n";
        }
    }

}

class FamilyDoctor extends Doctor
{
    use Treatable;

    public function __construct(string $id, string $name, int $yearsExperience)
    {
        parent::__construct($id, $name, $yearsExperience, Specialization::FAMILY_MEDICINE);
    }

    public function refer(Patient $patient, array $doctors, Specialization $specialization): Doctor
    {
        $doctorsWithMatchSpecialization = array_filter($doctors, fn($d) => $d->specialization === $specialization);
        usort($doctorsWithMatchSpecialization, fn($a, $b) => $b->yearsExperience <=> $a->yearsExperience);
        $mostExperienced = $doctorsWithMatchSpecialization[0];
        $mostExperienced->addPatient($patient);
        return $mostExperienced;
    }
}

class Specialist extends Doctor
{

    public function __construct(string $id, string $name, int $yearsExperience, Specialization $specialization)
    {
        parent::__construct($id, $name, $yearsExperience, $specialization);
    }

    public function treatPatient(Patient $patient, string $treatment): void
    {
        $patient->addTreatmentToTreatmentHistory($treatment);
        unset($this->patients[$patient->id]);
    }
}

// Create patients
$john = new Patient(1, "John Doe");
$jane = new Patient(2, "Jane Smith");

// Create doctors
$familyDoctor = new FamilyDoctor("D001", "Dr. Brown", 12);
$cardiologist1 = new Specialist("D002", "Dr. Heart", 8, Specialization::CARDIOLOGY);
$cardiologist2 = new Specialist("D003", "Dr. Pulse", 15, Specialization::CARDIOLOGY);
$neurologist = new Specialist("D004", "Dr. Brain", 10, Specialization::NEUROLOGY);

// Add patient to family doctor
$familyDoctor->addPatient($john);
$familyDoctor->diagnose($john, 'High blood pressure');
// Print before referral
$familyDoctor->printPatients();

// Refer John to cardiologist (most experienced one)
$treatingDoctor = $familyDoctor->refer($john, [$cardiologist1, $cardiologist2, $neurologist], Specialization::CARDIOLOGY);
echo "Referred patient with id $john->id to doctor $treatingDoctor->name\n";

// Refer the same patient again (should return that patient is already referred)
$treatingDoctor = $familyDoctor->refer($john, [$cardiologist1, $cardiologist2, $neurologist], Specialization::CARDIOLOGY);

$treatingDoctor->printPatients();

if ($treatingDoctor instanceof Specialist) {
    $treatingDoctor->treatPatient($john, 'Beta-blockers');
}

// Print specialists’ patients after referral
$treatingDoctor->printPatients();

// Show John’s medical history
echo "\nMedical history of {$john->name}:\n";
foreach ($john->getMedicalHistory() as $record) {
    echo "- $record\n";
}