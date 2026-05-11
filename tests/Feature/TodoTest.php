<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Tugas;

class TodoTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    public function test_user_melihat_tugas()
    {
        $daftarTugas = Tugas::factory(10)->create();

        $response = $this->get('/vee');

        $response->assertOk();
        $response->assertSeeText('ada 10 tugas');
        $response->assertSeeText($daftarTugas[0]->deskripsi);

    }
    
    public function test_user_membuat_tugas()
    {
        $response = $this->post('/vee');

        $response->assertRedirect('/vee');
        $this->assertDatabaseHas('/tugas', ['deskripsi' => 'belajar laravel']);
    }

    public function test_user_mengedit_tugas()
    {
        $tugas = Tugas::factory()->create(['deskripsi' => 'tugas lama']);
        $response = $this->put("/vee/{$tugas->id}", ['deskripsi' => 'tugas baru']);
        $response->assertRedirect('/vee');
        $this->assertDatabaseHas('/tugas', ['deskripsi' => 'tugas baru']);
    }

    public function test_user_menghapus_tugas()
    {
        $tugas = Tugas::factory()->create();
        $response = $this->delete("/vee/{$tugas->id}");
        $response->assertRedirect('/vee');
        $this->assertDatabaseMissing('/tugas', ['id' => $tugas->id]);
    }
}
