<?php
// auto-generated by sfViewConfigHandler
// date: 2015/11/13 09:41:03
$response = $this->context->getResponse();


  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());



  if (!is_null($layout = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_layout')))
  {
    $this->setDecoratorTemplate(false === $layout ? false : $layout.$this->getExtension());
  }
  else if (is_null($this->getDecoratorTemplate()) && !$this->context->getRequest()->isXmlHttpRequest())
  {
    $this->setDecoratorTemplate('' == 'layout' ? false : 'layout'.$this->getExtension());
  }
  $response->addHttpMeta('content-type', 'text/html', false);

  $response->addStylesheet('main.css', '', array ());
  $response->addStylesheet('module.report.css', '', array ());
  $response->addJavascript('orangehrm.core.js', '', array ());
  $response->addJavascript('orangehrm.admin.js', '', array ());
  $response->addJavascript('orangehrm.pim.js', '', array ());
  $response->addJavascript('orangehrm.validate.js', '', array ());
  $response->addJavascript('orangehrm.report.js', '', array ());


