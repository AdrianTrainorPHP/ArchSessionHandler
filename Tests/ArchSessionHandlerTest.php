<?php
/**
 * The MIT License (MIT)
 *
 * Copyright (c) [2015] [Adrian Trainor]
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */
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