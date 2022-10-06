<?php

namespace Tests\Feature;

use App\Models\Incident;
use App\Models\Incidentable;
use App\Models\Sample;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IncidentControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testShouldBeAccessTheIndexIncidentPage()
    {
        $response = $this->get(route('incident.index'));

        $response->assertViewIs('incident.index');
    }

    public function testShouldBeAccessTheCreateIncidentPage()
    {
        $response = $this->get(route('incident.create', ['sampleIds' => '1,2,3']));

        $response->assertViewIs('incident.form');
    }

    public function testShouldBeAbleToCreateAIncident()
    {
        Sample::factory()->forCustomer()->forCollectedBy()->forReceivedBy()->count(3)->create();
        Incident::factory()->create();
        Incidentable::factory(['incident_id' => 1, 'incidentable_id' => 1, 'incidentable_type' => 'Sample'])->create();

        $response = $this->post(route('incident.store', [
            'description' => 'description',
            'solution' => 'solution',
            'nc' => 1,
            'sampleIds' => '1,2,3'
        ]));

        $this->assertDatabaseHas('incidents', ['description' => 'description', 'solution' => 'solution', 'nc' => 0]);

        $this->assertDatabaseCount('incidents', 2);
        $this->assertDatabaseCount('incidentables', 4);

        $response->assertRedirect(route('incident.index'));
    }

    public function testShouldBeAccessTheEditIncidentPage()
    {
        $incident = Incident::factory()->create();

        $response = $this->get(route('incident.edit', $incident));

        $response->assertViewIs('incident.form');
    }

    public function testShouldBeAbleToUpdateAIncident()
    {
        $incident = Incident::factory()->create();

        $incidentUpdate = Incident::factory(['solution' => 'Solution', 'conclusion' => 'Conclusion', 'nc' => 1])->make();

        $response = $this->patch(route('incident.update', $incident), $incidentUpdate->toArray());

        $this->assertDatabaseHas('incidents', $incidentUpdate->toArray());

        $response->assertRedirect(route('incident.edit', $incident));
    }

    public function testShouldBeAbleToRestoreAIncidentDeleted()
    {
        $incident = Incident::factory(['deleted_at' => today()])->create();

        $response = $this->patch(route('incident.update', $incident->id), ['restore' => true]);

        $this->assertNotSoftDeleted($incident);

        $response->assertRedirect(route('incident.edit', $incident));
    }
}
