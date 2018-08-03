<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "file".
 *
 * @property int $id
 * @property int $nid
 * @property string $filename
 * @property string $filepath
 * @property string $filemime
 * @property int $filesize
 * @property string $type
 * @property int $timestamp
 */
class File extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'file';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nid', 'filesize', 'timestamp'], 'integer'],
            [['filename', 'filepath', 'filemime'], 'string', 'max' => 255],
            [['type'], 'string', 'max' => 32],
        ];
    }

    public static function saveUploadedImages($model)
    {
        $uploaded_files = CUploadedFile::getInstances($model, 'file');
//               echo "<pre>".print_r($uploaded_files, true)."</pre>";
        if(!empty($uploaded_files))
        {
            foreach($uploaded_files as $uploaded_file)
            {
                $uploaded_file_name = $uploaded_file->getName();

                if($uploaded_file_name == 'main.jpg' || $uploaded_file_name == 'maintest.jpg') // if main file just upload; overwrite existing
                {
                    $filename = $uploaded_file_name;
                    $filepath = 'sites' . DIRECTORY_SEPARATOR . 'default' . DIRECTORY_SEPARATOR .
                        'files' . DIRECTORY_SEPARATOR . $filename;
                    $uploaded_file->saveAs($filepath);
                }
                else
                {
                    $filename = $model->id . "-" . $uploaded_file_name;
                    $filepath = 'sites' . DIRECTORY_SEPARATOR . 'default' . DIRECTORY_SEPARATOR .
                        'files' . DIRECTORY_SEPARATOR . $filename;
                    $uploaded_file->saveAs($filepath);

                    $file = new File();
                    $file->setAttributes(
                        array(
                            'nid' => $model->id,
                            'filename' => $filename,
                            'filepath' => $filepath,
                            'filemime' => $uploaded_file->getType(),
                            'filesize' => $uploaded_file->getSize(),
                            'type' => get_class($model),
                            'timestamp' => strtotime('now'),
                        ));

                    $file->insert();
                    unset($file);
                }
            }
        }
    }

    public static function deleteFilesByPath($filepaths)
    {
        if(!empty($filepaths))
        {
            foreach($filepaths as $filepath)
            {
                unlink($filepath);

                $connection = Yii::app()->db;
                $sql = "delete from file where filepath = '{$filepath}'";
                $command = $connection->createCommand($sql);
                $command->execute();
            }
        }
    }

    public static function getImages($nid, $type)
    {
        $connection = Yii::app()->db;

        $data = array();

        $sql = " 
           select filepath 
           from file 
           where nid = {$nid} 
           and type = '{$type}' 
           ";

        $command = $connection->createCommand($sql);
        $result = $command->queryAll();
        $data = array();
        foreach($result as $row)
            $data[] = $row['filepath'];

        return $data;
    }

    public static function getTnImage($nid, $type)
    {
        $file = File::findOne([
            'nid' => $nid,
            'type' => $type,
        ]);

        return (!empty($file)) ? 'https://historynewsnetwork.org/'.$file->filepath : '';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nid' => 'Nid',
            'filename' => 'Filename',
            'filepath' => 'Filepath',
            'filemime' => 'Filemime',
            'filesize' => 'Filesize',
            'type' => 'Type',
            'timestamp' => 'Timestamp',
        ];
    }
}
