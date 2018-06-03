<?php

namespace App\Admin\Controllers;

use App\Models\Lesson;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class LessonController extends Controller
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

            $content->header('课程列表');
            $content->description('课程列表...');

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

            $content->header('课程修改');
            $content->description('课程修改...');

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

            $content->header('课程创建');
            $content->description('课程创建...');

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
        return Admin::grid(Lesson::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->name('课程名称');
            $grid->description('课程简介')->display(function($text) {
                return str_limit($text, 350, '...');
            });
            $grid->image('课程图片')->image("", 100, 100);
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
        return Admin::form(Lesson::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('name','课程名称')->rules('required');
            $form->text('category','课程分类')->rules('required');
            $form->image('image','课程展示页图片')->move('lessons')->uniqueName()->rules('required');
            $form->editor('description','课程简介')->rules('required');
            $form->display('created_at', '创建时间');
            $form->display('updated_at', '更新时间');
        });
    }
}
