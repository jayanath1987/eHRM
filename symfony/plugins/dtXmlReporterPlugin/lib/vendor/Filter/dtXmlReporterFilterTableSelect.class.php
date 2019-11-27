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
class dtXmlReporterFilterTableSelect extends dtXmlReporterFilterSelect
{
  protected $table = null;
  protected $key_field = null;
  protected $value_field = null;

  /**
   * Initialize this filter from its
   * corresponding XML definition
   * 
   * @param DOMNode $node
   */
  public function init()
  {
    parent::init();
    
    if (!$this -> table = $this -> widget_node -> getAttribute('fromTable'))
    {
      throw new dtXmlReporterFilterException('Element "'.$this -> widget_node -> nodeName.'" does not have a keyField attribute');
    }
    
    if (!$this -> key_field = $this -> widget_node -> getAttribute('keyField'))
    {
      throw new dtXmlReporterFilterException('Element "'.$this -> widget_node -> nodeName.'" does not have a keyField attribute');
    }
    
    if (!$this -> value_field = $this -> widget_node -> getAttribute('valueField'))
    {
      throw new dtXmlReporterFilterException('Element "'.$this -> widget_node -> nodeName.'" does not have a keyField attribute');
    }

    $this -> initOptionsForSelect();
  }

  protected function getTableRows()
  {
    $query = sprintf('SELECT %s, %s FROM %s ORDER BY %s ASC', $this -> key_field, $this -> value_field, $this -> table, $this -> value_field);
    $result = dtXmlReporterDb::executeSql($query);
    $rows = $result -> fetchAll(PDO::FETCH_ASSOC);

    return $rows;
  }

  protected function initOptionsForSelect()
  {
    $rows = $this -> getTableRows();

    foreach ($rows as $row)
    {
      $this -> options_for_select[$row[$this -> key_field]] = $row[$this -> value_field];
    }
  }
}
