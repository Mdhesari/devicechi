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
     * __construct
     *
     * @param  mixed $image
     * @param  mixed $text
     * @return void
     */
    public function __construct($text, $template = null)
    {
        $this->_text = $text;
        $this->_template = $template;
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

        return public_path('fonts/Syncopate/Syncopate-Regular.ttf');
    }

    /**
     * getFont size
     *
     * @return void
     */
    public function getFontSize()
    {

        return 90;
    }

    /**
     * Applies filter to given image
     *
     * @param  \Intervention\Image\Image $image
     * @return \Intervention\Image\Image
     */
    public function applyFilter(BaseImage $original_image)
    {
        $image = Image::make(clone $original_image)->resize(1080, 1080);

        $font_family = $this->getFont();
        $font_size = $this->getFontSize();

        $image
            ->blur(95)
            ->insert($original_image, 'center-center')
            ->insert($this->getTemplate())
            ->text($this->getText(), 540, 540, function ($font) use ($font_family, $font_size) {
                $font->file($font_family);
                $font->size($font_size);
                $font->color('#f1f2f3');
                $font->align('center');
                $font->valign('center');
            });

        return $image;
    }
}
