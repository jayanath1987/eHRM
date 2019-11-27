<?php
/*
 * This file is part of the dtXmlReporter package.
 * (c) 2009 Daniel Leech <dan@xmlreporter.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * dtXmlReporterQuery
 *
 * @package dtXmlReporter
 * @author Daniel Leech <xmlreporter@dantleech.com>
 */
class dtXmlReporterQueryParser_raw extends dtXmlReporterQueryParser
{
  protected $blacklisted_words = array(
    'truncate',
    'update',
    'delete',
    'drop',
    'replace',
    'grant',
    'alter',
  );

  public function parse()
  {
    if (!$raw_sql = (string) $this -> query -> raw)
    {
      throw new dtXmlReporterQueryParserException('Query does not contain raw string');
    }

    // parse out destructive keywords, user should connect with a read-only connection, but they probably wont.
    $blacklist = implode('|', $this -> blacklisted_words);
    
    if (preg_match('&('.$blacklist.')&', strtolower($raw_sql), $matches))
      throw new dtXmlReporterQueryParserException('Query contains restricted word : '.$matches[1]);
    
    $raw_sql = $this -> replaceTokens($raw_sql);   

    return $raw_sql;
  }
}
