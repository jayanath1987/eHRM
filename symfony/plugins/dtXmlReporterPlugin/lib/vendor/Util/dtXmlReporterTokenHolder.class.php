<?php
/*
 * This file is part of the dtXmlReporter package.
 * (c) 2009 Daniel Leech <dan@xmlreporter.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * dtXmlReporterTokenHolder
 *
 * Encapsulates token storage and retrieval
 */
class dtXmlReporterTokenHolder
{
  protected $tokens = array();

  /**
   * Set the tokens to be used when rendering the report query
   * 
   * @param array
   */
  public function add($tokens = array())
  {
    $this -> tokens = $tokens;
  }

  public function has($token)
  {
    return array_key_exists($token, $this -> tokens);
  }

  /**
   * Set a specific token
   *
   * @param string $token
   * @param string $value
   */
  public function set($token, $value)
  {
    $this -> tokens[$token] = $value;
  }

  /**
   * Return all the tokens
   *
   * @return array
   */
  public function getAll()
  {
    return $this -> tokens;
  }

  public function get($key)
  { 
    return $this -> tokens[$key];
  }
}


