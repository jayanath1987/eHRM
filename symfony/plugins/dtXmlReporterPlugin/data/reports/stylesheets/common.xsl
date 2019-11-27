<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : budget_report_stylesheet.xsl
    Created on : 08 March 2009, 18:36
    Author     : daniel
    Description:
        Purpose of transformation follows.
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
  <xsl:output method="html"/>
  <xsl:template match="/definition">
    <style type="text/css">
        .report
        {
        }

        .section
        {
          border-style: none;
          border-width: 1px;
          margin: 0.25em;
          border-color: #aaaaaa;
        }

        .section h2
        {
          font-size: 1.2em;
          margin: 0.2em;
          padding: 0.2em;
        }

        .section .body
        {
        margin-left: 1em;
        }

        table
        {
        border-collapse: collapse;
        margin: 1em;
        }

        .field_set
        {
          margin: 1em;
        }

        .field_set th
        {
          text-align: right;
          padding-right: 1em;
          color: #444444;
          font-weight: normal;
        }

        .table td, .table th
        {
          border-style: solid;
          border-width: 1px;
          border-color: #aaaaaa;
          padding: 0.25em 1em 0.25em 1em;
        }

        .table .number
        {
          text-align: right;
        }

        .table .money
        {
          text-align: right;
        }

        .table th
        {
        background-color: #6C7E96;
        color: white;
        }

        .table tfoot
        {
          font-weight: bold;
        }

        td .percentage
        {
          text-align: right;
        }
        
        td .money, td .number, td .percentage
        {
          text-align: right;
        }

        .section0 h2
        {
        background-color: #C4DDD7;
        border-bottom-style: solid;
        font-size: 1.4em;
        }

        .section1 h2
        {
        background-color: #eeeeee;
        border-bottom-style: solid;
        border-bottom-color: #aaaaaa;
        }

        .section2 h2
        {
        font-style: italic;
        font-weight: normal;
        }
        
        .section3 h2
        {
        font-weight: bold;
        font-size: 1em;
        }

      </style>
      <div class="report">
        <h1><xsl:value-of select="title"/></h1>
        <hr/>
        <xsl:apply-templates select="section"/>
      </div>
  </xsl:template>

  <xsl:template match="section">
    <div class="section">
      <div>
        <xsl:attribute name="class">section<xsl:value-of select="count(ancestor::section)"/></xsl:attribute>
        <xsl:if test="title">
          <h2>
            <xsl:apply-templates select="title/*[1]"/>
          </h2>
        </xsl:if>
        <!-- Show all fields in section !-->
        <div class="body">
          <xsl:if test="field">
            <table class="field_set">
              <xsl:for-each select="field">
                <tr>
                  <th>
                    <xsl:value-of select="@label"/>
                  </th>
                  <td>
                    <xsl:attribute name="class"><xsl:value-of select="name(*[1])"/></xsl:attribute>
                    <xsl:apply-templates select="."/>
                  </td>
                </tr>
              </xsl:for-each>
            </table>
          </xsl:if>
          <xsl:for-each select="table">
            <xsl:apply-templates select="."/>
          </xsl:for-each>
        </div>
      </div>
      <xsl:apply-templates select="section"/>
    </div>
  </xsl:template>

  <xsl:template match="table">
    <table class="table">
      <xsl:if test="group">
        <xsl:for-each select="group">
          <colgroup>
            <xsl:if test="@span">
              <xsl:attribute name="span"><xsl:value-of select="@span"/></xsl:attribute>
            </xsl:if>
            <xsl:if test="@style">
              <xsl:attribute name="style"><xsl:value-of select="@style"/></xsl:attribute>
            </xsl:if>
          </colgroup>
        </xsl:for-each>
      </xsl:if>
      <xsl:if test="header">
        <thead>
          <xsl:for-each select="header/row">
            <tr>
              <xsl:for-each select="cell">
                <th>
                  <xsl:apply-templates select="."/>
                </th>
              </xsl:for-each>
            </tr>
          </xsl:for-each>
        </thead>
      </xsl:if>
      <xsl:if test="body">
        <tbody>
          <xsl:for-each select="body/row">
            <tr>
              <xsl:for-each select="cell">
                <td>
                  <xsl:attribute name="class"><xsl:value-of select="local-name(./*)"/></xsl:attribute>
                  <xsl:apply-templates select="."/>
                </td>
              </xsl:for-each>
            </tr>
          </xsl:for-each>
        </tbody>
      </xsl:if>
      <xsl:if test="footer">
        <tfooter>
          <xsl:for-each select="footer/row">
            <tr>
              <xsl:for-each select="cell">
                <td style='font-weight: bold'>
                  <xsl:attribute name="class"><xsl:value-of select="local-name(./*)"/></xsl:attribute>
                  <xsl:apply-templates select="."/>
                </td>
              </xsl:for-each>
            </tr>
          </xsl:for-each>
        </tfooter>
      </xsl:if>
    </table> 
  </xsl:template>

  <xsl:template match="cell">
    <xsl:if test="@rowspan">
      <xsl:attribute name="rowspan"><xsl:value-of select="@rowspan"/></xsl:attribute>
    </xsl:if>
    <xsl:if test="@colspan">
      <xsl:attribute name="colspan"><xsl:value-of select="@colspan"/></xsl:attribute>
    </xsl:if>
    <xsl:apply-templates match="./*"/>
  </xsl:template>

  <xsl:template match="number|money|percentage">
    <span>
      <xsl:for-each select="highlight[(.. &lt; @lessThan and .. &gt; @greaterThan)]">
        <xsl:attribute name="style">color: <xsl:value-of select="@color"/></xsl:attribute>
      </xsl:for-each>
      <xsl:for-each select="highlight[(.. &gt; @greaterThan and not(@lessThan))]">
        <xsl:attribute name="style">color: <xsl:value-of select="@color"/></xsl:attribute>
      </xsl:for-each>
      <xsl:for-each select="highlight[(.. &lt; @lessThan and not(@greaterThan))]">
        <xsl:attribute name="style">color: <xsl:value-of select="@color"/></xsl:attribute>
      </xsl:for-each>

      <xsl:if test="@format">
        <xsl:value-of select="format-number(.,@format)"/>
      </xsl:if>

      <xsl:if test="not(@format)">
        <xsl:value-of select="format-number(., '###,###,###')"/>
      </xsl:if>
    </span>
  </xsl:template>

  <xsl:template match="date">
    <xsl:value-of select="substring(./value,0,11)"/>
  </xsl:template>
  <xsl:template match="text">
    <xsl:value-of select="."/>
  </xsl:template>

</xsl:stylesheet>
