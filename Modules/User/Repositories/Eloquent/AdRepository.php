<?php

namespace Modules\User\Repositories\Eloquent;

use Illuminate\Pipeline\Pipeline;
use Modules\User\Entities\Ad;
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

class AdRepository extends Repository implements AdRepositoryInterface
{

    public function __construct(Ad $adModel)
    {
        $this->model = $adModel;
    }

    public function find(int $id)
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

        $ad->title = $data['title'];
        $ad->description = $data['description'];
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
     * @param  int|\Modules\User\Entities\Ad $ad
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
     * @param  int|\Modules\User\Entities\Ad $ad
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
     * @param  int|\Modules\User\Entities\Ad $ad
     * @return mixed
     */
    public function archive($ad)
    {
        if (!is_object($ad)) {

            $ad = $this->find($ad);
        }

        return $ad->archive();
    }
}
