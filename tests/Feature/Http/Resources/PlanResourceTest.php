<?php

namespace Tests\Feature\Http\Resources;

use Tests\TestCase;
use App\Domain\Models\Plan;
use App\Http\Resources\PlanResource;

class PlanResourceTest extends TestCase
{
    /** @test */
    public function it_transforms_plan_correctly()
    {
        $plan = Plan::factory()->create();
        $resource = new PlanResource($plan);
        
        $this->assertEquals($plan->id, $resource['id']);
        $this->assertEquals($plan->name, $resource['name']);
    }
}