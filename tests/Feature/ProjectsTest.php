<?php
use Symfony\Component\HttpFoundation\Response;
use App\Models\Project;

test('a user can see his projects', function () {
    $response = $this->getJson(route('projects.index'));
    $response->assertStatus(Response::HTTP_OK);
});

test('a project requires a title', function () {
    $attributes = Project::factory()->raw(['title' => '']);
    $response = $this->postJson(route('projects.store'), $attributes);
    $response->assertStatus(Response::HTTP_BAD_REQUEST)
             ->assertJson(['message' => 'The title is required.']);
});

test('a project requires a description', function () {
    $attributes = Project::factory()->raw(['description' => '']);
    $response = $this->postJson(route('projects.store'), $attributes);
    $response->assertStatus(Response::HTTP_BAD_REQUEST)
             ->assertJson(['message' => 'The description is required.']);
});

test('a project requires an owner', function () {
    $attributes = Project::factory()->raw(['user_id' => null]);
    $response = $this->postJson(route('projects.store'), $attributes);
    $response->assertStatus(Response::HTTP_BAD_REQUEST)
        ->assertJson(['message' => 'The project requires an owner.']);
});

test('a user can create a project', function () {
    $attributes = Project::factory()->raw();
    $response = $this->postJson(route('projects.store'), $attributes);
    $response->assertStatus(Response::HTTP_CREATED)
             ->assertJson(['message' => 'The project is created successfully.']);

    $project = Project::latest()->first();

        expect($project->uuid)->toBeString()->not->toBeEmpty()
        ->and($project->title)->toBeString()->toEqual($attributes['title'])
        ->and($project->description)->toBeString()->toEqual($attributes['description']);

});

test('a user can view a project', function () {
    $project = Project::factory()->create();
    $response = $this->getJson(route('projects.show', $project->uuid));
    $response->assertStatus(Response::HTTP_OK);
});

test('a user can delete a project', function () {
    $project = Project::factory()->create();
    $response = $this->deleteJson(route('projects.destroy', $project->uuid));
    $response->assertStatus(Response::HTTP_OK)
             ->assertJson(['message' => 'The project is deleted successfully.']);
});
