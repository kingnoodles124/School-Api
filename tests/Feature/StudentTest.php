<?php

test('test_student_can_be_created', function () {
    $response = $this->postJson('/api/students', [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'birthdate' => '2010-01-01',
        'grade' => '5A'
    ]);

    $response->assertStatus(201);
});


