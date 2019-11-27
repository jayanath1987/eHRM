<?php
/*
 * This file is part of the dtXmlReporter package.
 * (c) 2009 Daniel Leech <dan@xmlreporter.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * dtXmlReporterReport
 * 
 * Represents a report
 *
 * @author Daniel Leech <dan@dantleech.com>
 * @package dtXmlReporter
 */
class dtXmlReporterReport
{
  protected $report_node = null;

  /**
   * @var dtXmlReporterTokenHolder
   */
  protected $token_holder = array();

  /**
   * @var dtXmlReporterFilter[]
   */
  protected $filters = array();

  /**
   * Instantiate the report from the report DOMNode
   *
   * @param DOMNode $report
   */
  final public function __construct(DOMNode $report)
  {
    $this -> report_node = $report;
    $this -> token_holder = new dtXmlReporterTokenHolder;
  }

  /**
   * Set the tokens to be used when rendering the report query
   * 
   * @param array
   */
  public function setTokens($tokens = array())
  {
    $this -> token_holder -> add($tokens);
  }

  /**
   * Returns the report DOMElement
   *
   * @return DOMElement
   */
  public function getReportNode()
  {
    return $this -> report_node;
  }

  /**
   * Set a specific token
   *
   * @param string $token
   * @param string $value
   */
  public function setToken($token, $value)
  {
    $this -> token_holder -> set($token, $value);
  }

  /**
   * Return all the tokens
   *
   * @return array
   */
  public function getTokens()
  {
    return $this -> token_holder -> getAll();
  }

  /**
   * Render the report
   *
   * @return string
   */
  public function render()
  {
    $timer = sfTimerManager::getTimer('reportRendering');
    $hydrated_definition = $this -> getHydratedDefinition();
    $final_report_string = $this -> getStylizedReport($hydrated_definition);
    $timer -> addTime();

    return $final_report_string;
  }

  public function getFilters()
  {
    $this -> initFilters();
    
    return $this -> filters;
  }

  /**
   * Initialize the filter objects, apply them to the reports query
   *
   * @param DOMElement $query
   */
  protected function initFilters()
  {
    if ($this -> filters) // only init once
    {
      return;
    }

    if (!$queries = $this -> report_node -> getElementsByTagName('queries'))
    {
      throw new dtXmlReporterReportException('Cannot find root queries element in query document');
    }

    if (!$queries -> length > 1)
    {
      throw new dtXmlReporterReportException('YOu can only have one "queries" element defined. You have "'.$queries -> length.'"');
    }

    $queries = $queries -> item(0);

    $xpath = new DOMXpath($this -> report_node -> ownerDocument);

    if (dtXmlReporter::$enable_filter_validation)
    {
      $filters = $xpath -> query('filters', $this -> report_node) -> item(0);
      $filter_dom = new DOMDocument;
      $filter_node = $filter_dom -> importNode($filters, true);
      $filter_dom -> appendChild($filter_node);
      $this -> validateDom($filter_dom, 'filter');
    }

    // apply individual filters
    $filters = $xpath -> query('filters/filter', $this ->report_node);
    $filter_objects = array();

    foreach ($filters as $filter)
    {
      $widget = $xpath -> query('*', $filter) -> item(0);
      $filter_class = 'dtXmlReporterFilter'.ucfirst($widget -> nodeName);

      if (!class_exists($filter_class))
      {
        throw new dtXmlReporterReportException('Cannot instantiate filter class "'.$filter_class.'", it doesnt exist');
      }

      $filter_object = new $filter_class($filter);

      if ($this -> token_holder -> has($filter_object -> getWidgetName()))
      {
        $filter_object -> setWidgetValue($this -> token_holder -> get($filter_object -> getWidgetName()));
      }

      $filter_object -> applyToQueries($queries);

      $filter_objects[] = $filter_object;
    }

    // apply and "global" filter criteria
    $criterias = $xpath -> query('filters/criteria', $this -> report_node);

    foreach ($criterias as $criteria)
    {
      dtXmlReporterFilter::addCriteriaToQueries($criteria, $queries);
    }

    $this -> filters = $filter_objects;
  }

