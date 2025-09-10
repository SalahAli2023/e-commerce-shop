<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // حذف المستخدمين الموجودين إذا كانوا موجودين
        User::query()->delete();
        
        // إنشاء مستخدم مدير
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'phone_number' => '+1234567890',
            'email_verified_at' => now(),
        ]);
        
        // إنشاء مستخدم عادي
        User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'phone_number' => '+0987654321',
            'email_verified_at' => now(),
        ]);
        
        // إنشاء مستخدمين إضافيين باستخدام الفاكتوري
        User::factory()->count(20)->create();
        
        $this->command->info(' Users created successfully!');
        $this->command->info(' Total users: ' . User::count());
        $this->command->info(' Admin user: admin@example.com / password');
        $this->command->info(' Regular user: user@example.com / password');
    }
}