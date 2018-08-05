<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
use App\Http\Requests;
use App\Repository\PostInterface;
 
class PostController extends Controller
{
    /**
	 * @var $post
	 */
	private $post;
 
	/**
	 * PostController constructor.
	 *
	 * @param App\Repository\PostInterface $post
	 */
	public function __construct(PostInterface $post) 
	{
		$this->post = $post;
	}
 
	/**
	 * Get all tasks.
	 *
	 * @return Illuminate\View
	 */
	public function index($id = null)
	{
		$posts = $this->post->getAll();
		$editPost = (isset($id)) ? $this->post->getById($id) : null;
        
        if($posts){
            return response()->json(['data' => $posts], 200);
        }
		//return response()->json(['error'=>'Something went wrong'], 412);
		//return view('tasks.index', compact('tasks', 'editTask'));
	}
 
	/**
	 * Store a post
	 *
	 * @var array $attributes
	 *
	 * @return mixed
	 */
	public function store(Request $request)
	{
		$attributes = $request->only(['description']);
		$result = $this->post->create($attributes);
        if($result){
            return response()->json(['success'=>'Post created successfully'], 200);
        }
		return response()->json(['error'=>'Something went wrong'], 412);
	}
 
	/**
	 * Update a post
	 *
	 * @var integer $id
	 * @var array 	$attributes
	 *
	 * @return mixed
	 */
	public function update($id, Request $request)
	{
		$attributes = $request->only(['description']);
		$result = $this->post->update($id, $attributes);
 
		if($result){
            return response()->json(['success'=>'Post updated successfully'], 200);
        }
		return response()->json(['error'=>'Something went wrong'], 412);
	}
 
	/**
	 * Delete a post
	 *
	 * @var integer $id
	 *
	 * @return mixed
	 */
	public function destroy($id)
	{
		$result = $this->post->delete($id);
 
		if($result){
            return response()->json(['success'=>'Post deleted successfully'], 200);
        }
		return response()->json(['error'=>'Something went wrong'], 412);
	}
}