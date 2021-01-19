<?php

namespace Modules\Admin\Space\ImageFilters;

use Image;
use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image as BaseImage;

class InstagramFilter implements FilterInterface
{

    /**
     * text
     *
     * @var mixed
     */
    private $_text;

    /**
     * watermark template
     *
     * @var mixed
     */
    private $_template = null;

    /**
     * blur
     *
     * @var bool
     */
    private $_blur = false;

    /**
     * __construct
     *
     * @param  mixed $image
     * @param  mixed $text
     * @return void
     */
    public function __construct($text, $blur = false, $template = null)
    {
        $this->_text = $text;
        $this->_template = $template;
        $this->_blur = $blur;
    }

    /**
     * getTemplate
     *
     * @return void
     */
    public function getTemplate()
    {

        return $this->_template ?: public_path('images/template-1.png');
    }

    /**
     * getText
     *
     * @return void
     */
    public function getText()
    {

        return $this->_text;
    }

    /**
     * getFont
     *
     * @return void
     */
    public function getFont()
    {

        return public_path('fonts/Open_Sans/OpenSans-Regular.ttf');
    }

    /**
     * getFont size
     *
     * @return void
     */
    public function getFontSize()
    {

        return 130;
    }

    /**
     * Applies filter to given image
     *
     * @param  \Intervention\Image\Image $image
     * @return \Intervention\Image\Image
     */
    public function applyFilter(BaseImage $original_image)
    {
        $image = Image::make($original_image->basePath())->fit(1080, 1080);

        $font_family = $this->getFont();
        $font_size = $this->getFontSize();

        if (is_numeric($this->_blur)) $image->blur($this->_blur);

        $image
            ->insert($this->getTemplate());

        if ($this->getText())
            $image->text($this->getText(), 540, 540, function ($font) use ($font_family, $font_size) {
                $font->file($font_family);
                $font->size($font_size);
                $font->color('#f1f2f3');
                $font->align('center');
                $font->valign('center');
            });

        return $image;
    }
}
