<?php
/*
 * This file is part of the dtXmlReporter package.
 * (c) 2009 Daniel Leech <dan@xmlreporter.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * dtXmlReporterQuery
 *
 * @package dtXmlReporter
 * @author Daniel Leech <xmlreporter@dantleech.com>
 */
class dtXmlReporterQueryTransform
{
  /**
   * Tokens submitted by user, global scope
   */
  protected $tokens = array();

  protected $sub_query_whitelist = array();

  /**
   * Sub-Queries to process (ignore all the rest)
   * Whitelisted sub-queries are determined from
   * the requirements of the report definition
   *
   * e.g. array('query_one', 'some_other_query')
   *
   * @param array $whitelist 
   */
  public function setSubQueryWhitelist($whitelist)
  {
    $this -> sub_query_whitelist = $whitelist;
  }

  /**
   * Set an array of tokens
   */
  public function setTokens($array)
  {
    $this -> tokens = $array;
  }

  public function setToken($token, $value)
  {
    $this -> tokens[$token] = $value;
  }

  public function hasToken($name)
  {
    return isset($this -> tokens[$name]);
  }

  public function getToken($name)
  {
    return $this -> tokens[$name];
  }

  public function fromSimpleXml(SimpleXMLElement $simple_xml)
  {
    if (!$simple_xml)
    {
      throw new dtXmlReporterQueryException('No SimpleXMLElement passed to fromSimpleXml');
    }

    $transformed = $this -> transformToResultset($simple_xml);
    
    return $transformed;
  }

  /**
   * Hack until I get round to porting this package to use DOMNode
   */
  public function fromDOMNode(DOMElement $dom_node)
  {
    if (!$dom_node)
    {
      throw new dtXmlReporterQueryException('No DOMNode passed to fromDOMNode');
    }
    
    $dom_export = new DOMDocument;
    $query_node = $dom_export -> importNode($dom_node, true);
    $dom_export -> appendChild($query_node);
    
    if (dtXmlReporter::$enable_query_validation)
    {
      libxml_use_internal_errors(true);
      $dom_export -> schemaValidate(dirname(__FILE__).DIRECTORY_SEPARATOR.'../'.DIRECTORY_SEPARATOR.'schema/query.xsd');
      $xml_errors = libxml_get_errors();
      $errors = array();
      foreach ($xml_errors as $xml_error)
      {
        if (!strstr($xml_error -> message, 'http://www.w3.org/2003/XInclude') AND !strstr($xml_error -> message, '{http://www.w3.org/XML/1998/namespace}base'))
        {
          $errors[] = sprintf("Line: %s - %s", $xml_error -> line, $xml_error -> message);
        }
      }

      if ($errors)
      {
        // if we have any /real/ errors. throw an exception
        throw new dtXmlReporterException('Query validation :'.implode('<br/>', $errors));
      } 
    }

    $simple_xml = simplexml_import_dom($dom_export);

    $transformed = $this -> transformToResultset($simple_xml);

    if (dtXmlReporter::$resultset_logging_enabled)
    {
      $dom = new DOMDocument;
      $dom -> formatOutput = true;
      $dom -> loadXML($transformed -> asXML());

      dtXmlReporter::log('dt_xml_reporter_resultset.log', $dom -> saveXML());
    }

    return $transformed;
  }

  /**
   * Transform a structured query to a structured resultset
   *
   * @param SimpleXMLElement $query
   *
   * @return SimpleXMLElement
   */
  public function transformToResultset(SimpleXMLElement $queries)
  {
    $resultset_container = new SimpleXMLElement('<resultsets/>');

    if ($queries -> getName() != 'queries')
    {
      throw new dtXmlReporterQueryException(sprintf('Query structures root element is not "queries" it is "%s"', $queries -> getName()));
    }

    foreach ($queries -> query as $query)
    {
      $resultset =  $resultset_container -> addChild('resultset');
      $resultset['name'] = (string) $query['name'];

      $this->processNode($query, $resultset);
    }

    return $resultset_container;
  }

  public function processNode(SimpleXMLElement $query, SimpleXMLElement $result_set)
  {
    if (!$query)
    {
      throw new dtXmlReporterQueryException(sprintf('No query passed to processNode'));
    }

    if (isset($query -> raw))
    {
      $parser = new dtXmlReporterQueryParser_raw;
    }
    elseif (isset($query -> select))
    {
      $parser = new dtXmlReporterQueryParser_xml;
    }
    else
    {
      throw new dtXmlReporterQueryException(sprintf('Cannot find anything to process in query "%s" ', $query -> asXML()));
    }

    // tokenize query
    // As of the introduction of filters, there should be 
    // little use for "tokens"
    foreach ($query -> token as $token)
    {
      $token_name = (string) $token['name'];

      if (isset($token['value']))
      {
        $parser -> setToken($token_name, (string) $token['value']);
      }
      elseif (isset($token['valueFromResultset']))
      {
        if (!$result_set)
          throw new dtXmlReporterQueryException('You cannot use valueFromHere on the current node. Position is relative to position of this result set. To access field value from previous query use "../field[@name=blah]"');

        if (!$eval = $result_set -> xpath($xpath = (string) $token['valueFromResultset']))
          throw new dtXmlReporterQueryException(sprintf('Could not resolve xpath "%s", in "%s"', $xpath, $result_set -> asXML()));

        $parser -> setToken($token_name, (string) $eval[0]);
      }
      elseif ($this -> hasToken($token_name))
      {
        $parser -> setToken($token_name, $this -> getToken($token_name));
      }
      else
      {
        throw new dtXmlReporterQueryException(sprintf('Cannot find value for token "%s", expected valueFromResultset, value or user token', $token_name));
      }
    }

    $parser -> setQuery($query);
    $query_string = $parser->parse();

    dtXmlReporterDb::resultSetFromQuery($query_string, (string) $query['connection'], $result_set);

    if ($result_set -> row)
    {
      foreach ($result_set -> row as $row)
      {
        foreach ($query->query as $sub_query)
        {
          // for some reason empty elements are iterated
          // with an earlier version of SimpleXML (i think)
          if (count((array) $sub_query))
          {
            $sub_query_id = (string) $sub_query['name'];

            if (!$this -> sub_query_whitelist OR in_array($sub_query_id, $this -> sub_query_whitelist))
            {
              $sub_result_set = $row -> addChild('resultset');
              $sub_result_set -> addAttribute('name', $sub_query_id);
              $this->processNode($sub_query, $sub_result_set);
            }
          }
        }
      }
    }

    return $result_set;
  }
}
