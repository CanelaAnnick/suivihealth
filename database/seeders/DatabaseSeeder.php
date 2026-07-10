<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Medecin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@suivihealth.cm',
            'password' => Hash::make('password'),
            'role' => 'superadmin',
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@suivihealth.cm',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $medecinUser = User::create([
            'name' => 'Dr. Jean Belinga',
            'email' => 'medecin@suivihealth.cm',
            'password' => Hash::make('password'),
            'role' => 'medecin',
        ]);

        Medecin::create([
            'user_id' => $medecinUser->id,
            'specialite' => 'Médecine générale',
            'type' => 'generaliste',
            'region' => 'Littoral',
            'hopital' => 'Hôpital Laquintinie',
            'numero_ordre' => 'CM-2024-0001',
            'telephone' => '+237600000000',
        ]);
        $specialisteUser = User::create([
            'name' => 'Dr. Marie Ngo',
            'email' => 'specialiste@suivihealth.cm',
            'password' => Hash::make('password'),
            'role' => 'medecin',
        ]);
        
        Medecin::create([
            'user_id' => $specialisteUser->id,
            'specialite' => 'Cardiologie',
            'type' => 'specialiste',
            'region' => 'Centre',
            'hopital' => 'Hôpital Central de Yaoundé',
            'numero_ordre' => 'CM-2024-0002',
            'telephone' => '+237600000001',
        ]);
    }
}
