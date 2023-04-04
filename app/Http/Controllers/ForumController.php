<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MyModel;
use Illuminate\Support\Facades\DB;

class ForumController extends Controller
{
    private $model;
    public function __construct()
    {
        $this->model = new MyModel;
    }
    public function forumIndex()
    {
        $forumNew2s = $this->model->forumNew2();
        $questions = $this->model->question();
        $groups = $this->model->group();
        $haters = $this->model->hater();
        return view('forumIndex',[
            'forumNew2s' => $forumNew2s,
            'questions' => $questions,
            'groups' => $groups,
            'haters' => $haters
        ]);
    }
    public function forumDetail(Request $request)
    {
        $id = $request->id;
        $sid = $request->sid;
        $articles = $this->model->forumDetail($sid,$id);
        $FCquestions = $this->model->FCquestion($sid,$id);
        $forumNews = $this->model->forumNew($sid);
        return view('forumDetail',[
            'articles' => $articles,
            'FCquestions' => $FCquestions,
            'forumNews' => $forumNews
        ]);
    }

    public function forumMes(Request $request)
    {
        $uid = $request->uid;
        $title = $request->title;
        $content = $request->content;
        $sid = $request->sid;

        // 從請求中獲取文件實例
        $file = $request->file('pic');
        // 獲取文件的二進制內容
        $pic = $file->get();


        $this->model->forumMes($sid,$uid,$title,$content,$pic);

        return redirect("/forumIndex");
        // return $pic;
    }

}