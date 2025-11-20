<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

class StudentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_student_can_be_created()
    {
        // Create an admin and authenticate via Sanctum
        $admin = Admin::factory()->create([
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);
        Sanctum::actingAs($admin, [], 'sanctum');

        $payload = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'birthdate' => '2010-01-01',
            'grade' => '5A',
        ];

        $response = $this->postJson('/api/students', $payload);

        $response->assertStatus(201)
                 ->assertJsonFragment([
                     'name' => 'John Doe',
                     'email' => 'john@example.com',
                     'grade' => '5A',
                 ]);

        $this->assertDatabaseHas('students', [
            'email' => 'john@example.com',
            'name' => 'John Doe'
        ]);
    }

    /** @test */
    public function test_student_creation_validation_errors()
    {
        // Admin auth
        $admin = Admin::factory()->create();
        Sanctum::actingAs($admin, [], 'sanctum');

        // Missing required fields
        $response = $this->postJson('/api/students', []);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name', 'email', 'birthdate', 'grade']);
    }
}
