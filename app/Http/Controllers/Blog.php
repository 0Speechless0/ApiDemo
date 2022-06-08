<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cache;
class Blog extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = Cache::get("posts", []);
        $result = collect($result)->reduce(function ($carry, $item){
            if($item != null) $carry[] = $item; 
            return $carry;
        }, []);

        // $result = collect($result)->filter();
        return response()->json($result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Cache::pull("posts");
        return response()->json([
            "author" => "Alex",
            "title" => "My First Post",
            "content" => "Today is a good day."
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $posts = Cache::get("posts");
            if(!$posts) $posts = [];
            $post = $request->all();
            $post["id"] = collect($posts)->count();
            $posts[] = $post;

            Cache::put("posts", $posts);

        }
        catch(Exception $e) {
            return response()->json(["error" => $e]);
        }

        return response("Ok", 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = Cache::get("posts");
        return response()->json($result[$id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $posts = Cache::get("posts");
            $posts[$id] = $request->all();
            Cache::put("posts", $posts);
        }
        catch(Exception $e) {

            return response()->json(["error" => $e]);
        }
        return response("Ok", 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $posts = Cache::get("posts");
            $posts[$id] =null;
            Cache::put("posts", $posts);

        }
        catch(Exception $e) {

            return response()->json(["error" => $e]);
        }
        return response("Ok", 200);

    }
}
