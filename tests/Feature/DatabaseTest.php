<?php

namespace Tests\Feature;

use App\Models\Assignment;
use App\Models\Comment;
use App\Models\Group;
use App\Models\Institution;
use App\Models\Post;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DatabaseTest extends TestCase
{
    public function test_users_can_be_created()
    {
        $user = User::factory()->create();
        $this->assertModelExists($user);
    }

    public function test_users_can_be_deleted()
    {
        $user = User::factory()->create();
        $user->delete();
        $this->assertModelMissing($user);
    }

    public function test_subjects_can_be_created()
    {
        $subject = Subject::factory()->create();
        $this->assertModelExists($subject);
    }

    public function test_subjects_can_be_deleted()
    {
        $subject = Subject::factory()->create();
        $subject->delete();
        $this->assertModelMissing($subject);
    }

    public function test_posts_can_be_created()
    {
        $post = Post::factory()->create();
        $this->assertModelExists($post);
    }

    public function test_posts_can_be_deleted()
    {
        $post = Post::factory()->create();
        $post->delete();
        $this->assertModelMissing($post);
    }

    public function test_groups_can_be_created()
    {
        $group = Group::factory()->create();
        $this->assertModelExists($group);
    }

    public function test_groups_can_be_deleted()
    {
        $group = Group::factory()->create();
        $group->delete();
        $this->assertModelMissing($group);
    }

    public function test_assignment_can_be_created()
    {
        $assignment = Assignment::factory()->create();
        $this->assertModelExists($assignment);
    }

    public function test_assignment_can_be_deleted()
    {
        $assignment = Assignment::factory()->create();
        $assignment->delete();
        $this->assertModelMissing($assignment);
    }

    public function test_comment_can_be_created()
    {
        $comment = Comment::factory()->create();
        $this->assertModelExists($comment);
    }

    public function test_comment_can_be_deleted()
    {
        $comment = Comment::factory()->create();
        $comment->delete();
        $this->assertModelMissing($comment);
    }

    public function test_institution_can_be_created()
    {
        $institution = Institution::factory()->create();
        $this->assertModelExists($institution);
    }

    public function test_institution_can_be_deleted()
    {
        $institution = Institution::factory()->create();
        $institution->delete();
        $this->assertModelMissing($institution);
    }
}
