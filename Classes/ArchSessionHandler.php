<?php

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