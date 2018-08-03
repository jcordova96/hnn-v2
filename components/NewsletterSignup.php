<?php
/**
 * User: DatornData jb@datorndata.com
 * Date: 7/25/13
 * Time: 10:37 AM
 */

Yii::import('zii.widgets.CPortlet');

class NewsletterSignup extends CPortlet
{
    public $mode='default';

    protected function renderContent()
    {
        if($this->mode == 'inline')
        {
            $this->render('newsletter-inline');
        }
        else
        {
            $this->render('newsletter');
        }

    }
}
