<?php
/*
 * This file is part of the dtXmlReporter package.
 * (c) 2009 Daniel Leech <dan@xmlreporter.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * dtXmlReporterQueryParser
 *
 * @package dtXmlReporter
 * @author Daniel Leech <xmlreporter@dantleech.com>
 */
abstract class dtXmlReporterQueryParser
{
  /**
   * Subject to parse
   * @var SimpleXMLElement
   */
  protected $query;

  /**
   * Tokens - substitute %tokens% within a query
   */ 
  protected $tokens = array();

  abstract public function parse();

  public function setQuery(SimpleXMLElement $query)
  {
    $this -> query = $query;
  }

  public function setTokens($tokens)
  {
    $this -> tokens = $tokens;
  }

  public function getTokens()
  {
    return $this -> tokens;
  }

  public function setToken($name, $value)
  {
    $this -> tokens[$name] = $value;
  }

  public function getToken($name)
  {
    return $this -> tokens[$name];
  }

  public function replaceTokens($sql_string)
  {
    foreach ($this -> tokens as $field => $value)
    {
      if (!preg_match('&%'.$field.'%&i', $sql_string))
      {
        throw new dtXmlReporterQueryParserException(sprintf('Token "%s" not found in "%s"', $field, $sql_string));
      }

      $sql_string = preg_replace('&%'.$field.'%&i', $value, $sql_string);
    }

    return $sql_string;
  }
}
