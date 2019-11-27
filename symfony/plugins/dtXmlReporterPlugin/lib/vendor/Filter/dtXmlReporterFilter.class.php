<?php
/*
 * This file is part of the dtXmlReporter package.
 * (c) 2009 Daniel Leech <dan@xmlreporter.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * dtXmlReporterFilter
 *
 * Parent class for filter objects
 *
 * Filters provide a user interface to append
 * clauses to a reports query. 
 *
 * @author Daniel Leech <www.dantleech.com>
 * @package dtXmlReporter
 */
abstract class dtXmlReporterFilter
{
  const WILDCARD_KEY = '__any__';

  protected $xpath = null;
  protected $node = null;
  protected $criteria_node = null;
  protected $widget_node = null;

  protected $label = '#no_label';

  protected $widget_value = null;
  protected $widget_name = null;

  protected $parameters = array();

  protected $add_wildcard = false;

  /**
   * Instantiate the filter, initialize from DOMElement
   *
   * @param DOMElement $node
   */
  public function __construct(DOMElement $node)
  {
    $this -> xpath = new DOMXpath($node -> ownerDocument);
    $this -> node = $node;


    if ($label = $this -> node -> getAttribute('label'))
    {
      $this -> label = $label;
    }

    if ($criteria_list = $this -> xpath -> query('./*/criteria', $this -> node))
    {
      $this -> criteria_list = $criteria_list;
    }
    
    if ($widget_list = $this -> xpath -> query('*', $node))
    {
      $this -> widget_node = $widget_list -> item(0);
      
      if (!$this -> widget_name = $this -> widget_node -> getAttribute('name'))
      {
        throw new dtXmlReporterFilterException(sprintf('Every widget must have a name attribute (%s hasn\'t got one)', $this -> widget_node -> nodeName));
      }
    }
    
    if ($this -> widget_node -> getAttribute('addWildcard'))
    {
      // tell sub classes to add a wildcard option
      $this -> add_wildcard = true;
    }
    
    $this -> init();
  }

  public function getWidgetName()
  {
    return $this -> widget_name;
  }

  /**
   * Returns the widget form name
   * for use in form tags (encapsulates all
   * filters in a PHP array)
   */
  public function getWidgetFieldName()
  {
    return sprintf('filter[%s]', $this -> getWidgetName());
  }

  /**
   * Get the filters UI label
   *
   * @return string
   */
  public function getLabel()
  {
    return $this -> label;
  }

  public function getWidgetValue()
  {
    return $this -> widget_value;
  }

  public function setWidgetValue($value)
  {
    $this -> widget_value = $value;
  }

  /**
   * Render this filters widget in HTML
   *
   * @return string
   */
  abstract public function render();
    
  public function applyToQueries(DOMElement $queries)
  {
    if ($this -> getWidgetValue() == self::WILDCARD_KEY) 
    {
      return;
    }
    
    foreach ($this -> criteria_list as $criteria)
    {
      self::addCriteriaToQueries($criteria, $queries, $this -> getWidgetValue());
    }
  }

  /**
   * Add a given criteria to a target query
   *
   * @param DOMNode $criteria
   * @param DOMNode $queries - Querys element
   * @param string $value - optional, value to give clauses
   */
  public static function addCriteriaToQueries($criteria, $queries, $value = null)
  {

    foreach ($criteria -> childNodes as $clause)
    {
      if ($clause instanceOf DOMElement)
      {
        // add value to clause from widget if specified
        if ($clause -> getAttribute('valueFromWidget') == 'true')
        {
          $clause -> nodeValue = $value;
        }

        $xpath = new DOMXPath($queries -> ownerDocument);

        // fixed bug here where clauses were being appended, but the query
        // transformer didnt aknowledge them, specifying self:: (.) before
        // the descendant:: axis (//) solved it.
        if ($query_target = $criteria -> getAttribute('toQuery'))
        {
          $criteria_queries = $xpath -> query(sprintf('.//query[@name="%s"]', $query_target), $queries);
        
          if (!$criteria_queries -> length)
          {
            throw new dtXmlReporterFilterException(sprintf('Criteria specified query "%s" but we cannot find it.', $query_target));
          }
        }
        elseif ($query_target = $criteria -> getAttribute('toGroup'))
        {
          $criteria_queries = $xpath -> query(sprintf('.//query[inGroup/@name="%s"]', $query_target));
          
          if (!$criteria_queries -> length)
          {
            throw new dtXmlReporterFilterException(sprintf('Could not find any queries in group "%s"', $query_target));
          }
        }
        else
        {
          throw new dtXmlReporterFilterException('No query target specified on criteria (should be [toQuery|toGroup]');
        }

        foreach ($criteria_queries as $criteria_query)
        {
          $criteria_query -> appendChild($clause -> cloneNode(true));
        }
      }
    }
  }
}
