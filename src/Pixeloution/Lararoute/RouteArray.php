<?php namespace Pixeloution\Lararoute;

class RouteArray
{
   public function __construct($routes)
   {
      $this->routes = $routes;
   }

   public function where( $key, $pattern )
   {
      foreach( $this->routes as $route )
      {
         $route->where( $key, $pattern );
      }
   }
}