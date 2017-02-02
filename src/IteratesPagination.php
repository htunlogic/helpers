<?php
namespace Htunlogic\Helpers;

trait IteratesPagination
{
    /**
     * Handles request and extracts default params.
     *
     * @param mixed    $paginated
     * @param callable $callable
     * @return mixed
     */
    protected function forPaginatedItems($paginated, callable $callable)
    {
        $collection = $paginated->getCollection();
        $collection = $callable($collection);
        return $paginated->setCollection($collection);
    }

    /**
     * Runs the handler with map on collection already initiated.
     *
     * @param mixed    $paginated
     * @param callable $callable
     * @return mixed
     */
    protected function forPaginatedItemsMap($paginated, callable $callable)
    {
        return $this->forPaginatedItems($paginated, function ($items) use ($callable) {
            return $items->map(function ($item, $key) use ($callable) {
                return $callable($item, $key);
            });
        });
    }

    /**
     * Runs the handler with filter on collection already initiated.
     *
     * @param mixed    $paginated
     * @param callable $callable
     * @return mixed
     */
    protected function forPaginatedItemsFilter($paginated, callable $callable)
    {
        return $this->forEachPaginatedItem($paginated, function ($items) use ($callable)  {
            return $items->filter(function ($item, $key) use ($callable)  {
                return $callable($item, $key);
            });
        });
    }

    /**
     * Runs the handler with filter on collection already initiated.
     *
     * @param mixed    $paginated
     * @param callable $callable
     * @return mixed
     */
    protected function forEachPaginatedItem($paginated, callable $callable)
    {
        return $this->forPaginatedItems($paginated, function ($items) use ($callable)  {
            return $items->each(function ($item, $key) use ($callable)  {
                return $callable($item, $key);
            });
        });
    }
}