<?php
namespace App\Models;

use Spatie\MediaLibrary\Media as BaseMedia;

/**
 * @property mixed model
 */
class Media extends BaseMedia
{
    /**
     * Sets the main image for a model, and resets the others.
     *
     */
    public function setAsMainImage()
    {
        foreach ($this->model->getMedia() as $media) {
            $media->setCustomProperty('default', false);
            $media->save();
        }

        $this->setCustomProperty('default', true);
        $this->save();
    }

    /**
     * Relation to a product
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function model()
    {
        return $this->morphTo('model');
    }
}
