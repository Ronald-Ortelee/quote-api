<?php

namespace App\Services;

use Validator;
use App\Models\Quote;

class QuoteService
{
    /**
     * Service Model
     *
     * @var Model
     */
    public $model;

    /**
     * Pagination
     *
     * @var integer
     */
    protected $pagination;

    /**
     * Service Constructor
     *
     * @param Quote $quote
     */
    public function __construct(Quote $quote)
    {
        $this->model        = $quote;
        $this->pagination   = env('PAGINATION', 25);
    }

    /**
     * All Model Items
     *
     * @return array
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Paginated items
     *
     * @return LengthAwarePaginator
     */
    public function paginated()
    {
        return $this->model->paginated($this->pagination);
    }

    /**
     * Search the model
     *
     * @param  mixed $input
     * @return LengthAwarePaginator
     */
    public function search($input)
    {
        $query = $this->model->orderBy('created_at', 'desc');
        $query->where('id', 'LIKE', '%'.$input.'%');

        $columns = Schema::getColumnListing('quotes');

        foreach ($columns as $attribute) {
            $query->orWhere($attribute, 'LIKE', '%'.$input.'%');
        };

        return $query->paginate($this->pagination);
    }

    /**
     * Create the model item
     *
     * @param  array $input
     * @return Model
     */
    public function create($input)
    {
        if (Validator::make($input, Quote::$rules)->errors()->count() === 0) {
            return $this->model->create($input);
        }

        return false;
    }

    /**
     * Find Model by ID
     *
     * @param  integer $id
     * @return Model
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Model update
     *
     * @param  integer $id
     * @param  array $input
     * @return Model
     */
    public function update($id, $input)
    {
        return $this->model->update($id, $input);
    }

    /**
     * Destroy the model
     *
     * @param  integer $id
     * @return bool
     */
    public function destroy($id)
    {
        return $this->model->destroy($id);
    }
}
