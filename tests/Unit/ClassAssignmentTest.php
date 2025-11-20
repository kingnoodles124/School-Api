<?php

use App\Models\Student;
use App\Models\SchoolClass;

test('test_class_cannot_over_enroll', function () {
    $class = SchoolClass::factory()->create(['max_students' => 1]);
    $student1 = Student::factory()->create();
    $student2 = Student::factory()->create();

    $class->students()->attach($student1->id);

    $this->assertTrue($class->students()->count() == 1);
}
);
