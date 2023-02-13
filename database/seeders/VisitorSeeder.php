<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Visitor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class VisitorSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Visitor::create([
            'name' => 'John Doe',
            'phoneNumber' => '0123456789',
            'gender' => 'Male',
            'type' => 'walkin',
            'IDNO' => '123456789',
            'purposeId' => '2',
            'visitorTypeId' =>'1',
            'DOB' => '2000-01-01',
            'organizationId' => '1',
            'premisesId' => '1',
            'nationality' => 'Ethiopia',
            'tagId' => '1',
            'createdBy' => '1',
            'hostName' => 'Jane Doe',
            'site' => 'Site 1',
            'section' => 'Section 1',
            'timeIn' => '2023-01-01 09:09:09',
            'timeOut' => '2023-01-01 11:00:00',
        ]);

        Visitor::create([
            'name' => 'Jane Doe',
            'phoneNumber' => '9876543210',
            'gender' => 'Female',
            'type' => 'drivein',
            'IDNO' => '987654321',
            'purposeId' => '1',
            'visitorTypeId' =>'2',
            'DOB' => '1999-01-01',
            'organizationId' => '2',
            'premisesId' => '2',
            'nationality' => 'Tanzania',
            'tagId' => '2',
            'createdBy' => '1',
            'hostName' => 'John Doe',
            'site' => 'Site 2',
            'section' => 'Section 2',
            'timeIn' => '2023-01-02 08:00:00',
            'timeOut' => '2023-01-02 16:08:00',
        ]);

        Visitor::create([
            'name' => 'Tom Smith',
            'phoneNumber' => '0111111111',
            'gender' => 'Male',
            'type' => 'walkin',
            'IDNO' => '111111111',
            'purposeId' => '4',
            'DOB' => '1998-01-01',
            'visitorTypeId' =>'1',
            'organizationId' => '3',
            'premisesId' => '3',
            'nationality' => 'Kenya',
            'tagId' => '3',
            'createdBy' => '1',
            'hostName' => 'Jane Doe',
            'site' => 'Site 3',
            'section' => 'Section 3',
            'timeIn' => '2023-12-02 10:07:00',
//            'timeOut' => '2023-01-03 18:19:00',
        ]);

        Visitor::create([
            'name' => 'Samantha James',
            'phoneNumber' => '0122222222',
            'gender' => 'Female',
            'type' => 'drivein',
            'IDNO' => '222222222',
            'purposeId' => '3',
            'DOB' => '1997-01-01',
            'organizationId' => '4',
            'visitorTypeId' =>'3',
            'premisesId' => '4',
            'nationality' => 'Uganda',
            'tagId' => '4',
            'createdBy' => '1',
            'hostName' => 'John Doe',
            'site' => 'Site 4',
            'section' => 'Section 4',
            'timeIn' => '2023-01-04 10:12:00',
            'timeOut' => '2023-01-04 17:08:10',
        ]);
        Visitor::create([
            'name' => 'Michael Johnson',
            'phoneNumber' => '0133333333',
            'gender' => 'Male',
            'type' => 'walkin',
            'visitorTypeId' =>'3',
            'IDNO' => '333333333',
            'purposeId' => '5',
            'DOB' => '1996-01-01',
            'organizationId' => '5',
            'premisesId' => '5',
            'nationality' => 'Kenya',
            'tagId' => '3',
            'createdBy' => '1',
            'hostName' => 'Jane Doe',
            'site' => 'Site 5',
            'section' => 'Section 5',
            'timeIn' => '2023-02-12 11:00:00',
//            'timeOut' => ''
        //'timeOut' =>  (!empty($timeOut) ? $timeOut : '')
        ]);
    }
}
