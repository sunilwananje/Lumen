<?php
 
namespace App\Repository\Eloquent;
use App\Repository\PostInterface;
use App\Models\Post;
 
class PostEloquent implements PostInterface
{
	/**
	 * @var $model
	 */
	private $model;
 
	/**
	 * PostEloquent constructor.
	 *
	 * @param App\Models\Post $model
	 */
	public function __construct(Post $model)
	{
		$this->model = $model;
	}
 
	/**
	 * Get all posts.
	 *
	 * @return Illuminate\Database\Eloquent\Collection
	 */
	public function getAll()
	{
		return $this->model->all();
	}
 
	/**
	 * Get post by id.
	 *
	 * @param integer $id
	 *
	 * @return App\Models\Post
	 */
	public function getById($id)
	{
		return $this->model->find($id);
	}
 
	/**
	 * Create a new Post.
	 *
	 * @param array $attributes
	 *
	 * @return App\Models\Post
	 */
	public function create(array $attributes)
	{
		return $this->model->create($attributes);
	}
 
	/**
	 * Update a Post.
	 *
	 * @param integer $id
	 * @param array $attributes
	 *
	 * @return App\Models\Post
	 */
	public function update($id, array $attributes)
	{
		return $this->model->find($id)->update($attributes);
	}
 
	/**
	 * Delete a Post.
	 *
	 * @param integer $id
	 *
	 * @return boolean
	 */
	public function delete($id)
	{
		return $this->model->find($id)->delete();
	}
}