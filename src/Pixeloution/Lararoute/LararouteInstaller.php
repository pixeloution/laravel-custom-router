<?php namespace Pixeloution\Lararoute;

class LararouteInstaller
{
   static public function postPackageInstall()
   {
      echo "Modifying app/config/app.php with ServiceProvider \n";
      
      $file   = file_get_contents('app/config/app.php');
      $pattern= '% Pixeloution\\Lararoute\\RoutingServiceProvider %sx'
      
      if( preg_match( $pattern, $file) )
      {
         echo "Routing Service Provider setting already set";
         return;
      }
      
      
      $tokens = token_get_all( $file );
      $output = [];

      foreach ($tokens as $token) 
      {
         if (is_string($token)) 
         {
            // simple 1-character token
            $output[] = $token;
         } 
         else 
         {
            // get the actual token 
            list($id, $text) = $token;

            // is it the typical first line of the list of service providers?
            if( $text === "'Illuminate\Foundation\Providers\ArtisanServiceProvider'" )
            {
               $output[] = "'Pixeloution\Lararoute\RoutingServiceProvider',\n\t\t";
               $output[] = $text;
            }
            else
            {
               $output[] = $text;
            }
         }
         file_put_contents('app/config/app.php', implode('', $output), LOCK_EX);
      }
   }
}
