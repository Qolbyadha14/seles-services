<?php
namespace App\Http\BaseRepositories;

use App\Http\BaseRepositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements RepositoryInterface
{
    protected $model;
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function find($id)
    {
        return $this->model->all();
    }

    /**
     * @param array $criteria
     *
     * @return mixed
     */
    public function findBy(array $criteria)
    {
        $query = $this->model;

        foreach ($criteria as $field => $value) {
            $query = $query->where($field, $value);
        }

        return $query->get();
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * @param $id
     * @param array $data
     *
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function update($id, array $data)
    {
        $record = $this->find($id);

        if ($record) {
            $record->update($data);
            return $record;
        }

        return null;
    }

    /**
     * @param $id
     *
     * @return false
     */
    public function delete($id)
    {
        $record = $this->find($id);

        if ($record) {
            return $record->delete();
        }

        return false;
    }
}
