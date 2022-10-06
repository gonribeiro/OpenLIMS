<?php

namespace Tests\Feature\Api\V1;

use App\Models\Incident;
use App\Models\Incidentable;
use App\Models\Sample;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IncidentApiControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testShouldBeAbleToListAllIncidents()
    {
        Incident::factory()->count(10)->create();

        $response = $this->get(route('api.incident.index'));

        $response->assertStatus(200);
    }

    public function testShouldBeAbleToCreateAIncident()
    {
        Sample::factory()->forCustomer()->forCollectedBy()->forReceivedBy()->count(3)->create();
        Incident::factory()->create();
        Incidentable::factory(['incident_id' => 1, 'incidentable_id' => 1, 'incidentable_type' => 'Sample'])->create();

        $response = $this->post(route('api.incident.store', [
            'description' => 'description',
            'solution' => 'solution',
            'nc' => 1,
            'sampleIds' => '1,2,3'
        ]));

        $this->assertDatabaseHas('incidents', ['description' => 'description', 'solution' => 'solution', 'nc' => 0]);

        $this->assertDatabaseCount('incidents', 2);
        $this->assertDatabaseCount('incidentables', 4);

        $response->assertStatus(201);
    }

    public function testShouldBeAbleToShowAIncident()
    {
        $incident = Incident::factory()->create();

        $response = $this->get(route('api.incident.show', $incident));

        $response->assertJson($incident->toArray());

        $response->assertStatus(200);
    }

    public function testShouldBeAbleToUpdateAIncident()
    {
        $incident = Incident::factory()->create();

        $incidentUpdate = Incident::factory(['solution' => 'Solution', 'conclusion' => 'Conclusion', 'nc' => 1])->make();

        $response = $this->patch(route('api.incident.update', $incident), $incidentUpdate->toArray());

        $this->assertDatabaseHas('incidents', $incidentUpdate->toArray());

        $response->assertNoContent();
    }

    public function testShouldBeAbleToDestroyAIncident()
    {
        $incident = Incident::factory()->create();

        $response = $this->delete(route('api.incident.destroy', $incident));

        $this->assertSoftDeleted($incident);

        $response->assertNoContent();
    }

    public function testShouldBeAbleToRestoreAIncidentDeleted()
    {
        $incident = Incident::factory(['deleted_at' => today()])->create();

        $response = $this->patch(route('api.incident.update', $incident->id), ['restore' => true]);

        $this->assertNotSoftDeleted($incident);

        $response->assertNoContent();
    }
}
