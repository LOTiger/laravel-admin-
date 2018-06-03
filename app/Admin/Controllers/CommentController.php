<?php

namespace App\Admin\Controllers;

use App\Models\Article;
use App\Models\Comment;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class CommentController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('文章留言');
            $content->description('文章留言');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('文章留言');
            $content->description('文章留言');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('文章留言');
            $content->description('文章留言');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Comment::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->name('姓名');
            $grid->email('联系邮箱');
//            $grid->article_id('文章题目');
            $grid->article_id('文章题目')->display(function($text) {
                return Article::query()->find($text)->title;
            });
            $grid->content('留言内容')->display(function($text) {
                return str_limit($text, 50, '...');
            });
            $grid->created_at('创建时间');
            $grid->updated_at('更新时间');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Comment::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->select('article_id','文章')->options(Article::all()->pluck('title', 'id'))->rules('required');
            $form->text('name','姓名')->placeholder('留言姓名')->rules('required|max:10');
            $form->email('email','联系邮箱')->rules('required');
            $form->textarea('content','留言内容');
            $form->radio('status','审核状态')->options(['0' => '驳回', '1'=> '通过'])->default('0');
            $form->display('created_at', '创建时间');
            $form->display('updated_at', '更新时间');
        });
    }
}
