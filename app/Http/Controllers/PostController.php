<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //DEFINE THE RESOURCE
        $posts = Post::with(['user']);

        //ADD FILTERS
        if ($request->has('member_id')) {
            $posts = $posts->where('member_id', $request->member_id);
        }
        if ($request->has('gender')) {
            $posts = $posts->where('gender', $request->gender);
        }

        //SEARCHING
        if ($request->has('search')) {
            $search = '%' . $request->search . '%';
            if ($request->search == 'male') {
                $search = $request->search . '%';
            }

            $posts = $posts
                ->orWhere('title', 'like', $search)
                ->orWhere('description', 'like', $search)
                ->orWhere('gender', 'like', $search)
                ->orWhereHas('user', function ($query) use ($search) {
                    $query = $query->where('name', 'like', $search);
                });
        }

        //SORTING
        if ($request->has('sort_by')) {
            $sort_by = $request->sort_by;
            $sort_order = $request->input('sort_order', 'asc');

            if ($sort_by == 'user_name') {
                $posts = $posts
                    ->join('members', 'members.id', '=', 'posts.member_id')
                    ->orderBy('members.name', $sort_order)
                    ->select([
                        'posts.id',
                        'posts.member_id',
                        'posts.title',
                        'posts.description',
                        'posts.gender',
                        'posts.created_at',
                        'posts.updated_at',
                    ]);
            } else {
                if (Post::first()) {
                    if (in_array($sort_by, Schema::getColumnListing(Post::first()->getTable()))) {
                        $posts = $posts->orderBy($sort_by, $sort_order);
                    } else {
                        return response()->json([
                            'message' => __('messages.invalid_sort_by'),
                            'status' => '0',
                        ]);
                    }
                }
            }
        }

        if ($request->has('page')) {
            $posts = $posts->simplePaginate($request->input('per_page', 10));

            return response()->json([
                'data' =>  $posts->items(),
                'next_page' => (string) ($posts->currentPage() + 1),
                'message' => __('messages.banner_list_returned'),
                'status' => '1',
            ]);
        }

        return response()->json([
            'data' =>  $posts->get(),
            'message' => __('messages.banner_list_returned'),
            'status' => '1',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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