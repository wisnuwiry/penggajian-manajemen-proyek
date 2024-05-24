<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // engineering
        Position::create(['position_name' => 'Software Engineer']);
        Position::create(['position_name' => 'Systems Engineer']);
        Position::create(['position_name' => 'DevOps Engineer']);
        Position::create(['position_name' => 'QA Engineer']);
        Position::create(['position_name' => 'UI/UX Designer']);

        // product development
        Position::create(['position_name' => 'Product Manager']);
        Position::create(['position_name' => 'Product Designer']);
        Position::create(['position_name' => 'Product Analyst']);
        Position::create(['position_name' => 'Technical Writer']);
        Position::create(['position_name' => 'Prototype Engineer']);

        // marketing & sales
        Position::create(['position_name' => 'Marketing Manager']);
        Position::create(['position_name' => 'Digital Marketing Specialist']);
        Position::create(['position_name' => 'Content Writer']);
        Position::create(['position_name' => 'SEO Analyst']);
        Position::create(['position_name' => 'Social Media Manager']);
        Position::create(['position_name' => 'Sales Manager']);
        Position::create(['position_name' => 'Account Executive']);
        Position::create(['position_name' => 'Business Development Representative']);
        Position::create(['position_name' => 'Sales Operations Analyst']);
        Position::create(['position_name' => 'Customer Success Manager']);

        // customer support
        Position::create(['position_name' => 'Customer Support Specialist']);
        Position::create(['position_name' => 'Technical Support Engineer']);
        Position::create(['position_name' => 'Customer Support Manager']);
        Position::create(['position_name' => 'Service Desk Analyst']);
        Position::create(['position_name' => 'Client Relations Manager']);

        // HR
        Position::create(['position_name' => 'Customer Support Specialist']);
        Position::create(['position_name' => 'Technical Support Engineer']);
        Position::create(['position_name' => 'Customer Support Manager']);
        Position::create(['position_name' => 'Service Desk Analyst']);
        Position::create(['position_name' => 'Client Relations Manager']);

        // Finance
        Position::create(['position_name' => 'Finance Manager']);
        Position::create(['position_name' => 'Financial Analyst']);
        Position::create(['position_name' => 'Accountant']);
        Position::create(['position_name' => 'Billing Specialist']);
        Position::create(['position_name' => 'Tax Advisor']);

        // Legal
        Position::create(['position_name' => 'Legal Counsel']);
        Position::create(['position_name' => 'Compliance Officer']);
        Position::create(['position_name' => 'Intellectual Property Lawyer']);
        Position::create(['position_name' => 'Contracts Specialist']);
        Position::create(['position_name' => 'Privacy Officer']);

        // Business Development
        Position::create(['position_name' => 'Business Development Manager']);
        Position::create(['position_name' => 'Partnerships Manager']);
        Position::create(['position_name' => 'Market Research Analyst']);
        Position::create(['position_name' => 'Strategy Consultant']);
        Position::create(['position_name' => 'Sales Operations Manager']);
    }
}
