<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::create(['department_name' => 'Engineering']);
        Department::create(['department_name' => 'Product Development']);
        Department::create(['department_name' => 'Research and Development']);
        Department::create(['department_name' => 'Marketing']);
        Department::create(['department_name' => 'Sales']);
        Department::create(['department_name' => 'Customer Support']);
        Department::create(['department_name' => 'Human Resources']);
        Department::create(['department_name' => 'Finance']);
        Department::create(['department_name' => 'IT Operations']);
        Department::create(['department_name' => 'Quality Assurance']);
        Department::create(['department_name' => 'Design']);
        Department::create(['department_name' => 'Data Science']);
        Department::create(['department_name' => 'Project Management']);
        Department::create(['department_name' => 'Legal']);
        Department::create(['department_name' => 'Business Development']);
    }
}
