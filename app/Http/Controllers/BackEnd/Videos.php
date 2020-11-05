<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Requests\BackEnd\Videos\Store;
use App\Http\Requests\BackEnd\Videos\Update;
use App\Models\Category;
use App\Models\Skill;
use App\Models\Tag;
use App\Models\Video;

class Videos extends BackEndController
{
    use CommentTrait;
    public function __construct(Video $model)
    {
        parent::__construct($model);
    }

    protected function with()
    {
        return ['cat' , 'user'];
    }

    protected function append()
    {
        $array= [
            'categories'=>Category::get(),
            'skills'=>Skill::get(),
            'tags'=>Tag::get(),
            'selectedTags'=> [],
            'selectedSkills'=> [],
            'comments'=> [],
        ];
   // الحاجات دى لما اعمل ايديت
        if(request()->route()->parameter('video')){
            $array['selectedSkills']=$this->model->find(request()->route()->parameter('video'))
                ->skills()->pluck('skills.id')->toArray();
            $array['selectedTags']=$this->model->find(request()->route()->parameter('video'))
                ->tags()->pluck('tags.id')->toArray();
            $array['comments']=$this->model->find(request()->route()->parameter('video'))
                ->comments()->orderBy('id','desc')->with('user')->get();
        }
        return $array;
    }
//    public function index(){
//        $rows =$this->model->with('user', 'cat');
//        $rows =$this->filter($rows);
//        $rows =$rows->paginate(10);
//
//        $moduleName =$this->pluralModelName();
//        $smoduleName =$this->getModelName();
//        $routeName=$this->getClassNameFromModel();
//        $pageTitle = "Control ".$moduleName;
//        $pageDes = "Here you can edit / add / delete ". $moduleName;
//
//        return view('back-end.'.$this->getClassNameFromModel() .'.index', compact(
//            'rows',
//            'pageTitle',
//            'moduleName',
//            'pageDes',
//            'smoduleName',
//            'routeName'
//        ));
//    }
//    public function create(){
//        $moduleName =$this->getModelName();
//        $pageTitle = "Create ".$moduleName;
//        $pageDes = "Here you can create ". $moduleName;
//        $folderName=$this->getClassNameFromModel();
//        $routeName=$folderName;
//        $categories=Category::get();
//
//
//        return view('back-end.'.$folderName.'.create',compact(
//            'pageTitle',
//            'moduleName',
//            'pageDes',
//            'folderName',
//            'routeName',
//            'categories'
//        ));
//    }
//    public function edit($id){
//        $row =$this->model::FindOrFail($id);
//        $moduleName =$this->getModelName();
//        $pageTitle ="Edit ".$moduleName;
//        $pageDes = "Here you can edit". $moduleName;
//        $folderName=$this->getClassNameFromModel();//users
//        $routeName=$folderName;
//        $categories=Category::get();
//
//
//        return view('back-end.'.$folderName.'.edit' ,compact('row',
//            'pageTitle',
//            'moduleName',
//            'pageDes',
//            'routeName',
//            'categories'
//        ));
//    }
    public function store(Store $request){
        $fileName=$this->uploadImage($request);
        $requestArray =['user_id'=>auth()->user()->id , 'image'=>$fileName] + $request->all()  ;
        $row=$this->model->create($requestArray);//هنا هو هيحط اليوزر ايدى بليوزر
        // ايدى اللى عامل لوج ان عندى
        $this->syncTagsSkills($row ,$requestArray);

        return redirect()->route('videos.index');
    }

    public function update($id ,Update $request){
        $requestArray=$request->all();
        if($request->hasFile('image')){
            $fileName=$this->uploadImage($request);
            $requestArray=['image'=>$fileName] + $requestArray;

        }

        $row= $this->model->FindOrFail($id);
        $row->update($requestArray);
        $this->syncTagsSkills($row ,$requestArray);

        return redirect()->route('videos.index' , ['id'=> $row->id]);
    }

    protected function syncTagsSkills($row , $requestArray){
        if (isset($requestArray['skills'])&& !empty($requestArray['skills'])){
            $row->skills()->sync($requestArray['skills']);
        }
        if (isset($requestArray['tags'])&& !empty($requestArray['tags'])){
            $row->tags()->sync($requestArray['tags']);
        }
    }

    protected function uploadImage($request){
        $file=$request->file('image');
        $fileName=time().str_random('10').'.'.$file->getClientOriginalExtension();
        $file->move(public_path('uploads'),$fileName);
        return $fileName;

    }
}
