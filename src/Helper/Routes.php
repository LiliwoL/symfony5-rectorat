<?php

namespace App\Helper;

use Symfony\Component\Routing\RouterInterface;

/**
 * Cette class Routes sera utilisable directement au sein des TWIG
 * via la configuration dans config/package/twig.yaml
 * 
 * twig:
 *   globals:
 *       route_paths: '@App\Helper\Routes'
 * 
 * et dans les templates:
 * 
 * {# route_paths fait appel directement au Helper définit dans twig.yaml #}
 * {# on peut alors faire appel à ses méthodes qui commencent par get... comme getRoutes() en faisant route.paths.routes #}
 * 
 * {% for route_name, route_path in route_paths.routes %}
 *      {# {{ dump(route_name, route_path) }} #}
 *      <a href="{{route_path}}" alt="Route vers: {{route_name}}">{{route_name}}</a>
 * {% endfor %}
 */
class Routes
{
    private $routes = [];

    public function __construct(RouterInterface $router)
    {
        foreach ($router->getRouteCollection()->all() as $route_name => $route) {
            $this->routes[$route_name] = $route->getPath();
        }
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }
}