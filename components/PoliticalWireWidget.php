<?php
/**
 * User: DatornData jb@datorndata.com
 * Date: 7/13/13
 * Time: 12:42 AM
 */

Yii::import('zii.widgets.CPortlet');

class PoliticalWireWidget extends CPortlet
{

    private $feedUrl = 'https://politicalwire.com/feed/';

    protected function renderContent()
    {
        $this->render('politicalWireWidget');
    }

    public function renderFeed()
    {
        $feedData = $this->getFeedData();
        $content = "<ul class='list-unstyled'>";
        foreach ($feedData as $item)
        {
            $content .= "<li><a href='" . $item['link'] . "' target='_blank'>" . $item['title'] . "</a>";
        }

        $content .= "</ul>";

        return $content;
    }

    /*
     * @var string $html ad html
     * @return string html
     * */
    private function getFeedData()
    {
        $feedData = [];

        $xml = file_get_contents(YiiBase::getPathOfAlias('webroot').'/political-wire.xml');
        $dom = new DOMDocument();
        $dom->loadXML($xml);

        $elements = $dom->getElementsByTagName('item');

        foreach ($elements as $element)
        {
            $feedDataItem = [];
            foreach ($element->childNodes as $childNode)
            {
                if($childNode->nodeName == 'title')
                {
                    $feedDataItem['title'] = $childNode->nodeValue;
                }

                if($childNode->nodeName == 'link')
                {
                    $feedDataItem['link'] = $childNode->nodeValue;
                }
            }

            $feedData[] = $feedDataItem;
        }


        return $feedData;
    }
}
