<?php

if (!sfConfig::get('app_dt_xml_reporter_base_path'))
{
  sfConfig::set('app_dt_xml_reporter_base_path', sfConfig::get('sf_data_dir').'/reports');
}

if ($strategy = sfConfig::get('app_dt_xml_reporter_connection_strategy'))
{
  dtXmlReporterDb::$connection_strategy = $strategy;
}

if ($default_project = sfConfig::get('app_dt_xml_reporter_default_project'))
{
  dtXmlReporter::$default_project = sfConfig::get('app_dt_xml_reporter_base_path').DIRECTORY_SEPARATOR.$default_project;
}
else
{
  sfConfig::set('app_dt_xml_reporter_default_project', sfConfig::get('app_dt_xml_reporter_base_path').'/default_project.xml');
}

if ($default_connection = sfConfig::get('app_dt_xml_reporter_default_connection'))
{
  dtXmlReporterDb::$default_connection = $default_connection;
}

if ($log_dir = sfConfig::get('dt_xml_reporter_log_dir'))
{
  dtXmlReporter::$log_path = $log_dir;
}
else
{
  dtXmlReporter::$log_path = sfConfig::get('sf_log_dir');
}

if (sfConfig::get('app_dt_xml_reporter_resultset_logging_enabled'))
{
  dtXmlReporter::$resultset_logging_enabled = true;
}

if (sfConfig::get('app_dt_xml_reporter_report_logging_enabled'))
{
  dtXmlReporter::$report_logging_enabled = true;
}

if (sfConfig::get('app_dt_xml_reporter_query_logging_enabled'))
{
  dtXmlReporter::$query_logging_enabled = true;
}
