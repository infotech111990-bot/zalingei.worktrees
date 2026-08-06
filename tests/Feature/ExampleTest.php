<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testHomeRouteIsRegistered()
    {
        $route = Route::getRoutes()->match(Request::create('/', 'GET'));

        $this->assertSame('App\\Http\\Controllers\\HomeController@main', $route->getActionName());
    }
}
