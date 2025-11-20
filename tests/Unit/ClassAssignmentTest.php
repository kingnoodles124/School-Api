<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\Student;
use App\Models\SchoolClass;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

class ClassOverEnrollmentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_class_cannot_over_enroll()
    {
        // admin auth
        $admin = Admin::factory()->create();
        Sanctum::actingAs($admin, [], 'sanctum');

        // class with capacity 1
        $class = SchoolClass::factory()->create(['max_students' => 1]);

        // attach one student directly
        $student1 = Student::factory()->create();
        $class->students()->attach($student1->id);

        // try to assign a second student via endpoint
        $student2 = Student::factory()->create();

        $response = $this->postJson("/api/classes/{$class->id}/assign/{$student2->id}");

        // expecting 400 + class full message
        $response->assertStatus(400)
                 ->assertJson(['message' => 'Class is full.']);

        // ensure second student was NOT attached
        $this->assertDatabaseMissing('class_student', [
            'school_class_id' => $class->id,
            'student_id' => $student2->id,
        ]);
    }
}
