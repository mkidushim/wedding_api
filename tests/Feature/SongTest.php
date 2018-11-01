<?php

namespace Tests\Feature;
use App\Song;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
class SongTest extends TestCase
{
    public function testsSongsAreCreatedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $payload = [
            'name' => 'Lorem',
            'artist' => 'Ipsum',
        ];

        $this->json('POST', '/api/songs', $payload, $headers)
            ->assertStatus(200)
            ->assertJson(['id' => 1, 'name' => 'Lorem', 'artist' => 'Ipsum']);
    }

    public function testsSongsAreUpdatedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $song = factory(Song::class)->create([
            'name' => 'First Song',
            'artist' => 'First Body',
        ]);

        $payload = [
            'name' => 'Lorem',
            'artist' => 'Ipsum',
        ];

        $response = $this->json('PUT', '/api/songs/' . $song->id, $payload, $headers)
            ->assertStatus(200)
            ->assertJson([ 
                'id' => 1, 
                'name' => 'Lorem', 
                'artist' => 'Ipsum' 
            ]);
    }

    public function testsArtilcesAreDeletedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $song = factory(Song::class)->create([
            'name' => 'First Song',
            'artist' => 'First Body',
        ]);

        $this->json('DELETE', '/api/songs/' . $song->id, [], $headers)
            ->assertStatus(204);
    }

    public function testSongsAreListedCorrectly()
    {
        factory(Song::class)->create([
            'name' => 'First Song',
            'artist' => 'First Body'
        ]);

        factory(Song::class)->create([
            'name' => 'Second Song',
            'artist' => 'Second Body'
        ]);

        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];

        $response = $this->json('GET', '/api/songs', [], $headers)
            ->assertStatus(200)
            ->assertJson([
                [ 'name' => 'First Song', 'artist' => 'First Body' ],
                [ 'name' => 'Second Song', 'artist' => 'Second Body' ]
            ])
            ->assertJsonStructure([
                '*' => ['id', 'name', 'artist', 'created_at', 'updated_at'],
            ]);
    }

}