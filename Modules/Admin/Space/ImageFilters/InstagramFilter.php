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
    private $_template;

    /**
     * blur
     *
     * @var bool
     */
    private $_blur;

    /**
     * __construct
     *
     * @param  mixed $image
     * @param  mixed $text
     * @return void
     */
    public function __construct($text,  $template = null, $blur = 70)
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
        return is_null($this->_template) ? public_path('images/template-1.png') : public_path($this->_template);
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
        $image = Image::make($original_image->basePath());

        if (
            ($image->width() < 500 || $image->height() < 500) ||
            ($image->width() > $image->height()) ||
            ($image->height() - $image->width() > 400)
        ) {
            // Landscape
            $old_instance = Image::make($original_image->basePath());

            if ($image->width() > $image->height())
                $image->widen(1080);
            else
                $image->heighten(1080);

            $old_instance->fit(1080, 1080)->blur($this->_blur)->insert($image, 'center-center');

            $image = $old_instance;
        } else {
            // Portrait
            $image->fit(1080, 1080);
        }

        $font_family = $this->getFont();
        $font_size = $this->getFontSize();

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
