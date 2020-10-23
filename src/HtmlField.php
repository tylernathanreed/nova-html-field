<?php

namespace Reedware\NovaHtmlField;

use Laravel\Nova\Fields\Field;
use Illuminate\Contracts\Support\Htmlable;

class HtmlField extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'html-field';

    /**
     * The html to display.
     *
     * @var \Closure
     */
    public $htmlCallback;

    /**
     * Create a new field.
     *
     * @param  string  $value
     *
     * @return void
     */
    public function __construct($htmlCallback)
    {
        parent::__construct('Html');

        $this->attribute = 'HtmlComputedField';
        $this->htmlCallback = is_callable($htmlCallback) ? $htmlCallback : function() use ($htmlCallback) {
            return $htmlCallback;
        };
    }

    /**
     * Resolve the field's value.
     *
     * @param  mixed        $resource
     * @param  string|null  $attribute
     *
     * @return void
     */
    public function resolve($resource, $attribute = null)
    {
        $attribute = $attribute ?? $this->attribute;

        if($attribute === 'HtmlComputedField') {
            $this->value = call_user_func($this->htmlCallback, $resource);
        }

        return parent::resolve($resource, $attribute);
    }

    /**
     * Casts the specified value to html.
     *
     * @param  mixed  $value
     *
     * @return string
     */
    protected function toHtml($value)
    {
        if(is_object($value) && $value instanceof Htmlable) {
            return (string) $value->toHtml();
        }

        return (string) $value;
    }
}
