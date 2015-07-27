# ArchSessionHandler
Simple PHP session handling interface
@author:  Adrian Trainor


Simple class usage:

require the class (or include/autoload)

require_once 'dir/to/classes/ArchSessionHandler.php';

Note: All available methods are static and should be called that way (as shown below)

Check to see that the session has been started
will automatically start the session if possible
returns false if sessions are disabled or cannot be started
 
(bool) $validSession = ArchSessionHandler::checkSession();

if ($validSession)
{

  Set the session variable
  
  (bool) $valid = ArchSessionHandler::set( (string) $sessionKey, (mixed) $value );

  Get the session variable
  $unsetSessionVariable default is true - change to false to preserve the session key value pair
  
  (mixed) $returnValue = ArchSessionHandler::get( (string) $key, (bool) $unsetSessionVariable = true);
  
  Unset the session variable and return its value
  
  (mixed) $returnValue = ArchSessionHandler::remove( (string) $key );

}
