<?php
require_once '../Classes/ArchSessionHandler.php';

class ArchFlashMessageTest extends PHPUnit_Framework_TestCase
{
  protected $validSession = false;

  public function testSetAndGetArray()
  {
    $sessionKey           = 'Arch.Session.Array';
    $messages             = array('Test stored message', 'Test second stored message');

    // firstly test that the set works and that the session variable can be
    // accessed directly using the $_SESSION superglobal
    $returnTest           = ArchSessionHandler::set($sessionKey, $messages);
    $this->assertTrue($returnTest);
    $this->assertEquals($messages, $_SESSION[$sessionKey]);

    // Then test that the get returns the same value - firstly without unsetting the session variable
    $unsetSessionVariable = false;
    $returnTest           = ArchSessionHandler::get($sessionKey, $unsetSessionVariable);
    $this->assertEquals($messages, $returnTest);

    // And another test - this one needs to unset the session variable while getting it
    $unsetSessionVariable = true;
    $returnTest           = ArchSessionHandler::get($sessionKey, $unsetSessionVariable);
    $this->assertEquals($messages, $returnTest);

    // Finally - to check the session variable has indeed been removed - try to get it
    // Should return false
    $returnTest           = ArchSessionHandler::get($sessionKey);
    $this->assertFalse($returnTest);

  }

  public function testSetAndGetString()
  {
    $sessionKey           = 'Arch.Session.String';
    $message              = 'Test string message';

    // firstly test that the set works and that the session variable can be
    // accessed directly using the $_SESSION superglobal
    $returnTest           = ArchSessionHandler::set($sessionKey, $message);
    $this->assertTrue($returnTest);
    $this->assertEquals($message, $_SESSION['Arch.Session.String']);

    // Then test that the get returns the same value - firstly without unsetting the session variable
    $unsetSessionVariable = false;
    $returnTest           = ArchSessionHandler::get($sessionKey, $unsetSessionVariable);
    $this->assertEquals($message, $returnTest);

    // And another test which unsets the same sessions variable
    $returnTest           = ArchSessionHandler::get($sessionKey);
    $this->assertEquals($message, $returnTest);

    // Finally - to check the session variable has indeed been removed - try to get it
    // Should return false
    $returnTest           = ArchSessionHandler::get($sessionKey);
    $this->assertFalse($returnTest);
  }

  public function testRemove()
  {
    $sessionKey         = 'Arch.Session.Remove.Test';
    $message            = 'Test Removed String';

    // set the session variable and check success
    $returnTest         = ArchSessionHandler::set($sessionKey, $message);
    $this->assertTrue($returnTest);

    // remove the session variable and check the return value is the same as the original
    $returnTest         = ArchSessionHandler::remove($sessionKey);
    $this->assertEquals($message, $returnTest);

    // assert that the session variable no longer exists (should return false if not found)
    $returnTest         = ArchSessionHandler::get($sessionKey);
    $this->assertFalse($returnTest);
  }
}