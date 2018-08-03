<?php
/**
 * User: DatornData jb@datorndata.com
 * Date: 7/13/13
 * Time: 12:42 AM
 */

Yii::import('zii.widgets.CPortlet');

class AdServe extends CPortlet
{

    public $ad_slot;

    protected function renderContent()
    {
        $this->render($this->ad_slot);
    }

    public function getAds($slot)
    {
        $hnn_ad = new HnnAd();
        $ad = $hnn_ad->find('slot=:slot', array(':slot' => $slot));
        $adContent = ($ad->ad_code == null) ? "" : $this->AddBaseUrl($ad->ad_code);

        return $adContent;
    }

    /*
     * @var string $html ad html
     * @return string html
     * */
    private function AddBaseUrl($html)
    {
        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($html);

        $element_types = array('a', 'img', 'script');

        foreach ($element_types as $element_type)
        {
            $elements = $dom->getElementsByTagName($element_type);

            foreach ($elements as $element)
            {
                if ($element->hasAttributes())
                {
                    foreach ($element->attributes as $attr)
                    {
                        if ($attr->nodeName == 'src')
                        {
                            if (!(trim(strtolower(substr($attr->nodeValue, 0, 4))) == 'http')) //if it is a local request ..
                            {
                                //add base path to src attribute
                                $sBasePath = ($attr->nodeValue{0} !== '/') ? "/" . Yii::app()->request->baseUrl : Yii::app()->request->baseUrl;
                                $attr->nodeValue = $sBasePath . $attr->nodeValue;
                            }
                        }
                    }
                }
            }
        }

        return $dom->saveHTML();
    }
}
