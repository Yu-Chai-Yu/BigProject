<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MyModel;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

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
        $uid = Auth::id();
        
        return view('forumIndex',[
            'forumNew2s' => $forumNew2s,
            'questions' => $questions,
            'groups' => $groups,
            'haters' => $haters,
            'uid' => $uid
        ]);
    }
    public function forumDetail(Request $request)
    {
        $sfid = $request->sfid;
        $foid = $request->foid;
        $articles = $this->model->forumDetail($sfid,$foid);
        $FCquestions = $this->model->FCquestion($foid);
        $forumNews = $this->model->forumNew($sfid);
        $uid = Auth::id();
        $userDatas = $this->model->feelComPN($uid);
        return view('forumDetail',[
            'articles' => $articles,
            'FCquestions' => $FCquestions,
            'forumNews' => $forumNews,
            'userDatas' => $userDatas,
            'sfid' => $sfid,
            'uid' => $uid,
            'foid'=> $foid
        ]);
    }

    public function forumCom(Request $request){
        $uid = $request->uid;
        $foid = $request->foid;
        $sfid = $request->sfid;
        $forumcom = $request->forumcom;
        // return [$uid,$foid,$sfid,$forumcom];
        $this->model->forumCom($uid,$sfid,$foid,$forumcom);
        return redirect("/forumDetail/{$sfid}/{$foid}");
    }


    public function forumMes(Request $request)
    {
        $uid = $request->uid;
        $title = $request->title;
        $content = $request->content;
        $sfid = $request->sfid;

        // 從請求中獲取文件實例
        $file = $request->file('pic');
        // 獲取文件的二進制內容
        $pic = $file->get();
        $this->model->forumMes($sfid,$uid,$title,$content,$pic);
        return redirect("/forumIndex");
        // return $pic;
    }

    public function forumSaved(Request $request)
    {
        $uid = $request->uid;
        $ftid = $request->ftid;
        $sfid = $request->sfid;
        $this->model->forumSaved($uid,$ftid);
        return redirect("/forumDetail/{$sfid}/{$ftid}");
        // return $sfid;

    }
    
    public function forumUnsaved(Request $request)
    {
        $uid = $request->uid;
        $ftid = $request->ftid;
        $sfid = $request->sfid;
        $this->model->forumUnsaved($uid,$ftid);
        return redirect("/forumDetail/{$sfid}/{$ftid}");
        // return $sfid;

    }


    public function forumMesSaved(Request $request)
    {
        $uid = $request->uid;
        $title = $request->title;
        $content = $request->content;
        $sfid = $request->sfid;

        // 從請求中獲取文件實例
        $file = $request->file('pic');
        // 獲取文件的二進制內容
        $pic = $file->get();
        $this->model->forumMesSaved($sfid,$uid,$title,$content,$pic);
        return redirect("/forumMes/{uid}");
        // return ;
    }
    
    

}