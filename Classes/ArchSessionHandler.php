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

/**
 * Class ArchSessionHandler
 */
class ArchSessionHandler
{

  /**
   * Set a session variable - uses a pointer ($key) to search for the session variable
   *
   * @param string $key
   * @param array $messages
   * @return bool
   */
  public static function set($key = '', $messages)
  {
    $returnValue = false;
    if (
      strlen($key) > 0
      &&
      (
        (
          is_array($messages) && !empty($messages)
        )
        ||
        (
          is_string($messages) && strlen($messages) > 0
        )
      )
    )
    {
      $_SESSION[$key] = $messages;
      $returnValue = true;
    }

    // return bool indicating success or failure
    return $returnValue;
  }

  /**
   * Setup up method used to retrieve a session variable based on it's key.
   *
   * @param string $key
   * @param bool $unset
   * @return bool | mixed
   */
  public static function get($key = '', $unset = true)
  {
    $returnValue = false;
    if (strlen($key) > 0 && isset($_SESSION[$key]))
    {
      $returnValue = $_SESSION[$key];

      if ($unset)
      {
        unset($_SESSION[$key]);
      }
    }
    return $returnValue;
  }

  /**
   * This function will remove the session variable by key and then unset it.
   * Failure to find the session by the provided key will return a boolean false
   *
   * @param string $key
   * @return  mixed
   */
  public static function remove($key = '')
  {
    $returnValue = false;
    if (strlen($key) > 0 && isset($_SESSION[$key]))
    {
      $returnValue = $_SESSION[$key];
      unset($_SESSION[$key]);
    }
    return $returnValue;
  }

  /**
   * creates a session if one has not been started already.
   * also there is a fallback check to be sure that any session created here is valid and active
   *
   * @return bool
   */
  public static function checkSession()
  {
    switch (session_status())
    {
      case PHP_SESSION_DISABLED:
        return false;
        break;
      case PHP_SESSION_NONE:
        session_start();
        if (session_status() === PHP_SESSION_ACTIVE)
        {
          return true;
        }
        return false;
        break;
      default:
        return true;
    }

  }
}