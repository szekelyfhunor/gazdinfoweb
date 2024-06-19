<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApplicantsTest extends TestCase
{
    use RefreshDatabase;

    public function testStoreMethodWithValidData()
    {
        // Előkészítjük a szükséges adatokat
        $studentId = 1;
        $diplomaThesisId = 1;
        $notes = 'Teszt megjegyzés';

        // Hívjuk meg a store függvényt a megfelelő adatokkal
        $response = $this->post('/store', [
            'student_id' => $studentId,
            'diploma_thesis_id' => $diplomaThesisId,
            'notes' => $notes,
        ]);

        // Ellenőrizzük, hogy sikeres volt-e a redirect
        $response->assertRedirect(route('frontend.applicants.index'));

        // Ellenőrizzük, hogy az adatok megfelelően kerültek-e mentésre az adatbázisban
        $this->assertDatabaseHas('applicants', [
            'status' => 'Folyamatban',
            'notes' => $notes,
        ]);

        // Ellenőrizzük, hogy a kapcsolatok megfelelően lettek-e mentve az adatbázisban
        $this->assertDatabaseHas('applicant_student', [
            'applicant_id' => 1, // Az új jelentkezés azonosítója, amit a fenti kód során meg kell kaphatnunk
            'student_id' => $studentId,
        ]);

        $this->assertDatabaseHas('applicant_diploma_thesis', [
            'applicant_id' => 1, // Az új jelentkezés azonosítója, amit a fenti kód során meg kell kaphatnunk
            'diploma_thesis_id' => $diplomaThesisId,
        ]);
    }
}
