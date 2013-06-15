<?php namespace Pixeloution\Lararoute;

class Router extends \Illuminate\Routing\Router
{
   /**
    * modfied router for laravel. accepts an array for pattern, and allows variable
    * route segments to be defined as :segment rather then {segment}
    * 
    * @param  string $method  http method: put|post|get|delete|all
    * @param  string $pattern a route matching pattern
    * @param  mixed  $action  callback function or class/method
    * 
    * @return void
    */
   protected function createRoute($method, $pattern, $action)
   {
      if( is_array($pattern) ) 
      {
         $eachRoute = []; 

         foreach( $pattern as $single ) 
         {
            $eachRoute[] = $this->createRoute( $method, $single, $action );
         }
         return new RouteArray($eachRoute);
      }

      // support for :value style segements
      $segments = explode( '/', $pattern);
      foreach ( $segments as $index => $segment) 
      {
         if (preg_match('# \\: (\w+ \\??)  #x', $segment, $matches)) 
         {
            $segments[$index] = '{' . $matches[1] . '}';
         }
         $pattern = implode('/', $segments);
      } 

      return parent::createRoute( $method, $pattern, $action );
   }
}