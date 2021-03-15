<?php

namespace App\Menu\Filters;

use Illuminate\Contracts\Auth\Access\Gate;

class GateFilter implements FilterInterface
{
    /**
     * The Laravel gate instance, used to check for permissions.
     *
     * @var Gate
     */
    protected $gate;

    /**
     * Constructor.
     *
     * @param Gate $gate
     */
    public function __construct(Gate $gate)
    {
        $this->gate = $gate;
    }

    /**
     * Transforms a menu item. Add the restricted property to a menu item
     * when situable.
     *
     * @param array $item A menu item
     * @return array The transformed menu item
     */
    public function transform($item)
    {
        // Set a special attribute when item is not allowed. Items with this
        // attribute will be filtered out of the menu.

        if (!$this->isAllowed($item)) {
            $item['restricted'] = true;
        }

        return $item;
    }

    /**
     * Check if a menu item is allowed for the current user.
     *
     * @param array $item A menu item
     * @return bool
     */
    protected function isAllowed($item)
    {
        // Check if there are any permission defined for the item.
        if (empty($item['permission'])) {
            return true;
        }

        // Read the extra arguments (a db model instance can be used).

        $args = isset($item['model']) ? $item['model'] : [];

        // Check if the current user can perform the configured permissions.

        if (is_string($item['permission']) || is_array($item['permission'])) {
            return $this->gate->any($item['permission'], $args);
        }

        return true;
    }
}
