<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hnn_ad".
 *
 * @property int $id
 * @property string $slot
 * @property string $ad_code
 * @property string $modified
 */
class HnnAd extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hnn_ad';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ad_code'], 'string'],
            [['modified'], 'safe'],
            [['slot'], 'string', 'max' => 100],
        ];
    }

    public static function getAdsHtml($slot) {
        $html = HnnAd::findOne(['slot' => $slot])->ad_code;
        $adContent = ($html == null) ? "" : $html;//self::addBaseUrl($html);
        return $adContent;
    }

    private static function addBaseUrl($html)
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

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'slot' => 'Slot',
            'ad_code' => 'Ad Code',
            'modified' => 'Modified',
        ];
    }
}
