<?php
/*
 * This file is part of the dtXmlReporter package.
 * (c) 2009 Daniel Leech <dan@xmlreporter.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfXmlReporter
 *
 * XML Reporter utility class for Symfony specific integration
 *
 * @author Daniel Leech <dan@xmlreporter.org>
 * @package dtXmlReporter
 */
class sfXmlReporter
{
  /**
   * Lock down a project based on sfGuard
   * credentials
   *
   * @param DOMElement
   */
  public function secureProject(DOMXpath $project_xpath, sfUser $user)
  {
    if (!method_exists($user, 'listCredentials'))
    {
      throw new sfXmlReporterException('User object does not have the "listCredentials" method, does it have the same interface as sfBasicSecurityUser?');
    }

    $credentials = array();
    foreach ($user -> listCredentials() as $credential)
    {
      $credentials[] = "@credential='".$credential."'";
    }
    $credentials = implode(' or ', $credentials);
    $query = '//report[not('.$credentials.')]';
    $locked_down_reports = $project_xpath -> query($query);
    
    foreach ($locked_down_reports as $locked_down_report)
    {
      $locked_down_report -> setAttribute('locked', true);
    }
  }
}
