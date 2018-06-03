<?php

namespace App\Admin\Controllers;

use App\Models\Category;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class CategoryController extends Controller
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

            $content->header('分类列表');
            $content->description('分类列表详情');

            $content->breadcrumb(
                ['text' => '首页', 'url' => '/'],
                ['text' => '分类管理', 'url' => '/category'],
                ['text' => '分类列表']
            );

            $content->body(Category::tree());
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

            $content->header('修改分类');
            $content->description('修改分类');
            $content->breadcrumb(
                ['text' => '首页', 'url' => '/'],
                ['text' => '分类管理', 'url' => '/category'],
                ['text' => '修改分类']
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

            $content->header('创建分类');
            $content->description('创建分类');
            $content->breadcrumb(
                ['text' => '首页', 'url' => '/'],
                ['text' => '分类管理', 'url' => '/category'],
                ['text' => '创建分类']
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
        return Admin::grid(Category::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->name('分类名称');
            $grid->parent_id('父类id');
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
        return Admin::form(Category::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('name','分类名称')->rules('required');
            $form->select('parent_id','父类')
                ->options(Category::all()
                    ->pluck('name', 'id')
                    ->put(0,'最高级')
                    ->sortBy(function ($product, $key) {
                        return $key;
                    }))
                ->default(['max'=>0]);
            $form->display('created_at', '创建时间');
            $form->display('updated_at', '更新时间');
        });
    }
}
