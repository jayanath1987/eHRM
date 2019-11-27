<?php

/*
 *  $Id: PhpLintTest.php 1022 2011-01-04 09:57:38Z mrook $
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the LGPL. For more information please see
 * <http://phing.info>.
 */
 
require_once 'phing/BuildFileTest.php';

/**
 * Regression test for ticket http://www.phing.info/trac/ticket/590
 * - PhpLintTask don't flag files that can't be parsed as bad files
 *
 * @package phing.regression
 */
class PhpLintFlagTest extends BuildFileTest { 
        
    public function setUp() { 
        $this->configureProject(PHING_TEST_BASE . "/etc/regression/590/build.xml");
    }

    public function testPhpLintTask () {
      $this->executeTarget("main");
      $this->assertInLogs("Parse error: syntax error, unexpected T_ENCAPSED_AND_WHITESPACE in ." . DIRECTORY_SEPARATOR . "my_file.php");
      $this->assertInLogs("." . DIRECTORY_SEPARATOR . "my_file_ok.php: No syntax errors detected");
      $this->assertInLogs("Deprecated: Assigning the return value of new by reference is deprecated in ." . DIRECTORY_SEPARATOR . "my_file_depr.php");
    }
}
