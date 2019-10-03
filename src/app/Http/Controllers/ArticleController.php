<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $article = Article::all();

        return view('article.index', ['articles' => $article]);
    }

    public function add (Request $request)
    {
        $inputs = $request->all();

        $rules = [
            'title' => 'required|max:15',
            'body' => 'required|max:256'
        ];

        $messages = [
            'title.required' => 'タイトルは必須だよ',
            'title.max' => 'タイトルは15文字以内だよ',
            'body.required' => '本文は必須だよ',
            'body.max' => '本文は256文字以内だよ',
        ];

        //Validationを設定する
        $validation = Validator::make($inputs, $rules, $messages);

        //Validationが失敗した場合・・・
        if ($validation->fails()) {
            // 入力値を維持して$errorsを設定して元の画面に戻す。
            //todo 確認する
            //redirect リダイレクトする
            return redirect()->back()->withErrors($validation->errors())->withInput();
        }

        $article = new Article;
        $article->user_id = 1;
        $article->title = $request->input('title');
        $article->body = $request->input('body');
        $article->save();

        return redirect()->to('/article');
    }

    public function delete(Request $request)
    {
        Article::find($request->id)->delete();
        return redirect('/article');
    }
}
