<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\Student;
use App\Models\SchoolClass;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

class ClassAssignmentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_assign_student_to_class_via_endpoint()
    {
        // Create admin and authenticate
        $admin = Admin::factory()->create();
        Sanctum::actingAs($admin, [], 'sanctum');

        // Create a class and a student
        $class = SchoolClass::factory()->create(['max_students' => 2]);
        $student = Student::factory()->create();

        // Call the assign endpoint
        $response = $this->postJson("/api/classes/{$class->id}/assign/{$student->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['message' => 'Student assigned']);

        // verify pivot row exists
        $this->assertDatabaseHas('class_student', [
            'school_class_id' => $class->id,
            'student_id' => $student->id,
        ]);
    }
}
