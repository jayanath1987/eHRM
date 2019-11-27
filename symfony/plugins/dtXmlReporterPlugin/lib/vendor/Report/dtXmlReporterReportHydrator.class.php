<?php
/*
 * This file is part of the dtXmlReporter package.
 * (c) 2009 Daniel Leech <dan@xmlreporter.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * dtXmlReporterReportHydrator
 *
 * Compiles a logical report from a template
 *
 * firstPass   - Hydrates the report from the data set
 * secondPass  - Evaluates XPath expression in the report
 *
 * @author Daniel Leech <xmlreporter@dantleech.com>
 * @package dtXmlReporter
 */
class dtXmlReporterReportHydrator
{
  protected $data_dom = null;

  protected $data_path = null;

  protected $report_dom = null;

  protected $report_path = null;

  const ITERATION_SELECTOR = '*[local-name() = "with" or local-name() = "iterate"]';

  /**
   * Generates a report file from given meta-data and given resultset
   *
   * @param string $meta_data     - Report meta-data XML string
   * @param string $data          - Resultset XML string
   *
   * @return string - hydrated report
   */
  public function hydrate($template_xml, $data_xml)
  {
    $this -> report_dom = new DOMDocument;
    $this -> report_dom -> preserveWhiteSpace = false;
    $this -> report_dom -> formatOutput = true;
    $this -> report_dom -> loadXml($template_xml);
    $this -> report_path = new DOMXpath($this -> report_dom);

    $this -> data_dom = new DOMDocument;
    $this -> data_dom -> loadXml($data_xml);
    $this -> data_path = new DOMXpath($this -> data_dom);

    // assign unique references to with|iterate blocks
    $this -> assignIterateReferences();  
    
    // Evaluate global resultset references
    $this -> evaluateGlobalValueFromResultsets();
    
    // Hydate report with data
    $this -> doHydrate($this -> report_dom -> childNodes -> item(0), $this -> data_dom-> childNodes -> item(0));

    // Evaludate additional "valueFromHere" expressions
    $this -> evaluateFromHere();

    $output = $this -> report_dom -> saveXml();

    if (dtXmlReporter::$report_logging_enabled)
    {
      dtXmlReporter::log('dt_xml_reporter_report.log', $output);
    }

    return $output;
  }

  /**
   * Assign an index to each iterateable element
   * This enables us to distinguish one context from another
   * when evaluating fromResultset
   *
   */
  public function assignIterateReferences()
  {
    $iterators = $this -> report_path -> query(sprintf('//%s', self::ITERATION_SELECTOR));
    
    if ($iterators)
    {
      foreach ($iterators as $index => $iterator)
      {
        $iterator -> setAttribute('_ref', $index);
      }
    }
  }

  /**
   * Set a value nodes value, taking into account any special attributes
   */
  public function setValueNodeValue($value_node, $value)
  {
    if ($value_node -> getAttribute('falseAsZero') == 'true')
    {
      if (!$value OR is_nan($value))
      {
        $value = 0;
      }
    }

    $value_node -> appendChild($value_node -> ownerDocument -> createElement('value', $value));
  }

  /**
   * Process any 'global' valueFromResultset's
   * (i.e. those outside of 'with' blocks)
   */
  public function evaluateGlobalValueFromResultsets()
  {
    $query = sprintf('descendant::*[@valueFromResultset][not(ancestor::%s)]', self::ITERATION_SELECTOR);
    $eval_from_resultsets = $this -> report_path -> query($query);

    if ($eval_from_resultsets)
    {
      foreach($eval_from_resultsets as $eval_from_resultset)
      {
        $query = $eval_from_resultset -> getAttribute('valueFromResultset');
        $eval_value = $this -> evaluateXPath($this -> data_path, $query, $this -> data_dom);
        $this -> setValueNodeValue($eval_from_resultset, $eval_value);
      }
      // cleanup
      foreach ($eval_from_resultsets as $eval_from_resultset)
      {
        $eval_from_resultset -> removeAttribute('valueFromResultset');
      }
    }
  }

  /**
   * Process all the valueFromHere attributes
   * Allows multiple passes
   *
   * valueFromHere's evaluate the report in the context
   * of itself
   */
  public function evaluateFromHere()
  {
    $eval_from_heres = $this -> report_path -> query('//*[@valueFromHere][not(@pass) or @pass="1"]');

    $this -> doEvaluateFromHere($eval_from_heres);

    $pass = 2;

    while($eval_from_heres = $this -> report_path -> query('//*[@valueFromHere][@pass="'.$pass.'"]') AND $eval_from_heres -> length)
    {
      $this -> doEvaluateFromHere($eval_from_heres);
      $pass++;
    }

    // cleanup
    foreach ($eval_from_heres as $eval_from_here)
    {
      $eval_from_here -> removeAttribute('valueFromHere');
    }
  }

