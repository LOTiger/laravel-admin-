<?php

namespace App\Admin\Controllers;

use App\Models\Contact;

use App\Models\Lesson;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class ContactController extends Controller
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

            $content->header('报名联系列表');
            $content->description('报名联系列表...');

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

            $content->header('报名联系列表');
            $content->description('报名联系列表');

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

            $content->header('报名联系列表');
            $content->description('报名联系列表');

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
        return Admin::grid(Contact::class, function (Grid $grid) {

//            $grid->disableCreateButton();

            $grid->id('ID')->sortable();
            $grid->name('学员姓名');
            $grid->phone('联系电话');
            $grid->email('电子邮箱');
            $grid->QQNum('QQ号码');
            $grid->wechatNum('微信号码');
            $grid->lesson_id('报名课程id');
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
        return Admin::form(Contact::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->select('lesson_id','报选课程')->options(Lesson::all()->pluck('name', 'id'))->rules('required');
            $form->text('name','学员姓名')->placeholder('请输入学员姓名')->rules('required|max:10');
            $form->mobile('phone','联系电话')->options(['mask' => '999 9999 9999'])->rules('required');
            $form->email('email','电子邮箱')->rules('required');
            $form->text('QQNum','QQ号码')->rules('required');
            $form->text('wechatNum','微信号码');
            $form->textarea('content','留言内容');

            $form->display('created_at', '创建时间');
            $form->display('updated_at', '更新时间');
        });
    }
}
