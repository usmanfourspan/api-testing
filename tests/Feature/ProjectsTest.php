<?php
use Symfony\Component\HttpFoundation\Response;
use App\Models\Project;

test('a user can see his projects', function () {
    $response = $this->getJson(route('projects.index'));
    $response->assertStatus(Response::HTTP_OK);
});

test('a project requires a title', function () {
    $atttributes = Project::factory()->raw(['title' => '']);
    $response = $this->postJson(route('projects.store'), $atttributes);
    $response->assertStatus(Response::HTTP_BAD_REQUEST)
             ->assertJson(['message' => 'The title field is required.']);
});

test('a project requires a description', function () {
    $atttributes = Project::factory()->raw(['description' => '']);
    $response = $this->postJson(route('projects.store'), $atttributes);
    $response->assertStatus(Response::HTTP_BAD_REQUEST)
             ->assertJson(['message' => 'The description field is required.']);
});

test('a project requires an owner', function () {
    $atttributes = Project::factory()->raw(['user_id' => null]);
    $response = $this->postJson(route('projects.store'), $atttributes);
    $response->assertStatus(Response::HTTP_BAD_REQUEST)
        ->assertJson(['message' => 'The project requires an owner.']);
});

test('a user can create a project', function () {
    $atttributes = Project::factory()->raw();
    $response = $this->postJson(route('projects.store'), $atttributes);
    $response->assertStatus(Response::HTTP_CREATED)
             ->assertJson(['message' => 'The project is created successfully.']);

    $project = Project::latest()->first();

        expect($project->uuid)->toBeString()->not->toBeEmpty()
        ->and($project->title)->toBeString()->toEqual($atttributes['title'])
        ->and($project->description)->toBeString()->toEqual($atttributes['description']);

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
