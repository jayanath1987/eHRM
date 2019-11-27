<?php
/*
 * This file is part of the dtXmlReporter package.
 * (c) 2009 Daniel Leech <dan@xmlreporter.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * dtXmlReporterFilterCheckbox
 *
 * Represents a checkbox-type filter
 * Options derived from the database
 *
 * @author Daniel Leech <www.dantleech.com>
 * @package dtXmlReporter
 */
class dtXmlReporterFilterCheckbox extends dtXmlReporterFilter
{
  protected $on_element = null;

  /**
   * Initialize this filter from its
   * corresponding XML definition
   * 
   * @param DOMNode $node
   */
  public function init()
  {
    $this -> on_element = $this -> widget_node -> getElementsByTagName('on') -> item(0);
    $this -> widget_value = 0;
  }

  /**
   * Render this filters widget in HTML
   *
   * @return string
   */
  public function render()
  {
    $checkbox_tag = sprintf('<input type="checkbox" name="%s" value="on" %s />', $this -> getWidgetFieldName(), $this -> widget_value ? 'CHECKED' : '');
    
    return $checkbox_tag;
  }
  
  public function applyToQueries(DOMElement $query)
  {
    parent::applyToQueries($query);

    if ($this -> widget_value)
    {
      if ($this -> on_element)
      {
        foreach ($this -> on_element -> getElementsByTagName('criteria') as $criteria)
        {
          self::addCriteriaToQueries($criteria, $query);
        }
      }
    }
  }
}
