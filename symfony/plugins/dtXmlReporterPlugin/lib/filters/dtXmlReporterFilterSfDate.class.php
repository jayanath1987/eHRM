<?php

/*
 * This file is part of the dtXmlReporter package.
 * (c) 2009 Daniel Leech <dan@xmlreporter.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * dtXmlReporterFilterSfDate
 *
 * Date widget for dtXmlReporter that
 * utilizes the Symfony date widget
 */
class dtXmlReporterFilterSfDate extends dtXmlReporterFilter
{
  protected $sf_date_widget = null;
  public function init()
  {
    $this -> sf_date_widget = new sfWidgetFormDate;
    $this -> widget_value = array('year' => date('Y'), 'month' => date('n'), 'day' => date('j'));
  }

  public function render()
  {
    return $this -> sf_date_widget -> render($this -> getWidgetFieldName(), $this -> widget_value);
  }

  public function getWidgetValue()
  {
    $v = $this -> widget_value;
    
    if (!@$v['year'])
    {
      return self::WILDCARD_KEY;
    }

    $return = sprintf('%04s-%02s-%02s', $v['year'], $v['month'], $v['day']);

    return $return;
  }
}
