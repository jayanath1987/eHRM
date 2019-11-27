<?php

class CommonhrmPager extends Doctrine_Pager_Layout
{
    public function display($options = array(), $return = false)
    {
        sfLoader::loadHelpers('I18N');
        
        $pager = $this->getPager();
        $str = '';

        // First page
        $this->addMaskReplacement('page', __(' First '), true);
        $options['page_number'] = $pager->getFirstPage();
        $str .= $this->processPage($options);

        // Previous page
        $this->addMaskReplacement('page', __(' Previous '), true);
        $options['page_number'] = $pager->getPreviousPage();
        $str .= $this->processPage($options);

        // Pages listing
        $this->removeMaskReplacement('page');
        $str .= parent::display($options, true);

        // Next page
        $this->addMaskReplacement('page', __(' Next '), true);
        $options['page_number'] = $pager->getNextPage();
        $str .= $this->processPage($options);

        // Last page
        $this->addMaskReplacement('page', __(' Last '), true);
        $options['page_number'] = $pager->getLastPage();
        $str .= $this->processPage($options);

        // Possible wish to return value instead of print it on screen
        if ($return) {
            return $str;
        }

        echo $str;
    }
}
?>
