<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Doctor;
use App\Models\HospitalGallery;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class HospitalDemoContentSeeder extends Seeder
{
    public function run(): void
    {
        $departments = collect([
            ['name' => 'Medicine', 'code' => 'MED', 'short_name' => 'MED', 'description' => 'General medicine and internal care support.', 'status' => 'active'],
            ['name' => 'Cardiology', 'code' => 'CAR', 'short_name' => 'CARD', 'description' => 'Heart and vascular consultation services.', 'status' => 'active'],
            ['name' => 'Pediatrics', 'code' => 'PED', 'short_name' => 'PED', 'description' => 'Child and adolescent care unit.', 'status' => 'active'],
            ['name' => 'Orthopedics', 'code' => 'ORT', 'short_name' => 'ORTHO', 'description' => 'Bone, joint, and mobility treatment support.', 'status' => 'active'],
            ['name' => 'Gynecology', 'code' => 'GYN', 'short_name' => 'GYNO', 'description' => 'Women wellness and gynecology care.', 'status' => 'active'],
            ['name' => 'Neurology', 'code' => 'NEU', 'short_name' => 'NEURO', 'description' => 'Neurology and nerve-related consultation.', 'status' => 'active'],
        ])->mapWithKeys(function (array $department) {
            $model = Department::updateOrCreate(
                ['code' => $department['code']],
                $department
            );

            return [$department['code'] => $model];
        });

        $hospitals = [
            'hospital1@gmail.com' => [
                'profile' => [
                    'hospital_location' => 'Road 8A, Dhanmondi, Dhaka',
                    'address' => 'Road 8A, Dhanmondi, Dhaka, Bangladesh',
                    'photo' => $this->copyAsset('register.jpg', 'hospitals/city-care-hospital.jpg'),
                    'about_hospital' => '<p><strong>City Care Hospital</strong> is a multi-specialty hospital in Dhanmondi that provides emergency response, outpatient consultation, inpatient support, and routine diagnostic coordination for families and working professionals.</p><p>The hospital runs a patient-first workflow with quick registration, focused specialist chambers, nursing support, and structured follow-up to keep treatment simple and dependable.</p>',
                    'privacy_policy' => '<p>City Care Hospital collects patient contact details, booking requests, and clinical notes only for service delivery, treatment coordination, and internal hospital operations.</p><p>Access to patient records is limited to authorized staff members. Information is reviewed under internal confidentiality controls and is not shared outside approved care workflows.</p>',
                ],
                'galleries' => [
                    ['title' => 'Main Reception and Front Desk', 'image' => $this->copyAsset('register.jpg', 'hospital-galleries/city-care-reception.jpg')],
                    ['title' => 'Doctor Consultation Cabin', 'image' => $this->copyAsset('doctore.png', 'hospital-galleries/city-care-cabin.png')],
                    ['title' => 'Patient Support and Waiting Area', 'image' => $this->copyAsset('default.png', 'hospital-galleries/city-care-waiting.png')],
                ],
                'services' => [
                    ['title' => '24/7 Emergency and Observation Care', 'description' => 'Round-the-clock emergency reception, observation bed support, and doctor review for urgent patient needs.'],
                    ['title' => 'Cardiac Risk Screening Package', 'description' => 'Heart health review with consultation, ECG direction, blood pressure monitoring, and follow-up planning.'],
                    ['title' => 'Executive Health Checkup', 'description' => 'Structured routine health checkup with physician consultation, screening recommendations, and wellness guidance.'],
                ],
                'doctors' => [
                    ['department' => 'MED', 'name' => 'Dr. Rahim Uddin', 'email' => 'rahim.citycare@example.com', 'photo' => $this->copyAsset('Male.jpg', 'doctors/rahim-uddin.jpg'), 'speciality' => 'Internal Medicine Specialist', 'experience' => '12+ years in internal medicine and chronic disease management.', 'shifts' => [['day' => 'Sat', 'time' => '10:00 AM - 2:00 PM'], ['day' => 'Mon', 'time' => '6:00 PM - 9:00 PM']]],
                    ['department' => 'CAR', 'name' => 'Dr. Farzana Ahmed', 'email' => 'farzana.citycare@example.com', 'photo' => $this->copyAsset('Female.jpg', 'doctors/farzana-ahmed.jpg'), 'speciality' => 'Consultant Cardiologist', 'experience' => '10+ years in heart care, ECG review, and preventive cardiology.', 'shifts' => [['day' => 'Sun', 'time' => '11:00 AM - 3:00 PM'], ['day' => 'Wed', 'time' => '5:00 PM - 8:00 PM']]],
                    ['department' => 'PED', 'name' => 'Dr. Nusrat Jahan', 'email' => 'nusrat.citycare@example.com', 'photo' => $this->copyAsset('Female.jpg', 'doctors/nusrat-jahan.jpg'), 'speciality' => 'Pediatric Specialist', 'experience' => '8+ years in child fever management and developmental follow-up.', 'shifts' => [['day' => 'Tue', 'time' => '10:00 AM - 1:00 PM'], ['day' => 'Thu', 'time' => '4:00 PM - 7:00 PM']]],
                ],
            ],
            'hospital2@gmail.com' => [
                'profile' => [
                    'hospital_location' => 'Sector 7, Uttara, Dhaka',
                    'address' => 'Sector 7, Uttara, Dhaka, Bangladesh',
                    'photo' => $this->copyAsset('logo.jpg', 'hospitals/green-life-medical.jpg'),
                    'about_hospital' => '<p><strong>Green Life Medical</strong> serves patients in Uttara with specialist consultation, family medicine support, women wellness care, and child-focused outpatient services in a calm and organized setting.</p><p>The hospital emphasizes scheduled consultation, clear communication, and convenient follow-up so patients can complete routine care without unnecessary waiting or confusion.</p>',
                    'privacy_policy' => '<p>Green Life Medical stores the minimum patient information needed for appointments, consultation schedules, and treatment follow-up.</p><p>Contact details and medical notes are accessible only to authorized hospital staff and remain inside the operational workflow of the hospital.</p>',
                ],
                'galleries' => [
                    ['title' => 'Hospital Front Entry', 'image' => $this->copyAsset('logo.jpg', 'hospital-galleries/green-life-entry.jpg')],
                    ['title' => 'Specialist Chamber Floor', 'image' => $this->copyAsset('register.jpg', 'hospital-galleries/green-life-chamber.jpg')],
                    ['title' => 'Nursing and Patient Support Desk', 'image' => $this->copyAsset('doctore.png', 'hospital-galleries/green-life-support.png')],
                ],
                'services' => [
                    ['title' => 'Women Wellness and Gyne Care', 'description' => 'Private gynecology consultation, hormone review, menstrual health support, and wellness follow-up.'],
                    ['title' => 'Child Growth and Fever Clinic', 'description' => 'Routine child consultation, growth monitoring, infection review, and guardian guidance in one flow.'],
                    ['title' => 'Neurology Consultation Support', 'description' => 'Headache, dizziness, and nerve-related symptom assessment with structured referral and treatment planning.'],
                ],
                'doctors' => [
                    ['department' => 'GYN', 'name' => 'Dr. Tania Sultana', 'email' => 'tania.greenlife@example.com', 'photo' => $this->copyAsset('Female.jpg', 'doctors/tania-sultana.jpg'), 'speciality' => 'Gynecology and Women Wellness Specialist', 'experience' => '9+ years in women wellness care and outpatient procedures.', 'shifts' => [['day' => 'Sat', 'time' => '9:00 AM - 1:00 PM'], ['day' => 'Tue', 'time' => '5:00 PM - 8:00 PM']]],
                    ['department' => 'PED', 'name' => 'Dr. Samiul Kabir', 'email' => 'samiul.greenlife@example.com', 'photo' => $this->copyAsset('Male.jpg', 'doctors/samiul-kabir.jpg'), 'speciality' => 'Pediatric and Child Health Consultant', 'experience' => '11+ years in pediatric care and vaccination counseling.', 'shifts' => [['day' => 'Sun', 'time' => '10:00 AM - 2:00 PM'], ['day' => 'Thu', 'time' => '4:00 PM - 7:00 PM']]],
                    ['department' => 'NEU', 'name' => 'Dr. Mst. Arifa Noor', 'email' => 'arifa.greenlife@example.com', 'photo' => $this->copyAsset('Female.jpg', 'doctors/arifa-noor.jpg'), 'speciality' => 'Neurology Consultant', 'experience' => '7+ years in migraine, dizziness, and nerve pain evaluation.', 'shifts' => [['day' => 'Mon', 'time' => '11:00 AM - 3:00 PM'], ['day' => 'Fri', 'time' => '6:00 PM - 8:30 PM']]],
                ],
            ],
            'hospital3@gmail.com' => [
                'profile' => [
                    'hospital_location' => 'Section 10, Mirpur, Dhaka',
                    'address' => 'Section 10, Mirpur, Dhaka, Bangladesh',
                    'photo' => $this->copyAsset('AdminLTELogo.png', 'hospitals/popular-diagnostic-center.png'),
                    'about_hospital' => '<p><strong>Popular Diagnostic Center</strong> combines diagnostics, orthopedic support, medicine consultation, and specialist review for patients in Mirpur and nearby neighborhoods.</p><p>The hospital is designed around quick testing support, report handling, referral-friendly chambers, and practical follow-up communication for patients and families.</p>',
                    'privacy_policy' => '<p>Popular Diagnostic Center uses patient information only for reporting, scheduling, treatment coordination, and service quality review.</p><p>Medical records are handled under standard operational controls and remain accessible only to approved clinical and administrative staff.</p>',
                ],
                'galleries' => [
                    ['title' => 'Diagnostic Sample Collection Area', 'image' => $this->copyAsset('default.png', 'hospital-galleries/popular-diagnostic-lab.png')],
                    ['title' => 'Orthopedic Consultation Room', 'image' => $this->copyAsset('doctore.png', 'hospital-galleries/popular-diagnostic-ortho.png')],
                    ['title' => 'Main Hospital Reception', 'image' => $this->copyAsset('register.jpg', 'hospital-galleries/popular-diagnostic-reception.jpg')],
                ],
                'services' => [
                    ['title' => 'Bone, Joint, and Pain Clinic', 'description' => 'Orthopedic review for fracture recovery, arthritis, back pain, and mobility support planning.'],
                    ['title' => 'Routine Diagnostic and Lab Tests', 'description' => 'Basic lab support, test coordination, doctor-directed reporting, and repeat follow-up scheduling.'],
                    ['title' => 'Diabetes and Blood Pressure Follow-up', 'description' => 'Ongoing medicine consultation with blood sugar and blood pressure management support.'],
                ],
                'doctors' => [
                    ['department' => 'ORT', 'name' => 'Dr. Mahmud Alam', 'email' => 'mahmud.popular@example.com', 'photo' => $this->copyAsset('Male.jpg', 'doctors/mahmud-alam.jpg'), 'speciality' => 'Orthopedic Consultant', 'experience' => '13+ years in trauma, joint pain, and rehabilitation planning.', 'shifts' => [['day' => 'Mon', 'time' => '10:00 AM - 1:00 PM'], ['day' => 'Thu', 'time' => '5:00 PM - 8:00 PM']]],
                    ['department' => 'MED', 'name' => 'Dr. Sharmin Akter', 'email' => 'sharmin.popular@example.com', 'photo' => $this->copyAsset('Female.jpg', 'doctors/sharmin-akter.jpg'), 'speciality' => 'Medicine Specialist', 'experience' => '10+ years in diabetes, blood pressure, and long-term patient follow-up.', 'shifts' => [['day' => 'Sat', 'time' => '11:00 AM - 2:00 PM'], ['day' => 'Wed', 'time' => '6:00 PM - 8:30 PM']]],
                    ['department' => 'CAR', 'name' => 'Dr. Imran Hossain', 'email' => 'imran.popular@example.com', 'photo' => $this->copyAsset('Male.jpg', 'doctors/imran-hossain.jpg'), 'speciality' => 'Cardiology Consultant', 'experience' => '8+ years in preventive heart care and risk screening.', 'shifts' => [['day' => 'Sun', 'time' => '10:30 AM - 1:30 PM'], ['day' => 'Tue', 'time' => '5:30 PM - 8:00 PM']]],
                ],
            ],
        ];

        foreach ($hospitals as $email => $payload) {
            $hospital = User::query()->where('email', $email)->first();

            if (! $hospital) {
                continue;
            }

            $hospital->update($payload['profile']);

            foreach ($payload['galleries'] as $gallery) {
                HospitalGallery::updateOrCreate(
                    ['owner_id' => $hospital->id, 'title' => $gallery['title']],
                    ['image' => $gallery['image']]
                );
            }

            foreach ($payload['services'] as $service) {
                Service::updateOrCreate(
                    ['owner_id' => $hospital->id, 'title' => $service['title']],
                    ['description' => $service['description'], 'image' => null]
                );
            }

            foreach ($payload['doctors'] as $doctorData) {
                Doctor::updateOrCreate(
                    ['owner_id' => $hospital->id, 'email' => $doctorData['email']],
                    [
                        'name' => $doctorData['name'],
                        'phone' => $hospital->phone,
                        'department_id' => $departments[$doctorData['department']]->id,
                        'speciality' => $doctorData['speciality'],
                        'experience' => $doctorData['experience'],
                        'district' => $hospital->district,
                        'thana' => $hospital->thana,
                        'area' => $hospital->area,
                        'status' => 'active',
                        'show_on_homepage' => true,
                        'photo' => $doctorData['photo'],
                        'description' => '<p>' . e($doctorData['name']) . ' provides consultation support at ' . e($hospital->hospital_name) . ' with a focus on patient-friendly communication, structured diagnosis, and follow-up treatment planning.</p>',
                        'educations' => [
                            ['degree' => 'MBBS', 'institution' => 'Dhaka Medical College'],
                            ['degree' => 'Specialist Training', 'institution' => 'Bangladesh College of Physicians and Surgeons'],
                        ],
                        'shifts' => $doctorData['shifts'] ?? [],
                        'social_links' => [],
                    ]
                );
            }
        }
    }

    private function copyAsset(string $assetName, string $storagePath): string
    {
        $source = public_path('assets/img/' . $assetName);

        if (! File::exists($source)) {
            return '';
        }

        if (! Storage::disk('public')->exists($storagePath)) {
            Storage::disk('public')->put($storagePath, File::get($source));
        }

        return $storagePath;
    }
}
