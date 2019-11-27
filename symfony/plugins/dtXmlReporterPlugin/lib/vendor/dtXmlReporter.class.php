<?php
/*
 * This file is part of the dtXmlReporter package.
 * (c) 2009 Daniel Leech <dan@xmlreporter.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * dtXmlReporter
 * Interface class
 *
 * @package dtXmlReporter
 * @author Daniel Leech <xmlreporter@dantleech.com>
 */
class dtXmlReporter
{
  public static $default_project = 'default_project.xml';

  public static $resultset_logging_enabled = false;
  public static $report_logging_enabled = false;
  public static $query_logging_enabled = false;

  public static $enable_query_validation = true;
  public static $enable_definition_validation = true;
  public static $enable_filter_validation = true;

  public static $log_path = '';

  public static function log($filename, $data)
  {
    $log_file = self::$log_path.DIRECTORY_SEPARATOR.$filename;
    $handle = fopen($log_file, 'a');
    fwrite($handle, date('c')."\n".$data);
    fclose($handle);
  }

  public static function debugContext(DOMNode $context)
  {
    if ($context instanceOf DOMDocument)
    {
      return $context -> saveXML();
    }

    $dom = new DOMDocument;
    $dom -> formatOutput = true;
    $dom -> appendChild($dom -> importNode($context, true));
    return $dom -> saveXML();
  }

  public static function simpleXmlFromString($xml_string)
  {
    $dom = new DOMDocument;
    $dom -> loadXml($xml_string);
    $simple_xml = simplexml_import_dom($dom);
    
    return $simple_xml;
  }

  public static function hydrate($report_xml, $data_xml)
  {
    $hydrator = new dtXmlReporterReportHydrator;
    $hydrated_report = $hydrator -> hydrate($report_xml, $data_xml);

    return $hydrated_report;
  }

  /**
   * Return the given report from the project
   * If project is not specified the default project is assumed
   *
   * The project is specified by filename and is relative to
   * the projects base path
   * 
   * @param string $report_id - As specified in the report XML element
   * @param string $project - file name of project
   *
   * @return dtXmlReporterReport
   */
  public static function getReportById($report_id, $project = null)
  {
    $xpath = self::getProjectXPath($project, true);

    if (!$report = $xpath -> query(sprintf('//report[@id="%s"]', $report_id)) -> item(0))
    {
      throw new dtXmlReporterException('Cannot find report with ID '.$report_id);
    }

    $report = new dtXmlReporterReport($report);

    return $report;
  }

  /**
   * Get an XPath of the object
   * This can be used to traverse the project
   *
   * If xinclude is specified then we include the full project,
   * otherwise we just include the project file (e.g. when we just 
   * want to navigate the project)
   *
   * @param string $project - Relative path to project based on default path
   * @param boolean $xinclude - If we should xinclude
   */
  public static function getProjectXPath($project = null, $xinclude = false)
  {
    if (!$project)
    {
      $project = self::$default_project;
    }

    if (!file_exists($project))
      throw new dtXmlReporterException(sprintf('Cannot locate project "%s"', $project));

    $dom = new DOMDocument;
    $dom -> load($project);

    if ($xinclude)
    {
      $dom -> xinclude();
    }

    $xpath = new DOMXpath($dom);

    return $xpath;
  }
}
