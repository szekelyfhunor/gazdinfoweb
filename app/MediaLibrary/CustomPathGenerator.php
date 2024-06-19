<?php

namespace App\MediaLibrary;

use App\Models\Classes;
use App\Models\Competition;
use App\Models\DiplomaThesis;
use App\Models\ItKlub;
use App\Models\News;
use App\Models\Partner;
use App\Models\Review;
use App\Models\Subject;
use App\Models\User;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

class CustomPathGenerator implements PathGenerator
{

    /**
     * @param Media $media
     * @return string
     */
    public function getPath(Media $media): string
    {
        switch ($media->model_type) {
            case User::class:
                return 'user'.'_'.$media->model_id.'/';
            case Classes::class:
                return 'class_'.$media->model_id.'/'.$media->collection_name.'/';
            case Competition::class:
                return 'competition_'.$media->model_id.'/'.$media->collection_name.'/';
            case DiplomaThesis::class:
                return 'diplomathese_'.$media->model_id.'/'.$media->collection_name.'/';
            case News::class:
                return 'new_'.$media->model_id.'/';
            case Review::class:
                return 'review_'.$media->model_id.'/';
            case ItKlub::class:
                return 'itklub_'.$media->model_id.'/';
            case Partner::class:
                return 'partner_'.$media->model_id.'/';
            case Subject::class:
                return 'subject_'.$media->model_id.'/';
            default:
                return $media->id.'/';
        }
    }

    /**
     * @param Media $media
     * @return string
     */
    public function getPathForConversions(Media $media): string
    {
        return $this->getPath($media);
    }

    /**
     * @param Media $media
     * @return string
     */
    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getPath($media);
    }


}
