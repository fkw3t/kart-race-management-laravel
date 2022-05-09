<?php

namespace Tests\Unit\app\Http\Controllers;

// use PHPUnit\Framework\TestCase;

use App\Models\User\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /* create */

    public function testUsersWithInvalidPayloadShouldntBeCreated(): void
    {
        $faker = \Faker\Factory::create('pt_BR');
        $response = $this->post('api/user', [
            'name' => null,
            'document_number' => null,
            'age' => null,
            'email' => null,
            'phone' => null,
        ]);

        $response->assertStatus(422);
    }

    public function testUsersWithInvalidDocumentNumberShouldntBeCreated(): void
    {
        $faker = \Faker\Factory::create('pt_BR');
        $response = $this->post('api/user', [
            'name' => $faker->name,
            'document_number' => strval($faker->numberBetween(111111111111, 999999999999)),
            'age' => $faker->numberBetween(18, 65),
            'email' => $faker->email,
            'phone' => '(31) 91234-1234',
        ]);

        $response->assertStatus(422);
    }

    public function testUsersWithInvalidPhoneShouldntBeCreated(): void
    {
        $faker = \Faker\Factory::create('pt_BR');
        $response = $this->post('api/user', [
            'name' => $faker->name,
            'document_number' => strval($faker->numberBetween(111111111111, 999999999999)),
            'age' => $faker->numberBetween(18, 65),
            'email' => $faker->email(),
            'phone' => '(31) 91234-1234 2',
        ]);

        $response->assertStatus(422);
    }

    /* get user/users */

    public function testUsersShouldBeRetrieved(): void
    {
        // act/arrange
        $response = $this->get("/api/user");

        // assert
        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => [
                'id',
                'name',
                'age',
                'email',
                'phone'
            ]
        ]);
    }

    public function testUserShouldBeRetrieved(): void
    {
        // arrange
        $user = User::factory()->create();

        // act
        $response = $this->get("/api/user/$user->id");

        // assert
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'name',
            'age',
            'email',
            'phone'
        ]);
    }

    /* edit */

    public function testUserShouldBeEditted(): void
    {
        // arrange
        $user = User::factory()->create();
        
        // act
        $faker = \Faker\Factory::create('pt_BR');
        $response = $this->put("/api/user/$user->id", [
            'name' => $faker->name(),
            'email' => $faker->email(),
            'phone' => '(31) 91234-1234'
        ]);
        
        // assert
        $response->assertStatus(200)
        ->assertJson([
            'edited' => true,
        ]);
    }
    
    public function testEditUserShouldFailWhenUserIsNotFound(): void
    {
        // arrange
        $user = User::factory()->create();
        User::destroy($user->id);
        
        // act
        $faker = \Faker\Factory::create('pt_BR');
        $response = $this->put("/api/user/$user->id", [
            'name' => $faker->name(),
            'email' => $faker->email(),
            'phone' => '(31) 91234-1234'
        ]);
        
        // assert
        $response->assertStatus(404);
    }
    
    /* delete */
    
    public function testUserShouldBeDeleted(): void
    {
        // arrange
        $user = User::factory()->create();
        
        // act
        $response = $this->delete("/api/user/$user->id");
    
        // assert
        $response->assertStatus(200)
        ->assertJson([
            'deleted' => true
        ]);
        
    }

    // public function testDeleteUserShouldFailWhenUserIsNotFound(): void
    // {   
    //     // arrange
    //     $user = User::factory()->create();
    //     User::destroy($user->id);
    
    //     // act
    //     $response = $this->delete("/api/user/$user->id");
    
    //     // assert
    //     $response->assertStatus(404);
    // }
}
