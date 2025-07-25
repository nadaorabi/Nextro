<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;

class TestPaymentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get some users for testing
        $students = User::where('role', 'student')->take(5)->get();
        $teachers = User::where('role', 'teacher')->take(3)->get();

        if ($students->count() == 0) {
            $this->command->info('No students found. Creating test students...');
            $students = User::factory(5)->create(['role' => 'student']);
        }

        if ($teachers->count() == 0) {
            $this->command->info('No teachers found. Creating test teachers...');
            $teachers = User::factory(3)->create(['role' => 'teacher']);
        }

        // Create test payments
        $payments = [
            // Student fees (positive amounts)
            ['user_id' => $students->first()->id, 'type' => 'student_fee', 'amount' => 150.00, 'payment_date' => now()->subDays(5)],
            ['user_id' => $students->first()->id, 'type' => 'student_fee', 'amount' => 200.00, 'payment_date' => now()->subDays(10)],
            ['user_id' => $students->get(1)->id, 'type' => 'student_fee', 'amount' => 180.00, 'payment_date' => now()->subDays(3)],
            ['user_id' => $students->get(2)->id, 'type' => 'package_fee', 'amount' => 300.00, 'payment_date' => now()->subDays(1)],
            ['user_id' => $students->get(3)->id, 'type' => 'student_fee', 'amount' => 120.00, 'payment_date' => now()],
            
            // This month payments
            ['user_id' => $students->get(4)->id, 'type' => 'student_fee', 'amount' => 250.00, 'payment_date' => now()],
            ['user_id' => $students->first()->id, 'type' => 'package_fee', 'amount' => 400.00, 'payment_date' => now()->subDays(2)],
            
            // Teacher payments (negative amounts)
            ['user_id' => $teachers->first()->id, 'type' => 'instructor_payment', 'amount' => -80.00, 'payment_date' => now()->subDays(7)],
            ['user_id' => $teachers->get(1)->id, 'type' => 'instructor_payment', 'amount' => -100.00, 'payment_date' => now()->subDays(4)],
            
            // Discounts (negative amounts)
            ['user_id' => $students->get(2)->id, 'type' => 'discount', 'amount' => -50.00, 'payment_date' => now()->subDays(6)],
            ['user_id' => $students->get(3)->id, 'type' => 'discount', 'amount' => -30.00, 'payment_date' => now()->subDays(8)],
        ];

        foreach ($payments as $payment) {
            Payment::create([
                'user_id' => $payment['user_id'],
                'type' => $payment['type'],
                'amount' => $payment['amount'],
                'payment_date' => $payment['payment_date'],
                'notes' => 'Test payment for dashboard statistics'
            ]);
        }

        $this->command->info('Test payments created successfully!');
        $this->command->info('Total Revenue: $' . Payment::where('amount', '>', 0)->sum('amount'));
        $this->command->info('This Month Revenue: $' . Payment::where('amount', '>', 0)
            ->whereMonth('payment_date', now()->month)
            ->whereYear('payment_date', now()->year)
            ->sum('amount'));
    }
} 