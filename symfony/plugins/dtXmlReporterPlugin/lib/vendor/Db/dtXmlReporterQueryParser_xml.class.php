<?php
/*
 * This file is part of the dtXmlReporter package.
 * (c) 2009 Daniel Leech <dan@xmlreporter.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * dtXmlReporterQueryParser_xml
 *
 * @package dtXmlReporter
 * @author Daniel Leech <xmlreporter@dantleech.com>
 */
class dtXmlReporterQueryParser_xml extends dtXmlReporterQueryParser
{
  public function parse()
  {
    if (!$this -> query -> select)
    {
      throw new dtXmlReporterQueryParserException('XML queries must have at least one "select" part');
    }

    $query = array();
    $query[] = $this -> processSelect($this -> query -> select);
    $query[] = $this -> processFrom($this -> query -> from);
    $query[] = $this -> processWhere($this -> query -> where);
    $query[] = $this -> processGroupBy($this -> query -> groupBy);
    $query[] = $this -> processOrderBy($this -> query -> orderBy);
    $query[] = $this -> processLimit($this -> query -> limit);

    $query_string = implode(' ', $query);

    $query_string = $this -> replaceTokens($query_string);

    return $query_string;
  }

  public function processSelect($selects)
  {
    $select_string = "SELECT ";
    
    $select_body = array();
    
    foreach ($selects as $select)
    {
      if (!$select['as'])
      {
        throw new dtXmlReporterQueryParserException('Select elements must contain an "as" sttribute (the field alias)');
      }

      $select_element = sprintf('%s AS `%s`', (string) $select, (string) $select['as']);
      $select_body[] = $select_element;
    }
    
    $select_string .= implode(',', $select_body);

    return $select_string;
  }

  public function processFrom($froms)
  {
    $from_body = array();
    $from_string = '';
    
    foreach ($froms as $from)
    {
      if (!$from['as'])
      {
        $from['as'] = (string) $from['table'];
      }

      $from_element = sprintf('`%s` AS `%s`', 
        (string) $from['table'], 
        (string) $from['as']);

      // leftJoins
      foreach ($from -> xpath('../leftJoin') as $left_join)
      {
        if (!$left_join['as']) // assume table name if no alias given
        {
          $left_join['as'] = (string) $left_join['table'];
        }

        if (!$left_join['toTable']) // default destination table to parent FROM table
        {
          $left_join['toTable'] = (string) $from['as'];
        }

        if (!$table_alias = (string) $left_join['as'])
        {
          $table_alias = (string) $left_join['table'];
        }

        $string = sprintf(' LEFT JOIN `%s` AS `%s` ON `%s`.`%s` = `%s`.`%s`', 
          (string) $left_join['table'], 
          $table_alias,
          $table_alias,
          (string) $left_join['from'], 
          (string) $left_join['toTable'], 
          (string) $left_join['to']); 

        $from_element .= $string;
      }

      $from_body[] = $from_element;
    }
    
    
    if ($from_body)
    {
      $from_string .= 'FROM '.implode(',', $from_body);
    }
  
    return $from_string;
  }

  public function processWhere($wheres)
  {
    $where_string = '';
    
    foreach($wheres as $where)
    {
      if (!$where['operator']) // default to equals
      {
        $where['operator'] = '=';
      }
      if ($where['valueAsSql'] == 'true')
      {
        $format = '%s %s %s';
      }
      else
      {
        $format = '%s %s "%s"';
      }

      $string = sprintf($format,
        (string) $where['field'],
        (string) $where['operator'],
        (string) $where);

      if ($where_string) // if this is the first clause, ommit the logical operator
      {
        if (!(string) $where['logic']) // default to AND
        {
          $logic = ' AND ';
        }
        else
        {
          $logic = strtoupper(" ".(string) $where['logic']." ");
        }

        $string = $logic.$string;
      }

      $where_string .= $string;
    }

    if ($where_string)
    {
      $where_string = 'WHERE '.$where_string;
    }

    return $where_string;
  }

  public function processGroupBy($group_bys)
  {
    $group_by_body = array();
    $group_by_string = '';

    foreach ($group_bys as $group_by)
    {
      $group_by_body[] = sprintf('%s', (string) $group_by['field']);
    }

    if ($group_by_body)
    {
      $group_by_string = 'GROUP BY '.implode(',', $group_by_body);
    }

    return $group_by_string;
  }

  public function processOrderBy($order_bys)
  {
    $order_by_body = array();
    $order_by_string = '';

    $orders = array('ascending' => 'ASC', 'descending' => 'DESC');

    foreach ($order_bys as $order_by)
    {
      if (!$order = strtolower((string) $order_by['order'])) // default to ASC
      {
        $order = 'ascending';
      }

      if (!array_key_exists($order, $orders))
      {
        throw new dtXmlReporterQueryParserException(sprintf('"%s" is not a valid order (must be ascending|descending)', $order));
      }

      $order_by_body[] = sprintf('%s %s', (string) $order_by['field'], $orders[$order]);
    }

    if ($order_by_body)
    {
      $order_by_string = 'ORDER BY '.implode(',', $order_by_body);
    }

    return $order_by_string;
  }

  public function processLimit($limits)
  {
    $limit_body = array();

    if (count($limits) == 0)
    {
      return '';
    }
    elseif (count($limits) > 1)
    {
      throw new dtXmlReporterQueryParserException('Only one limt clause permitted in query');
    }
    else
    {
      $limit = $limits[0];
      if ($from = (string) $limit['from'])
      {
        $limit_string = sprintf('LIMIT %s,%s', $from, (string) $limit['rows']);
      }
      else
      {
        $limit_string = sprintf('LIMIT %s', (string) $limit['rows']);
      }
    }

    return $limit_string;
  }
}
