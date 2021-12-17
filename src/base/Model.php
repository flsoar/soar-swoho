<?php
namespace Swoho\Base;

use Swoho\Common\Traits\OneKeyInstance;
use Illuminate\Database\Eloquent\Model as BaseModel;

abstract class Model extends BaseModel
{
    use OneKeyInstance;

    /**
     * @author flyman
     * @param \DateTimeInterface $date
     * @return string
     */
    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}