  /**
   * Apply the reports stylesheet
   *
   * @param string $hydrated_definition
   *
   * return string - final report representation
   */
  protected function getStylizedReport($hydrated_definition)
  {
    // APPLY STYLESHEET
    if (!$stylesheet = $this -> report_node -> getElementsByTagName('stylesheet') -> item(0))
    {
      throw new dtXmlReporterException('Cannot find stylesheet for report');
    }

    $stylesheet_dom = new DOMDocument;
    $stylesheet_node = $stylesheet_dom -> importNode($stylesheet, true);
    $stylesheet_dom -> appendChild($stylesheet_node);

    // give this document an arbitary URI. This is required to allow xsl:includes to work as expected
    $stylesheet_dom -> documentURI = sfConfig::get('app_dt_xml_reporter_base_path').'/shouldnt_matter.xsl';

    $xsltproc = new XSLTProcessor;
    $xsltproc -> importStylesheet($stylesheet_dom);

    $final_report_dom = new DOMDocument;
    $final_report_dom -> loadXML($hydrated_definition);

    $report_transformed = $xsltproc -> transformToXML($final_report_dom);

    return $report_transformed;
  }

  /**
   * Hydarate the definition with the resultset
   * @return string - XML string
   */
  public function getHydratedDefinition()
  {
    // HYDRATE DEFINITION FROM RESULTSET
    if (!$definition = $this -> report_node -> getElementsByTagName('definition') -> item(0))
    {
      throw new dtXmlReporterReportException('Cannot find definition for report');
    }

    $definition_dom = new DOMDocument;
    $definition_node = $definition_dom -> importNode($definition, true);
    $definition_dom -> appendChild($definition_node);

    if (dtXmlReporter::$enable_definition_validation)
    {
      $this -> validateDom($definition_dom, 'definition');
    }


    $definition_xpath = new DOMXPath($definition_dom);

    // automatically set the title to the report name if it is missing
    if (!$definition_dom -> getElementsByTagName('title') -> item(0))
    {
      $definition_dom -> childNodes -> item(0) -> appendChild($definition_dom -> createElement('title', $this -> report_node -> getAttribute('name')));
    }

    $whitelist_domlist = $definition_xpath -> query('//with|use');
    $whitelist = array();

    foreach ($whitelist_domlist as $whitelist_element)
    {
      $whitelist[] = $whitelist_element -> getAttribute('resultset');
    }

    $resultset = $this -> getResultset($whitelist);
    $hydrated_definition = dtXmlReporter::hydrate($definition_dom -> saveXML(), $resultset -> asXML()); 

    return $hydrated_definition;
  }

  /**
   * Returns a resultset from the reports query
   * @return DOMNodeList
   */
  protected function getResultset($whitelist)
  {
    if (!$query = $this -> report_node -> getElementsByTagName('queries') -> item(0))
    {
      throw new dtXmlReporterReportException('Cannot find queries element in document');
    }

    $this -> initFilters($query);

    $transform = new dtXmlReporterQueryTransform;
    $transform -> setSubQueryWhitelist($whitelist);
    foreach ($this -> token_holder -> getAll() as $token => $value)
    {
      $transform -> setToken($token, $value);
    }

    $resultset = $transform -> fromDOMNode($query);
    return $resultset;
  }

  public function validateDom(DOMDocument $dom, $schema = null)
  {
    libxml_use_internal_errors(true);
    $dom -> schemaValidate(dirname(__FILE__).DIRECTORY_SEPARATOR.'../'.DIRECTORY_SEPARATOR.'schema'.DIRECTORY_SEPARATOR.$schema.'.xsd');
    $xml_errors = libxml_get_errors();
    libxml_use_internal_errors(false);
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
      throw new dtXmlReporterException(ucfirst($schema).' validation :'.implode('<br/>', $errors));
    } 
  }
}
