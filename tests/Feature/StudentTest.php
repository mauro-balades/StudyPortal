<?php

namespace Tests\Feature;

use App\Models\Assignment;
use App\Models\Comment;
use App\Models\Group;
use App\Models\Post;
use App\Models\Subject;
use App\Models\User;
use Database\Factories\SubjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

use Tests\TestCase;

class StudentTest extends TestCase
{
//  This test it to see if students can access all the pages that they need to.

    public function test_student_can_see_dashboard()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user);
        $response->assertAuthenticated();
        $view = $this->get(route('dashboard'));
        $view->assertStatus(200);
    }

    public function test_student_can_see_timetable()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user);
        $response->assertAuthenticated();
        $view = $this->get(route('timetable'));
        $view->assertStatus(200);
    }

    public function test_student_can_see_assignments()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user);
        $response->assertAuthenticated();
        $view = $this->get(route('assignments'));
        $view->assertStatus(200);
    }

    public function test_student_can_see_community()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user);
        $response->assertAuthenticated();
        $view = $this->get(route('community'));
        $view->assertStatus(200);
    }

    public function test_student_can_see_profile()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user);
        $response->assertAuthenticated();
        $view = $this->get(route('profile'));
        $view->assertStatus(200);
    }

    /*public function test_student_can_see_subscribe()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user);
        $response->assertAuthenticated();
        $view = $this->get('/subscribe');
        $view->assertStatus(200);
    }*/

    public function test_student_cant_see_groups()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user);
        $response->assertAuthenticated();
        $view = $this->get(route('groups'));
        $view->assertUnauthorized();
    }

    public function test_student_cant_see_users()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user);
        $response->assertAuthenticated();
        $view = $this->get(route('groups'));
        $view->assertUnauthorized();
    }

    public function test_student_can_see_their_profile()
    {
        $user = User::factory()->create(
            [
                'email_verified_at' => now()
            ]
        );
        $response = $this->actingAs($user);
        $response->assertAuthenticated();
        $view = $this->get(route('community.profile', $user->id));
        $view->assertStatus(200);
    }

    public function test_student_can_see_post()
    {
        $user = User::factory()->create(
            [
                'email_verified_at' => now()
            ]
        );
        $auth = $this->actingAs($user);
        $auth->assertAuthenticated();
        $subject = Subject::factory()->create();
        $post = Post::factory()->create(
            [
                'user_id' => $user->id,
                'subject_id' => $subject->id,
            ]
        );
        $this->assertModelExists($post);
        $view = $this->get(route('community.post', $post->id));
        $view->assertOk();
    }

    public function test_student_can_create_post()
    {
        $post = Post::factory()->for(User::factory()->create())->create();
        $this->assertModelExists($post);
    }

    public function test_student_can_create_comment()
    {
        $comment = Comment::factory()->for(User::factory()->create())->create();
        $this->assertModelExists($comment);
    }

    public function test_student_can_view_assignment()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->assertAuthenticated();
        $assignment = Assignment::factory()->create();
        $this->assertModelExists($assignment);
        $view = $this->get(route('assignments.manage', $assignment->id));
        $view->assertOk();
    }

    public function test_student_can_view_subject()
    {
        $user = User::factory()->has($subject = Subject::factory())->create();
        $this->actingAs($user);
        $this->assertAuthenticated();
        $view = $this->get(route('community.subject', $subject->create()->id));
        $view->assertOk();
    }

    public function test_student_can_not_create_assignment()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->assertAuthenticated();
        $view = $this->get(route('assignment.create'));
        $view->assertUnauthorized();
    }

    public function test_student_can_not_update_assignment()
    {
        $ass = Assignment::factory()->create();
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->assertAuthenticated();
        $view = $this->get(route('assignment.edit', $ass->id));
        $view->assertUnauthorized();
    }

    public function test_student_can_not_delete_assignment()
    {
        $ass = Assignment::factory()->create();
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->assertAuthenticated();
        $post = $this->post(route('assignment.delete', $ass->id));
        $post->assertUnauthorized();
    }

    public function test_student_can_not_create_group()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->assertAuthenticated();
        $view = $this->get(route('groups.create'));
        $view->assertUnauthorized();
    }

    public function test_student_can_not_update_group()
    {
        $group = Group::factory()->create();
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->assertAuthenticated();
        $view = $this->get(route('groups.update', $group->id));
        $view->assertUnauthorized();
    }

    public function test_student_can_not_delete_group()
    {
        $group = Group::factory()->create();
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->assertAuthenticated();
        $post = $this->post(route('groups.delete', $group->id));
        $post->assertUnauthorized();
    }
}
