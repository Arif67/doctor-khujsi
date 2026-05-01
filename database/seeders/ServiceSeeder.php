<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $services = [
            [
                'title' => 'General Health Checkup',
                'description' => 'Comprehensive routine health screening designed to detect early warning signs before they become serious. This service includes doctor consultation, blood pressure review, BMI assessment, lifestyle guidance, and essential lab recommendations for ongoing wellness.',
                'image' => null,
            ],
            [
                'title' => 'Cardiology Consultation',
                'description' => 'Focused heart care for patients experiencing chest discomfort, shortness of breath, irregular heartbeat, or blood pressure issues. Our cardiology service supports risk evaluation, ECG guidance, medication review, and preventive heart health planning.',
                'image' => null,
            ],
            [
                'title' => 'Diabetes Management',
                'description' => 'Personalized diabetes care for both newly diagnosed and existing patients. The service covers blood sugar monitoring strategy, nutrition counseling, medication follow-up, and long-term complication prevention to help patients maintain a stable lifestyle.',
                'image' => null,
            ],
            [
                'title' => 'Pediatric Care',
                'description' => 'Child-focused healthcare support for infants, children, and adolescents. This service includes growth monitoring, fever and infection review, nutrition guidance, vaccination consultation, and development-based follow-up with a family-centered approach.',
                'image' => null,
            ],
            [
                'title' => 'Women Wellness Care',
                'description' => 'Dedicated women health services for preventive screening, hormonal concerns, menstrual health, pregnancy guidance, and overall wellness management. Patients receive private consultations and tailored treatment planning based on age and symptoms.',
                'image' => null,
            ],
            [
                'title' => 'Orthopedic Support',
                'description' => 'Diagnosis and care planning for bone, joint, muscle, and mobility-related problems. This service helps patients manage injury recovery, arthritis symptoms, posture issues, back pain, and movement limitations with practical treatment direction.',
                'image' => null,
            ],
            [
                'title' => 'Physiotherapy Service',
                'description' => 'Recovery-focused physiotherapy sessions for pain relief, mobility improvement, rehabilitation after injury, and strength rebuilding. Care plans are adapted to each patient based on condition severity, movement goals, and daily activity needs.',
                'image' => null,
            ],
            [
                'title' => 'Skin and Allergy Care',
                'description' => 'Specialized treatment support for skin irritation, acne, eczema, allergies, and recurring rash concerns. The service combines symptom review, trigger identification, treatment planning, and prevention advice for healthy skin recovery.',
                'image' => null,
            ],
            [
                'title' => 'Mental Health Counseling',
                'description' => 'Supportive counseling for stress, anxiety, low mood, burnout, and emotional imbalance. Patients receive a safe environment for discussion, professional guidance, and practical strategies that promote mental wellness and consistent follow-up care.',
                'image' => null,
            ],
            [
                'title' => 'Nutrition and Lifestyle Guidance',
                'description' => 'Evidence-based diet and lifestyle consultation for weight management, energy improvement, chronic disease prevention, and recovery support. The service includes nutrition planning, healthy habit coaching, and realistic daily wellness recommendations.',
                'image' => null,
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(
                ['title' => $service['title']],
                $service
            );
        }
    }
}
