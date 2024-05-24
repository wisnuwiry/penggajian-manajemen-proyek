<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employee::create([
            'first_name' => 'Dian',
            'last_name' => 'Suryanto',
            'birth_date' => '1992-08-28',
            'hire_date' => '2017-04-15',
            'nik' => '2808922808920011',
            'email' => 'dian.suryanto@example.com',
            'phone_number' => '081234567890',
            'address' => 'Jl. Pahlawan No. 50, Medan',
            'salary' => 11000000,
            'bank_name' => 'Bank Mandiri',
            'bank_account_number' => '9876543210',
            'position_id' => 3, 
            'department_id' => 2, 
        ]);
        
        Employee::create([
            'first_name' => 'Rudi',
            'last_name' => 'Wibowo',
            'birth_date' => '1993-05-10',
            'hire_date' => '2018-01-20',
            'nik' => '1005931005930012',
            'email' => 'rudi.wibowo@example.com',
            'phone_number' => '087654321098',
            'address' => 'Jl. Sudirman No. 25, Palembang',
            'salary' => 12000000,
            'bank_name' => 'Bank BRI',
            'bank_account_number' => '1234567890',
            'position_id' => 2, 
            'department_id' => 1, 
        ]);
        
        Employee::create([
            'first_name' => 'Anita',
            'last_name' => 'Susilo',
            'birth_date' => '1990-12-15',
            'hire_date' => '2016-09-10',
            'nik' => '1512901512900013',
            'email' => 'anita.susilo@example.com',
            'phone_number' => '082134567890',
            'address' => 'Jl. Diponegoro No. 10, Semarang',
            'salary' => 13000000,
            'bank_name' => 'Bank BCA',
            'bank_account_number' => '1357924680',
            'position_id' => 4, 
            'department_id' => 3, 
        ]);
        
        Employee::create([
            'first_name' => 'Eko',
            'last_name' => 'Santoso',
            'birth_date' => '1991-11-20',
            'hire_date' => '2015-07-05',
            'nik' => '2011912011910014',
            'email' => 'eko.santoso@example.com',
            'phone_number' => '089876543210',
            'address' => 'Jl. Merdeka No. 15, Bandung',
            'salary' => 14000000,
            'bank_name' => 'Bank Mandiri',
            'bank_account_number' => '0987654321',
            'position_id' => 1, 
            'department_id' => 4, 
        ]);
        
        Employee::create([
            'first_name' => 'Linda',
            'last_name' => 'Kusuma',
            'birth_date' => '1988-07-18',
            'hire_date' => '2013-03-12',
            'nik' => '1807881807880015',
            'email' => 'linda.kusuma@example.com',
            'phone_number' => '081512345678',
            'address' => 'Jl. Veteran No. 30, Surabaya',
            'salary' => 15000000,
            'bank_name' => 'Bank BNI',
            'bank_account_number' => '7654321098',
            'position_id' => 5, 
            'department_id' => 5, 
        ]);
        
        
        Employee::create([
            'first_name' => 'Budi',
            'last_name' => 'Santoso',
            'birth_date' => '1995-11-10',
            'hire_date' => '2020-02-18',
            'nik' => '1011051011950003',
            'email' => 'budi.santoso@example.com',
            'phone_number' => '089876543210',
            'address' => 'Jl. Pahlawan No. 67, Bandung',
            'salary' => 10000000,
            'bank_name' => 'Bank Negara Indonesia (BNI)',
            'bank_account_number' => '1357924680',
            "position_id" => 1,
            "department_id" =>  4,
        ]);
        
        Employee::create([
            'first_name' => 'Dewi',
            'last_name' => 'Kusuma',
            'birth_date' => '1993-07-20',
            'hire_date' => '2018-09-05',
            'nik' => '3507204307930004',
            'email' => 'dewi.kusuma@example.com',
            'phone_number' => '085432109876',
            'address' => 'Jl. Merdeka No. 10, Yogyakarta',
            'salary' => 11000000,
            'bank_name' => 'Bank Rakyat Indonesia (BRI)',
            'bank_account_number' => '2468013579',
            "position_id" => 3,
            "department_id" =>  1,
        ]);
        
        Employee::create([
            'first_name' => 'Agus',
            'last_name' => 'Susanto',
            'birth_date' => '1987-05-05',
            'hire_date' => '2011-11-15',
            'nik' => '0505051505870005',
            'email' => 'agus.susanto@example.com',
            'phone_number' => '081987654321',
            'address' => 'Jl. Diponegoro No. 25, Malang',
            'salary' => 13000000,
            'bank_name' => 'Bank Danamon',
            'bank_account_number' => '9876543210',
            "position_id" => 5,
            "department_id" =>  3,
        ]);
        
        Employee::create([
            'first_name' => 'Lina',
            'last_name' => 'Sari',
            'birth_date' => '1991-12-18',
            'hire_date' => '2016-08-10',
            'nik' => '1812911812910006',
            'email' => 'lina.sari@example.com',
            'phone_number' => '087712345678',
            'address' => 'Jl. Veteran No. 8, Semarang',
            'salary' => 12500000,
            'bank_name' => 'Bank CIMB Niaga',
            'bank_account_number' => '7654321098',
            "position_id" => 2,
            "department_id" =>  5,
        ]);
        
        Employee::create([
            'first_name' => 'Hadi',
            'last_name' => 'Saputra',
            'birth_date' => '1989-04-30',
            'hire_date' => '2014-03-25',
            'nik' => '3004893004890007',
            'email' => 'hadi.saputra@example.com',
            'phone_number' => '082134567890',
            'address' => 'Jl. Pahlawan No. 15, Palembang',
            'salary' => 11500000,
            'bank_name' => 'Bank Permata',
            'bank_account_number' => '6543210987',
            "position_id" => 4,
            "department_id" =>  2,
        ]);
        
        Employee::create([
            'first_name' => 'Rini',
            'last_name' => 'Setiawan',
            'birth_date' => '1994-02-05',
            'hire_date' => '2019-12-12',
            'nik' => '0502945202940008',
            'email' => 'rini.setiawan@example.com',
            'phone_number' => '081512345678',
            'address' => 'Jl. Kartini No. 30, Solo',
            'salary' => 10500000,
            'bank_name' => 'Bank OCBC NISP',
            'bank_account_number' => '4321098765',
            "position_id" => 1,
            "department_id" =>  3,
        ]);
        
        Employee::create([
            'first_name' => 'Ahmad',
            'last_name' => 'Firmansyah',
            'birth_date' => '1986-08-12',
            'hire_date' => '2012-07-08',
            'nik' => '1208861208860009',
            'email' => 'ahmad.firmansyah@example.com',
            'phone_number' => '089654321234',
            'address' => 'Jl. Cendrawasih No. 5, Makassar',
            'salary' => 14000000,
            'bank_name' => 'Bank HSBC Indonesia',
            'bank_account_number' => '9876541230',
            "position_id" => 3,
            "department_id" =>  4,
        ]);
        
        Employee::create([
            'first_name' => 'Rini',
            'last_name' => 'Handayani',
            'birth_date' => '1990-11-28',
            'hire_date' => '2017-10-15',
            'nik' => '2811902811900010',
            'email' => 'rini.handayani@example.com',
            'phone_number' => '087612345678',
            'address' => 'Jl. Merak No. 20, Denpasar',
            'salary' => 10800000,
            'bank_name' => 'Bank Mega',
            'bank_account_number' => '5678901234',
            "position_id" => 2,
            "department_id" =>  1
        ]);
        
    }
}
