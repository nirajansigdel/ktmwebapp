<?php

namespace App\Http\Controllers;

use App\Models\SummernoteContent;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')->latest()->get()->take(50);
        $summernoteContent = new SummernoteContent();
        $post = $summernoteContent;
        return view('backend.post.index', compact('posts', 'summernoteContent'));
    }

    public function create()
    {
        $categories = Category::all(); // Fetch all categories
        return view('backend.post.create', compact('categories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'required|image|max:2048',
            'category_id' => 'required|exists:categories,id'
        ]);


        // Move the uploaded image to the desired directory
        $imageName = $request->image->getClientOriginalName();
        $request->image->move(public_path('uploads/post'), $imageName);


        $summernoteContent = new SummernoteContent();
        $processedDescription = $summernoteContent->processContent($request->description);

        // Create a new Post instance and save it to the database
        $post = new Post();
        $post->title = $request->input('title');
        $post->description = $processedDescription;
        $post->image = $imageName; // Store only the filename in the database
        $post->category_id = $request->input('category_id');
        $post->save();



        // Redirect back to the index page with a success message
        return redirect()->route('admin.posts.index')->with('success', 'Post created successfully');
    }

    public function edit($id)
    {
        $categories = Category::all();
        $post = Post::with('category')->find($id);
        return view('backend.post.update', ['categories' => $categories, 'post' => $post, 'page_title' => 'Update Post']);
    }


    public function update(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'image|max:2048',
            'category_id' => 'required|exists:categories,id'
        ]);
        try {
            $post = Post::find($id);
            // Check if a new image has been uploaded
            if ($request->hasFile('image')) {
                // Assuming you want to replace the old logo
                $newImage = time() . '.' . $request->image->getClientOriginalExtension();
                $request->image->move(public_path('uploads/post/'), $newImage);
                $post->image = $newImage;
            }
            // Process description through SummernoteContent
            $summernoteContent = new SummernoteContent();
            $processedDescription = $summernoteContent->processContent($request->description);
            
            // Update the image attribute of the post with the new image path
            $post->title = $request->title;
            $post->description = $processedDescription;
            $post->category_id = $request->category_id;

            if ($post->save()) {
                return redirect()->route('admin.posts.index')->with('success', 'Success !! Post Updated');
            } else {
                return redirect()->back()->with('error', 'Error! Post not updated.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error! Something went wrong: ' . $e->getMessage());
        }
    }




    public function destroy($id)
    {
        try {
            $post = Post::findOrFail($id);
            
            // Delete the image file if it exists
            if ($post->image && file_exists(public_path('uploads/post/' . $post->image))) {
                unlink(public_path('uploads/post/' . $post->image));
            }
            
            $post->delete();

            return redirect()->route('admin.posts.index')->with('success', 'Post deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('admin.posts.index')->with('error', 'Error deleting post: ' . $e->getMessage());
        }
    }
}