  public function doEvaluateFromHere($node_list)
  {
    foreach($node_list as $eval_from_here)
    {
      $query = $eval_from_here -> getAttribute('valueFromHere');
      $eval_value = $this -> evaluateXPath($this -> report_path, $query, $eval_from_here);
      $this -> setValueNodeValue($eval_from_here, $eval_value);
    }
  }

  protected function evaluateXPath($path, $query, $context)
  {
    $eval_value = $path -> evaluate($query, $context);

    if (is_null($eval_value))
    {
      throw new dtXmlReporterReportHydratorException('Cannot evaluate user query "'.$query.'"');
    }
    elseif ($eval_value instanceOf DOMNodeList)
    {
      if ($eval_value -> length == 0)
      {
        $eval_value = null;
        //throw new dtXmlReporterReportHydratorException('No matching nodes for user query "'.$query.'" near : '.dtXmlReporter::debugContext($context));
      }
      else
      {
        $eval_value = $eval_value -> item(0) -> nodeValue;
      }
    }

    return $eval_value;
  }

  /**
   * firstPass
   * Hydarates the report from the data set
     */
    public function doHydrate($report_context, $data_context)
    {
      $query = sprintf('//%s[not(ancestor::%s)]', self::ITERATION_SELECTOR, self::ITERATION_SELECTOR);
      
      // select all "first tier" with blocks
      $base_with_list = $this -> report_path -> query($query, $report_context);
      
      if ($base_with_list)
      {
        if ($base_with_list -> length == 0)
        {
          return; // nothing to iterate over
        }

        foreach ($base_with_list as $with_context)
        {
          // start recuersively iterating over the with blocks
          $this -> iterateWith($with_context, $data_context);
        }

        // clean up, remove the now redundant "with" blocks
        $with_blocks = $this -> report_path -> query('//'.self::ITERATION_SELECTOR);
        foreach ($with_blocks as $with_block)
        {
          $with_block -> parentNode -> removeChild($with_block);
        }
      }
    }

    public function iterateWith($with_context, $data_context)
    {
      // get data path
      if ($resultset_name = $with_context -> getAttribute('resultset'))
      {
      $query = sprintf('resultset[@name="%s"]', $resultset_name);
      $data_context_list = $this -> data_path -> query($query, $data_context);

      if ($data_context_list -> length == 0)
      {
        throw new dtXmlReporterQueryException(sprintf('Cannot find result set with name "%s" in data set. From "%s"', $resultset_name, dtXmlReporter::debugContext($data_context)));
      }

      if ($data_context_list -> length > 1)
      {
        throw new dtXmlReporterQueryException(sprintf('More than one result set with name "%s" in data set on the same level', $resultset_name));
      }

      $data_context = $data_context_list -> item(0);
      $row_contexts = $this -> data_path -> query('row', $data_context);
      }
      elseif ($xpath = $with_context -> getAttribute('fromResultset'))
      {
        $row_contexts = $this -> data_path -> query($xpath, $data_context);
      }

      foreach ($row_contexts as $row_context)
      {
        $this -> buildRecord($with_context, $row_context);
      }
    }

    public function buildRecord($with_context, $row_context)
    {
      // create new record
      $with_copy = $with_context -> cloneNode(true);

      $ref = $with_context -> getAttribute('_ref');

      // get all fields within the current WITH scope
      $query = sprintf('descendant::*[@valueFromResultset][ancestor::%s[1][@_ref="%s"]]', self::ITERATION_SELECTOR, $ref);
      $value_from_resultsets = $this -> report_path -> query($query, $with_copy);

      foreach ($value_from_resultsets as $value_from_resultset)
      {
        $query = $value_from_resultset -> getAttribute('valueFromResultset');
        $value = $this -> evaluateXPath($this -> data_path, $query, $row_context);
        $this -> setValueNodeValue($value_from_resultset, $value);
        $value_from_resultset -> removeAttribute('valueFromResultset');
      }

      // get all "withs" on the next step from this one
      $query = sprintf(sprintf('descendant::%s[ancestor::%s[1][@_ref="%s"]]', self::ITERATION_SELECTOR, self::ITERATION_SELECTOR, $ref));
      $nested_withs = $this -> report_path -> query($query, $with_copy);

      foreach ($nested_withs as $nested_with)
      {
        $this -> iterateWith($nested_with, $row_context);
      }

      $parent = $this -> report_path -> query('..', $with_context);
      $parent = $parent -> item(0);

      // copy WITH elements into RECORD element
      foreach ($with_copy -> childNodes as $with_copy_node)
      {
        $parent -> appendChild($with_copy_node -> cloneNode(true));
      }
    }
}
