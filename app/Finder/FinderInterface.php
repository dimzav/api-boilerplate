<?php

namespace App\Finder;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


interface FinderInterface
{
    /**
     * Retrieving collection of all elements.
     *
     * @return Collection
     */
    public function all(): Collection;

    /**
     * Retrieving one model.
     *
     * @return Model
     */
    public function one(): Model;

    /**
     * Get search object to manage results based on request.
     *
     * @return Builder
     */
    public function search(): Builder;

    /**
     * Retrieve pagination object.
     *
     * @param int $perPage
     *
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage): LengthAwarePaginator;
}
