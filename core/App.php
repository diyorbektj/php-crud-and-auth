<?php

namespace Core;

class App {

    public function run()
    {
            $routes = new Router();

            dd($routes->allRoutes());
    }
}