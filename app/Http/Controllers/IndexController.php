<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Lesson;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Input;

class IndexController extends Controller
{
    public function index()
    {
        $resent = Article::query()->orderByDesc('created_at')->take(6)->get();
        return view('home.index', compact('resent'));
    }

    public function article($id)
    {
        try
        {
            $article = Article::query()->find($id);
            $relatedArticles = Article::query()
                ->where('category_id',$article->category_id)
                ->orderByDesc('created_at')
                ->limit(8)
                ->get();
            return view('home.article', compact('article','relatedArticles'));
        }
        catch (Exception $exception)
        {
            return redirect()->back();
        }
    }

    public function articleEnroll($id)
    {
        try
        {
            $articles = Article::query()->where('category_id',$id)->orderByDesc('created_at')->paginate(8);

            $category = Category::query()->find($id);

            return view('home.articleenroll', compact('articles','category'));
        }
        catch (Exception $exception)
        {
            return redirect()->back();
        }
    }

    public function contact(Request $request)
    {
        try
        {
            $this->validate($request,[
                'name' => 'required',
                'email' => 'required|email',
                'content' => 'required',
            ]);
            Contact::query()->create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'content' => $request->get('content'),
            ]);

            return redirect()->back()->with(['msg'=>"留言成功"]);
        }
        catch (Exception $exception)
        {
            return redirect()->back()->with(['msg'=>"非法输入"]);
        }

    }

    public function comment(Request $request)
    {
        try
        {
            $this->validate($request,[
                'name' => 'required',
                'email' => 'required|email',
                'content' => 'required',
                'article_id' => 'required'
            ]);
            $a = Comment::query()->create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'content' => $request->get('content'),
                'article_id' => $request->get('article_id')
            ]);
            return redirect()->back()->with(['msg'=>"留言成功"]);
        }
        catch (ValidationException $exception)
        {
            return redirect()->back()->with(['msg'=>$exception->getMessage()]);
        }
    }

}
