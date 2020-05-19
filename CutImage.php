<?php

/**
 * Created by PhpStorm.
 * User: APG
 * Date: 19.05.2020
 * Time: 21:42
 */

/**
 * Class CutImage
 */
class CutImage
{
    /**
     * @var string - source file
     */
    private $file;
    /**
     * @var string file type
     */
    private $type;
    /**
     * @var -file resource
     */
    private $image;
    /**
     * @var array cutting template
     * [
     *     [
     *        x1, // x
     *        y1, // y
     *        w,  // width
     *        h,  // height
     *     ],
     *     [
     *        x2,
     *        y2,
     *        w,  // width
     *        h,  // height
     *     ],
     * ]
     */
    private $params = [];

    /**
     * @param string $filename
     * @param array $params
     */
    public function __construct(string $filename, array $params)
    {
        $this->file = $filename;
        $this->params = $params;
    }

    /**
     * @return bool
     */
    public function getMimeType()
    {
        switch(mime_content_type($this->file))
        {
            case 'image/jpeg':
                $this->type = "jpg";
                break;
            case 'image/png':
                $this->type = "png";
                break;
            case 'image/gif':
                $this->type = "gif";
                break;
            default:
                return false;
        }
    }

    /**
     *
     */
    public function getImageCreate()
    {
        switch($this->type) {
            case 'jpg':
                $this->image = @imagecreatefromjpeg($this->file);
                break;
            case 'png':
                $this->image = @imagecreatefrompng($this->file);
                break;
            case 'gif':
                $this->image = @imagecreatefromgif($this->file);
                break;
            default:
                exit('Unknown file type');
        }
    }

    public function save(string $name)
    {
        $arrSize = getimagesize($this->file);
        # new size
        $width = $arrSize[0] + 70;
        $height = $arrSize[1];
        $this->getMimeType();
        $this->getImageCreate();
        # new file resource
        $nfile = imagecreate($width, $height);
        # background
        imagecolorallocate($this->image, 255, 255, 255);
        # copy & resize
        foreach($this->params as $param) {
            imagecopyresampled($nfile, $this->image, $param[0], $param[1], $param[0]-10, $param[1], $param[2], $param[3], $param[2], $param[3]);
        }
        # save file
        $this->imageByType($nfile, $name . '.' . $this->type);

        return $name . '.' . $this->type;
    }

    public function imageByType($newFileResource, $fileName)
    {
        switch($this->type) {
            case 'jpg':
                imagejpeg($newFileResource, $fileName, 100);
                break;
            case 'png':
                imagepng($newFileResource, $fileName, 0);
                break;
            case 'gif':
                imagegif($newFileResource, $fileName);
                break;
            default:
                exit('Unknown file type');
        }
    }
}
