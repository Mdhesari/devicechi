<?php

namespace Modules\User\Repositories\Eloquent;

use Illuminate\Pipeline\Pipeline;
use App\Models\Ad;
use Image;
use Modules\Admin\Space\ImageFilters\InstagramFilter;
use Modules\User\Repositories\Contracts\AdRepositoryInterface;
use Modules\User\Space\Pipelines\Ad\AccessoryPipeline;
use Modules\User\Space\Pipelines\Ad\AgePipeline;
use Modules\User\Space\Pipelines\Ad\ContactPipeline;
use Modules\User\Space\Pipelines\Ad\DemoPipeline;
use Modules\User\Space\Pipelines\Ad\FinalPipeline;
use Modules\User\Space\Pipelines\Ad\LocationPipeline;
use Modules\User\Space\Pipelines\Ad\ModelPipeline;
use Modules\User\Space\Pipelines\Ad\PicturesPipeline;
use Modules\User\Space\Pipelines\Ad\PricePipeline;
use Modules\User\Space\Pipelines\Ad\VariantPipeline;
use Storage;
use Str;

class AdRepository extends Repository implements
    AdRepositoryInterface
{

    protected $export_dir = null;

    public function __construct(Ad $adModel)
    {
        $this->model = $adModel;
    }

    public function setModel(Ad $adModel)
    {

        $this->model = $adModel;
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function get(array $data = [])
    {

        return $this->model->where($data)->get();
    }

    public function getUserAds(array $data = [])
    {

        $data = array_merge([
            'user_id' => auth()->id(),
        ], $data);

        return $this->model->with('pictures')->where($data)->get();
    }

    public function create($data)
    {

        $data = array_merge($data, ['slug' => uniqid()]);

        return $this->model->create($data);
    }

    public function checkPreviousSteps(int $step, $ad)
    {

        $pipelines = [
            ModelPipeline::class,
            VariantPipeline::class,
            AccessoryPipeline::class,
            AgePipeline::class,
            PricePipeline::class,
            PicturesPipeline::class,
            LocationPipeline::class,
            ContactPipeline::class,
            FinalPipeline::class,
            DemoPipeline::class,
        ];

        $data = [
            'step' => $step,
            'ad' => $ad,
        ];

        $result = app(Pipeline::class)
            ->send($data)
            ->through($pipelines)
            ->via('validate')
            ->then(function ($data) {

                return $data;
            });

        return $result;
    }

    public function getUserUncompletedAd()
    {

        return auth()->user()->ads()->uncompleted()->first();
    }

    public function getUserUncompletedAdWith(array $with)
    {

        return auth()->user()->ads()->with($with)->uncompleted()->first();
    }

    public function updateDetails(array $data, $ad)
    {

        $desc = $data['description'];

        $desc = preg_replace('/\\n/', '<br>', $desc);

        $ad->title = $data['title'];
        $ad->description = $desc;
        return $ad->save();
    }

    public function getAllStatus(): array
    {
        return [
            'available' => Ad::STATUS_AVAILABLE,
            'unavailable' => Ad::STATUS_UNAVAILABLE,
            'pending' => Ad::STATUS_PENDING,
            'uncompleted' => Ad::STATUS_UNCOMPLETED,
            'rejected' => Ad::STATUS_REJECTED,
            'archived' => Ad::STATUS_ARCHIVE,
        ];
    }

    /**
     * Set ad status as pending
     *
     * @param  int|\App\Models\Ad $ad
     * @return mixed
     */
    public function publish($ad)
    {

        if (!is_object($ad)) {

            $ad = $this->find($ad);
        }

        return $ad->publish();
    }

    /**
     * Set ad status as pending
     *
     * @param  int|\App\Models\Ad $ad
     * @return mixed
     */
    public function delete($ad)
    {
        if (!is_object($ad)) {

            $ad = $this->find($ad);
        }

        return $ad->delete();
    }

    /**
     * Set ad status as pending
     *
     * @param  int|\App\Models\Ad $ad
     * @return mixed
     */
    public function archive($ad)
    {
        if (!is_object($ad)) {

            $ad = $this->find($ad);
        }

        return $ad->archive();
    }

    public function createCaptionFile()
    {

        $ad = $this->model;

        $template = Str::of(config('admin.instagram.templates.post'));

        $text = $template->replace(':brand_model', $ad->phoneModel->brand->name . ', ' . $ad->phoneModel->name)
            ->replace(':multicard', $ad->is_multicard ? 'دو سیم کارته' : 'یک سیمکارت')
            ->replace(':variants', $ad->variant->storage . 'حافظه')
            ->replace(':city_state', $ad->state->city->name . ', ' . $ad->state->name)
            ->replace(':price', $ad->getFormattedPrice())
            ->replace(':contacts', join("\n", $ad->contacts->pluck('value')->toArray()))
            ->replace(':status', trans($ad->getStatus()))
            ->replace(':title', $ad->title)
            ->replace(':description', $ad->description)
            ->replace('<br>', "\n");

        $path = $this->getExportDirName($ad)
            ->append('/caption.txt');

        Storage::put($path, $text);

        return strval($path);
    }

    public function renderPicturesToExport($template = null, $quality = 100)
    {

        $pictures = $this->model->pictures()->latest()->get();

        $index = 0;

        foreach ($pictures as $picture) {

            $image = Storage::path($picture->getAttributes()['url']);

            $export_src = pathinfo($image);

            $dirname = $export_src['dirname'] . '/exports';

            $full_path = Str::of($dirname)
                ->append('/1080-1080-')
                ->append($export_src['basename']);

            // TODO make it optional to override existing watermarks
            // if (file_exists($full_path)) continue;

            $text = null;

            if ($index == 0)
                $text = Str::of(ucfirst($this->model->phoneModel->brand->name))
                    ->append("\n")
                    ->append(ucfirst($this->model->phoneModel->name));

            $image = Image::make($image)->filter(new InstagramFilter(
                $text,
                $template
            ));

            if (!is_dir($dirname)) {

                mkdir($dirname);
            }

            $image->save($full_path, $quality);

            $index++;
        }
    }

    public function getExportDirName()
    {
        if ($this->export_dir) return $this->export_dir;

        return $this->export_dir = Str::of(config('user_directories.ads.export'))
            ->replace(':user_id', $this->model->user->id)
            ->replace(':ad_id', $this->model->id);
    }
}
