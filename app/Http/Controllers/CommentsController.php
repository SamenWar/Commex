<?php

namespace App\Http\Controllers;


use App\Models\Comments;
use App\Http\Requests\StoreCommentsRequest;
use App\Http\Requests\UpdateCommentsRequest;
use App\Http\Resources\CommentsResource;
use Illuminate\Support\Facades\Http;


class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Http\Response
     */
    public function index()
    {

        $comments = Comments::whereNull('parent_id')->with('children')->get();
        return CommentsResource::collection($comments);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCommentsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommentsRequest $request)
    {
//        $recaptchaResponse = $request->input('g-recaptcha-response');
//
//        $response = Http::post('https://www.google.com/recaptcha/api/siteverify', [
//            'secret' => env('RECAPTCHA_SECRET'),
//            'response' => $recaptchaResponse,
//        ]);
//
//        $body = $response->json();
//
//        if (!$body['success']) {
//            return back()->withErrors(['captcha' => 'Ошибка reCAPTCHA. Пожалуйста, попробуйте еще раз.']);
//        }

        // Валидация данных
        $validatedData = $request->validate([
            'user_name' => 'required|alpha_num|max:255',
            'email' => 'required|email|max:255',
            'home_page' => 'nullable|url|max:255',
            'text' => 'required|string',
            'parent_id' => 'nullable|exists:comments,id', // Убедитесь, что родительский комментарий существует
        ]);

        // Создание нового комментария
        $comment = Comments::create($validatedData);

        // Возвращение ответа (например, редирект на страницу комментариев с сообщением об успехе)
        return redirect()->route('comments.index')->with('success', 'Comment successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comments  $comments
     * @return \Illuminate\Http\Response
     */
    public function show(Comments $comments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comments  $comments
     * @return \Illuminate\Http\Response
     */
    public function edit(Comments $comments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCommentsRequest  $request
     * @param  \App\Models\Comments  $comments
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommentsRequest $request, Comments $comment)
    {
        $data = $request->validate([
            'user_name' => 'required|alpha_num|max:255',
            'email' => 'required|email|max:255',
            'home_page' => 'nullable|url|max:255',
            'text' => 'required|string',
        ]);

        $comment->update($data);
        return response()->json(['message' => 'Comment updated successfully']);


    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comments  $comments
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comments $comments)
    {
        $comments->delete();
        return response()->json(['message' => 'Comment deleted successfully']);
    }
}
