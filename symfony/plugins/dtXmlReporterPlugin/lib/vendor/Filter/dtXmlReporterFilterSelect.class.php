<?php
/*
 * This file is part of the dtXmlReporter package.
 * (c) 2009 Daniel Leech <dan@xmlreporter.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * dtXmlReporterFilterSelect
 *
 * Represents a select-type filter
 * Options derived from the database
 *
 * @author Daniel Leech <www.dantleech.com>
 * @package dtXmlReporter
 */
class dtXmlReporterFilterSelect extends dtXmlReporterFilter
{
  protected $options_for_select = array();

  /**
   * Initialize this filter from its
   * corresponding XML definition
   * 
   * @param DOMNode $node
   */
  public function init()
  {
    if ($this -> add_wildcard)
    {
      $this -> options_for_select[self::WILDCARD_KEY] = ' - ';
    }

    foreach ($this -> widget_node -> getElementsByTagName('option') as $option)
    {
      $this -> options_for_select[$option -> getAttribute('key')] = $option -> getAttribute('value');
    }

    $this -> widget_value = key($this -> options_for_select);
  }

  /**
   * Render this filters widget in HTML
   *
   * @return string
   */
  public function render()
  {
    $options = array();
    $options_for_select = $this -> options_for_select;

    foreach ($options_for_select as $key => $value)
    {
      $option = sprintf('<option value="%s" %s>%s</option>', 
        $key, 
        ((string) $this -> widget_value == (string) $key) ? 'SELECTED' : '',
        $value);


      $options[] = $option;
    }

    $option_html = implode("\n", $options);
    $select_tag = sprintf('<select name="%s">%s</select>', $this -> getWidgetFieldName(), $option_html);
    
    return $select_tag;
  }
  
  public function applyToQueries(DOMElement $query)
  {
    parent::applyToQueries($query);
    
    foreach ($this -> widget_node -> getElementsByTagName('option') as $option)
    {
      if ($option -> getAttribute('key') == $this -> widget_value)
      {
        foreach ($option -> getElementsByTagName('criteria') as $criteria)
        {
          self::addCriteriaToQueries($criteria, $query);
        }
      }
    }
  }
}
