<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Throwable;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|max:255|min:3',
            'content' => 'required',
            'image' => "required|image",
            "tag" => "required|max:255"
        ]);


        $request->merge(["slug" => strtolower(str_replace(" ", "-", $request->title))]);

        $request->validate([
            "slug" => "unique:posts,slug"
        ]);

        try {

            $tag = Tag::firstOrCreate(["name" => $request->tag]);
            $request->merge(["tag_id" => $tag->id]);


            $img = $request->file("image");
            $name_image =   time() . "-" . Str::uuid() . "."  .  $img->getClientOriginalExtension();
            $name_ori = $img->move(public_path("uploads/posts"), $name_image);
            // $img->storeAs("uploads/post", $name_image);




            Post::create([
                "title" => $request->title,
                "slug" => $request->slug,
                "content" => $request->content,
                "tag_id" => $request->tag_id,
                "image" => "posts/" . $name_ori->getFilename()
            ]);
        } catch (Throwable $e) {
            $errorMessage = $e->getMessage();
            // Redirect ke halaman error
            return redirect("/post")->with("error",  $errorMessage);
        }

        return redirect("/post")->with("success", "Post has been created");
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return view("post.post");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
