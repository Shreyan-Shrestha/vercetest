<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function publicIndex()
    {
        $posts = Post::published()
            ->with('category')
            ->latest('published_at')
            ->paginate(9);
        return view('posts.index', compact('posts'));
    }

    /**
     * Admin dashboard – shows all posts (including drafts)
     */
    public function adminIndex()
    {
        $posts = Post::with(['category', 'tags'])
            ->latest()
            ->paginate(10);

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Public post view – aborts 404 if not published
     */
    public function show(Post $post)
    {
        if (!$post->published_at) {
            abort(404);
        }
        $posts=Post::published()
            ->with('category')
            ->latest('published_at')
            ->paginate(3);

        return view('posts.show', compact('post', 'posts'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        $post = new Post(); // This creates an empty Post object
        $categories = Category::all();

        return view('admin.posts.form', compact('post', 'categories'));
    }

    /**
     * Store new post
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'          => 'required|string|max:255',
            'body'           => 'required',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5048',
            'category_id'    => 'nullable|exists:categories,id',
            'tags'           => 'nullable|string',
        ]);

        $post = new Post();
        $this->savePost($post, $request);

        return redirect()->route('blog.admin.posts.index')->with('success', 'Post created!');
    }

    /**
     * Show edit form
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.posts.form', compact('post', 'categories'));
    }

    /**
     * Update existing post
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title'          => 'required|string|max:255',
            'body'           => 'required',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5048',
            'category_id'    => 'nullable|exists:categories,id',
            'tags'           => 'nullable|string',
        ]);

        $this->savePost($post, $request);

        return redirect()->route('blog.admin.posts.index')->with('success', 'Post updated!');
    }

    /**
     * Delete post
     */
    public function destroy(Post $post)
    {
        if ($post->featured_image) {
            Storage::delete('public/' . $post->featured_image);
        }

        $post->delete();

        return redirect()->route('blog.admin.posts.index')->with('success', 'Post deleted!');
    }

    /**
     * Handle image upload from Quill editor
     */
    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5048',
        ]);

        $path = $request->file('image')->store('post-images', 'public');

        return response()->json(['url' => asset('storage/' . $path)]);
    }

    /**
     * Shared logic for storing/updating a post
     */
    private function savePost(Post $post, Request $request)
    {
        $post->title       = $request->title;
        $post->body        = $request->body;
        $post->excerpt     = Str::limit(strip_tags($request->body), 100);
        $post->category_id = $request->category_id ?? null;
        $post->published_at = $request->has('publish') ? now() : null;

        // Generate unique slug
        $baseSlug = Str::slug($request->title);
        $slug     = $baseSlug;
        $count    = 1;
        while (Post::where('slug', $slug)->where('id', '!=', $post->id ?? 0)->exists()) {
            $slug = $baseSlug . '-' . $count++;
        }
        $post->slug = $slug;

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image if updating
            if ($post->exists && $post->featured_image) {
                Storage::delete('public/' . $post->featured_image);
            }

            $path = $request->file('featured_image')->store('post-images', 'public');
            $post->featured_image = $path;
        }

        $post->save();

        // Handle tags (comma-separated string)
        $tagNames = array_filter(array_map('trim', explode(',', $request->tags ?? '')));
        $tagIds   = [];

        foreach ($tagNames as $name) {
            if ($name) {
                $tag = Tag::firstOrCreate(
                    ['name' => $name],
                    ['slug' => Str::slug($name)]
                );
                $tagIds[] = $tag->id;
            }
        }

        $post->tags()->sync($tagIds);
    }
}
