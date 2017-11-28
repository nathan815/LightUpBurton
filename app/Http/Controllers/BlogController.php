<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase;
use Kreait\Firebase\Database;
use Carbon\Carbon;

class BlogController extends Controller
{

  private $firebase;
  private $db;

  public function __construct(Firebase $firebase) {
    $this->firebase = $firebase;
    $this->db = $this->firebase->getDatabase();
  }

  public function index() {
    $formattedPosts = [];
    $posts = $this->db->getReference('blog/posts')->getValue();
    
    $formattedPosts = $this->formatPosts($posts);

    return view('blog.index')->with(['posts' => $formattedPosts]);
  }

  public function showPost($slug) {
    // Get the post from the slug
    $posts = $this->db->getReference('blog/posts')->orderByChild('slug')->equalTo($slug)->limitToFirst(1)->getValue();

    if(!$posts) {
      abort(404);
    }

    $posts = $this->formatPosts($posts);
    $post = head($posts);
    $post['viewing'] = true;

    return view('blog.view_post')->with(['post' => $post]);

  }

  public function create() {
    $post = [
      'title' => 'Test 123',
      'body' => 'A nice body',
      'slug' => 'test-123',
      'createdAt' => Database::SERVER_TIMESTAMP,
      'authorId' => 1,
      'categoryId' => 0
    ];
    $newPost = $this->db->getReference('blog/posts')->push($post);
    dd($postKey = $newPost->getKey());
  }

  private function formatPosts($posts) {
    $formattedPosts = [];
    foreach($posts as $id => $post) {
      $time = $post['createdAt']/1000;
      $post['createdAtReadable'] = Carbon::createFromTimestamp($time)->format('M jS, Y');
      $post['id'] = $id;
      $formattedPosts[$id] = $post;
    }
    return $formattedPosts;
  }
}
