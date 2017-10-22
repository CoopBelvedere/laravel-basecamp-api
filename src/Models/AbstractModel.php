<?php

namespace Belvedere\Basecamp\Models;

abstract class AbstractModel
{
    /**
     * The model attributes.
     *
     * @var array
     */
    protected $attributes;

    /**
     * Initialize the Basecamp Instance Object.
     *
     * @param  object  $attributes
     * @return void
     */
    public function __construct($attributes)
    {
        $this->setAttributes($attributes);
    }

    /**
     * Set attributes.
     *
     * @param  object  $attributes
     * @return void
     */
    protected function setAttributes($attributes)
    {
        $this->attributes = (array) $attributes;
    }

    /**
     * Get a property from the model.
     *
     * @param  string $property
     * @return mixed
     */
    public function __get($property)
    {
        if (array_key_exists($property, $this->attributes))
            return $this->attributes[$property];
        else
            return null;
    }

    /**
     * Method to add the context if not present.
     *
     * @param  int $bucket
     * @param  int $parent
     * @return void
     */
    public function inContext($bucket, $parent = null)
    {
        $this->bucket = (object) ['id' => $bucket];
        if ($parent) $this->parent = (object) ['id' => $parent];
    }
}
