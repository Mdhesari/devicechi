<?php

namespace Modules\Admin\Space\ImageFilters;

use Exception;
use Image;
use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image as BaseImage;
use Laravel\Horizon\Exec;

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
     * font
     *
     * @var string
     */
    private $_fontPath;


    /**
     * __construct
     *
     * @param  mixed $image
     * @param  mixed $text
     * @return void
     */
    public function __construct($text, $template = null, $blur = 70, $fontPath = null)
    {
        $this->_text = $text;
        $this->_template = $template;
        $this->_blur = $blur;
        $this->_fontPath = $fontPath;
    }

    /**
     * getTemplate
     *
     * @return void
     */
    public function getTemplate()
    {
        return is_null($this->_template) ? public_path('images/templates/1080/devicechi-insta-cover-primary-1080.png') : public_path($this->_template);
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
        return $this->_fontPath;
    }

    /**
     * setFont
     *
     * @param  mixed $path
     * @return void
     */
    public function setFont($path)
    {
        $this->_fontPath = $path;

        return $this;
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

        $image = $this->fitImage($image);

        $font_family = $this->getFont();

        if (is_null($font_family)) {
            throw new Exception('Font is unavailable...');
        }

        $font_size = $this->getFontSize();

        $image
            ->insert($this->getTemplate());

        if ($this->getText())
            $image->text($this->getText(), 540, 540, function ($font) use ($font_family, $font_size) {
                $font->file($font_family);
                $font->size($font_size);
                $font->color('#f7f8f9');
                $font->align('center');
                $font->valign('center');
            });

        return $image;
    }

    /**
     * fitImage
     *
     * @var \Intervention\Image\Image $image
     * @return \Intervention\Image\Image
     */
    public function fitImage(\Intervention\Image\Image $image)
    {
        if (
            ($image->width() < 500 || $image->height() < 500) ||
            ($image->width() > $image->height()) ||
            ($image->height() - $image->width() > 400)
        ) {
            // Landscape
            $old_instance = Image::make($image->basePath());

            if ($image->width() > $image->height())
                $image->widen(1080);
            else
                $image->heighten(1080);

            $old_instance->fit(1080, 1080)->blur($this->_blur)->insert($image, 'center-center');

            return $old_instance;
        }

        return $image->fit(1080, 1080);
    }
}
