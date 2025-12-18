<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\Feedback;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CourseFeedbackTest extends TestCase
{
    use RefreshDatabase;

    public function test_courses_crud_and_search(): void
    {
        $c1 = Course::factory()->create(['title' => 'Laravel Basics', 'category' => 'Web']);
        $c2 = Course::factory()->create(['title' => 'Android Dev', 'category' => 'Mobile']);

        $res = $this->get('/courses?q=Laravel');
        $res->assertStatus(200);
        $res->assertSee('Laravel Basics');
        $res->assertDontSee('Android Dev');

        // create
        $payload = [
            'title' => 'Data Science 101',
            'category' => 'Data',
            'difficulty_level' => 'beginner',
            'price' => 25.5,
        ];
        $this->post('/courses', $payload)->assertRedirect();
        $this->assertDatabaseHas('courses', ['title' => 'Data Science 101']);

        // update
        $this->put("/courses/{$c1->id}", ['title' => 'Laravel Advanced', 'category' => 'Web', 'difficulty_level' => 'advanced', 'price' => 100])
            ->assertRedirect();
        $this->assertDatabaseHas('courses', ['id' => $c1->id, 'title' => 'Laravel Advanced']);

        // delete
        $this->delete("/courses/{$c2->id}")->assertRedirect();
        $this->assertDatabaseMissing('courses', ['id' => $c2->id]);
    }

    public function test_feedback_create_default_status_and_forbidden_update_delete(): void
    {
        $course = Course::factory()->create();

        $payload = [
            'course_id' => $course->id,
            'author_name' => 'Alice',
            'comment' => 'Great!',
            'score' => 8,
        ];

        $this->post('/feedbacks', $payload)->assertRedirect();
        $fb = Feedback::first();
        $this->assertNotNull($fb);
        $this->assertEquals('new', $fb->status);

        // Try to update forbidden field
        $this->expectException(\RuntimeException::class);
        $fb->update(['comment' => 'Edited']);
    }

    public function test_feedback_status_change_and_filtering(): void
    {
        $course = Course::factory()->create();
        $fNew = Feedback::factory()->create(['course_id' => $course->id]);
        $fPub = Feedback::factory()->published()->create(['course_id' => $course->id]);

        // change status
        $this->patch("/feedbacks/{$fNew->id}/status/published")->assertRedirect();
        $this->assertDatabaseHas('feedback', ['id' => $fNew->id, 'status' => 'published']);

        // filter
        $res = $this->get("/courses/{$course->id}/feedbacks/status/published");
        $res->assertStatus(200);
        $res->assertSee((string) $fPub->id);
    }
}

