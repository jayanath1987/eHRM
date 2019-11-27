<?php
/*
 * This file is part of the dtXmlReporter package.
 * (c) 2009 Daniel Leech <dan@xmlreporter.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * dtXmlReportViewer Report View module
 * @author Daniel Leech <daniel.leech@gradwell.net>
 * @package dtXmlReporter
 */
class dtXmlReporterReportViewActions extends sfActions
{
  public function executeIndex(sfRequest $request)
  {
    $this -> forward('dtXmlReporterReportView', 'browse');
  }

  public function executeBrowse(sfRequest $request)
  {
    $xpath = dtXmlReporter::getProjectXPath();
    $root = $xpath -> document -> getElementsByTagName('project') -> item(0);

    if (sfConfig::get('app_dt_xml_reporter_secure'))
    {
      sfXmlReporter::secureProject($xpath, $this -> getUser());
    }

    if ($category_id = $request -> getParameter('category_id'))
    {
      $query = sprintf('//category[@id="%s"]', $category_id);
      $context = $xpath -> query($query) -> item(0);
    }
    else
    {
      $context = $root;
    }

    $this -> categories = $xpath -> query('category', $context);
    $this -> reports = $xpath -> query('report', $context);

    if ($context -> parentNode -> nodeName == 'category' OR $context -> parentNode -> nodeName == 'project')
    {
      $this -> parent_category = $context -> parentNode;
    }
    else
    {
      $this -> parent_category = null;
    }
  }

  public function executeView(sfRequest $request)
  {
    $this -> forward404Unless($report_id = $request -> getParameter('report_id'), 'No report_id in request');
    
    libxml_use_internal_errors(true);

    try
    {
      $this -> report = dtXmlReporter::getReportById($report_id);

      
      if (sfConfig::get('app_dt_xml_reporter_secure'))
      {
        $this -> forward404Unless(in_array($this -> report -> getReportNode() -> getAttribute('credential'), $this -> getUser() -> listCredentials()));
      }

      if ($request -> hasParameter('filter'))
      {
        $this -> report -> setTokens($request -> getParameter('filter'));
      }

      $this -> report_html = $this -> report -> render();
    }
    catch (Exception $e)
    {
      $this -> error = sprintf('[%s] %s', get_class($e), $e -> getMessage());
    }

    $xml_errors = libxml_get_errors();
    libxml_use_internal_errors(false);
    $this -> xml_error_count = 0;
    foreach ($xml_errors as $xml_error)
    {
      if ($xml_error -> level == 3)
      {
        $this -> xml_error_count++;
        $prio = 'err';
      }
      elseif ($xml_error -> level == 2)
      {
        $prio = 'warning';
      }
      else
      {
        $prio = 'notice';
      }

      $this -> logMessage(sprintf('%s : [%s] - %s, line: %s', basename($xml_error -> file), $xml_error -> level, $xml_error -> message, $xml_error -> line), $prio);
    }
  }
}
