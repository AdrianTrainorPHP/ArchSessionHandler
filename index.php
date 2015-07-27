<?php
require_once 'Classes/ArchSessionHandler.php';
// Basic example of class usage

// checks if a session exists - sets one if it doesn't
ArchSessionHandler::checkSession();

$sessionArrayKey = 'Arch.Session.Handler.Array';
$sessionArrayMessage = array(
  'Arch Session Variable One',
  'Arch Session Variable Two'
);

$sessionStringKey = 'Arch.Session.Handler.String';
$sessionStringMessage = 'Arch Session Handler String Message';

// set the session array variable
ArchSessionHandler::set($sessionArrayKey, $sessionArrayMessage);

//set the session string variable
ArchSessionHandler::set($sessionStringKey, $sessionStringMessage);
?>
<!DOCTYPE html>
<html>
<head>
  <title>ArchSessionArrayClass</title>
  <style>
    pre { background-color: lightgray; }
    .comment { color: gray; }
    .string { color: darkgreen; }
    .array, .bool { color: darkblue; }
  </style>
</head>
<body>
  <h1>ArchSessionHandler class - Basic example</h1>
  <hr />
  <h2>Array Example</h2>
  <p class="comment">// assigns an array to the session variable by the key name</p>
  <p>ArchSessionHandler::set( <span class="string">'Arch.Session.Handler.Array'</span>, <span class="array">array</span> ( <span class="string">'Arch Session Variable One'</span>, <span class="string">'Arch Session Variable Two'</span> ) );</p>
  <p class="comment">// gets the session variable - by default the class will unset this session variable</p>
  <p>ArchSessionHandler::get( <span class="string">'Arch.Session.Handler.Array'</span> );</p>
  <p>Output:</p>
  <pre>
    <?php print_r(ArchSessionHandler::get($sessionArrayKey)); ?>
  </pre>

  <hr />
  <h2>String Example</h2>
  <p class="comment">// sets the session variable and assigns a string value to it</p>
  <p>ArchSessionHandler::set( <span class="string">'Arch.Session.Handler.String'</span>, <span class="string">'Arch Session Handler String Message'</span> );</p>
  <p class="comment">// gets the session variable - the second parameter tells the class to keep the session variable in place</p>
  <p>ArchSessionHandler::get( <span class="string">'Arch.Session.Handler.String'</span>, <span class="bool">false</span>); </p>
  <p>Output:</p>
  <pre>
    <?php echo ArchSessionHandler::get($sessionStringKey, false); ?>
  </pre>

</body>
</html>