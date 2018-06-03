<?php

namespace App\Admin\Controllers;

use App\Models\Article;

use App\Models\Category;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class ArticleController extends Controller
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

            $content->header('文章列表');
            $content->description('文章列表');
            $content->breadcrumb(
                ['text' => '首页', 'url' => '/'],
                ['text' => '文章管理', 'url' => '/article'],
                ['text' => '文章列表']
            );

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

            $content->header('修改文章');
            $content->description('修改文章');
            $content->breadcrumb(
                ['text' => '首页', 'url' => '/'],
                ['text' => '文章管理', 'url' => '/article'],
                ['text' => '修改文章']
            );
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

            $content->header('新增文章');
            $content->description('新增文章');
            $content->breadcrumb(
                ['text' => '首页', 'url' => '/'],
                ['text' => '文章管理', 'url' => '/article'],
                ['text' => '新增文章']
            );
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
        return Admin::grid(Article::class, function (Grid $grid) {
            $grid->model()->orderBy('updated_at', 'DESC');
            $grid->id('ID')->sortable();
            $grid->title('文章标题');
            $grid->category()->id('分类id');
            $grid->category()->name('分类名称');
            $grid->created_at('创建时间');
            $grid->updated_at('更新时间');
            $grid->filter(function($filter){

                // 去掉默认的id过滤器
                $filter->disableIdFilter();

                // 在这里添加字段过滤器
                $filter->like('title', '标题');

            });
            $grid->disableExport();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Article::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('title','文章标题')->rules('required');
            $form->select('category_id','类别')
                ->options(Category::all()->pluck('name', 'id'))
                ->default(0)
                ->rules('required');
            $form->image('image','文章展示页图片')
                ->move('articles')
                ->uniqueName()->rules('required');
            $form->editor('content','文章内容');
            $form->display('created_at', '创建时间');
            $form->display('updated_at', '更新时间');
        });
    }
}
