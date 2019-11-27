<?php
/**
 * Hydrate a report meta-data template with the results of a query
 */
class dtXmlReporterInitProjectTask extends sfBaseTask
{
  public function configure()
  {
    $this -> namespace = 'xml-reporter';
    $this -> name = 'init-project';
    $this -> briefDescription = 'Initialize a sample project';

    $this -> addArgument('application', sfCommandArgument::REQUIRED, 'Application name');
  }

  public function execute($argument = array(), $options = array())
  {
    $config = ProjectConfiguration::getApplicationConfiguration($argument['application'], 'dev', true);

    $project_filename = 'example_project.xml';

    $this -> project_path = sfConfig::get('app_dt_xml_reporter_base_path');
    $this -> demo_path = sfConfig::get('sf_plugins_dir').'/dtXmlReporterPlugin/data/reports';

    if (file_exists($this -> project_path.DIRECTORY_SEPARATOR.$project_filename))
    {
      throw new Exception(sprintf('Project at "%s" already exists', $this -> project_path));
    }
    elseif(!file_exists($this -> project_path))
    {
      mkdir($this -> project_path);
    }

    $this -> doCopy('example_definition.xml', 'definitions');
    $this -> doCopy('example_query.xml', 'queries');
    $this -> doCopy('example_filters.xml', 'filters');
    $this -> doCopy('example_stylesheet.xsl', 'stylesheets');

    $common_xsl_path = $this -> project_path.DIRECTORY_SEPARATOR.'stylesheets'.DIRECTORY_SEPARATOR.'common.xsl';

    if (file_exists($common_xsl_path))
    {
      $this -> logSection('diag', 'common.xsl file already exists');
    }
    else
    {
      $this -> logSection('diag', 'Creating symlink to common.xsl');
      symlink($this -> demo_path.DIRECTORY_SEPARATOR.'stylesheets'.DIRECTORY_SEPARATOR.'common.xsl',$common_xsl_path);
    }


    $this -> logSection('diag', 'Copying example project');
    copy($this -> demo_path.DIRECTORY_SEPARATOR.$project_filename, $this -> project_path.DIRECTORY_SEPARATOR.'example_project.xml');

    $this -> log("
Add these lines to your app.yml file, specifying a valid connection to use and specifying propel12, propel13 accordingly\n
  dt_xml_reporter:
    default_project:      example_project.xml
    default_connection:   a_valid_connection_name
    connection_strategy:  propel12
    resultset_logging_enabled:   true
    report_logging_enabled:      true
    query_logging_enabled:       true

Now enable the dtXmlReporterReportView module in settings.yml:

  all:
    .settings:
      enabled_modules:        [dtXmlReporterReportView]

The report WILL NOT WORK, as it is not coupled to a real database but
you can now browse the report structure in :

  data/reports

A full reference can be found at http://www.xmlreporter.org/docs/html
    ");

  }

  public function doCopy($name, $directory)
  {
    $this -> logSection('diag', 'Copying example '.$name);
    $path = $this -> project_path.DIRECTORY_SEPARATOR.$directory;

    if (!file_exists($path))
    {
      mkdir($path);
    }

    copy($this -> demo_path.DIRECTORY_SEPARATOR.$directory.DIRECTORY_SEPARATOR.$name, $path.DIRECTORY_SEPARATOR.$name);
  }
}
