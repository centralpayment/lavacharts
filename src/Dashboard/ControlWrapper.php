<?php

namespace Khill\Lavacharts\Dashboard;

use \Khill\Lavacharts\Utils;
use \Khill\Lavacharts\Values\ElementId;
//use \Khill\Lavacharts\Dashboard\Wrapper;
use \Khill\Lavacharts\Filters\Filter;
use \Khill\Lavacharts\Exceptions\InvalidConfigValue;

/**
 * ControlWrapper Class
 *
 * Used for building controls for dashboards.
 *
 * @package    Lavacharts
 * @subpackage Dashboard
 * @since      3.0.0
 * @author     Kevin Hill <kevinkhill@gmail.com>
 * @copyright  (c) 2015, KHill Designs
 * @link       http://github.com/kevinkhill/lavacharts GitHub Repository Page
 * @link       http://lavacharts.com                   Official Docs Site
 * @license    http://opensource.org/licenses/MIT MIT
 */
class ControlWrapper implements \JsonSerializable
{
    /**
     * Google's visualization class name.
     *
     * @var string
     */
    const VIZ_CLASS = 'google.visualization.ControlWrapper';

    /**
     * Array of options for the Control.
     *
     * @var array
     */
    private $options;

    /**
     * Filter used in the Control.
     *
     * @var \Khill\Lavacharts\Filters\Filter
     */
    private $controlType;

    /**
     * HTML element id of the div to render the control into.
     *
     * @var string
     */
    private $containerId;

    /**
     * Builds a ControlWrapper object.
     *
     * @param  \Khill\Lavacharts\Charts\Chart $chart
     * @param  \Khill\Lavacharts\Filters\Filter $filter
     * @param  string $containerId
     * @return self
     */
    public function __construct(Filter $filter, ElementId $containerId)
    {
        $this->type        = $filter::TYPE;
        $this->controlType = $filter;
        $this->containerId = $containerId;
    }

    /**
     * Returns the container id.
     *
     * @return \Khill\Lavacharts\Values\ElementId
     */
    public function getContainerId()
    {
        return $this->containerId;
    }

    /**
     * Returns a javascript string with the constructor for the ControlWrapper
     *
     * @return string
     */
    public function toJavascript()
    {
        return sprintf('new %s(%s)', self::VIZ_CLASS, json_encode($this));
    }

    /**
     * Custom serialization of the ControlWrapper.
     *
     * @return array
     */
    public function jsonSerialize() {
        return [
            'controlType' => $this->type,
            'containerId' => (string) $this->containerId,
            'options' => [ //@TODO: make options classes
                'filterColumnLabel' => $this->controlType->columnLabel,
                /*'ui' => [
                    'labelStacking' => 'vertical'
                ]*/
            ]
        ];
    }
}