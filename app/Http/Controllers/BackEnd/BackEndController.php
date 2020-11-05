<?php
namespace App\Http\Controllers\BackEnd ;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;

class BackEndController extends Controller{
    protected $model;

    public function __construct( Model $model)
    {
        $this->model = $model;
    }

           // public function index1(){
          //        show all user are register in site and push date of var users in user.index blade
         //        $rows =User::paginate(10);
        //        return view('back-end.users.index1',compact('rows'));
       //    }
    public function index(){
        // show all user are register in site and push date of var users in user.index blade
       $rows =$this->model;
       $rows =$this->filter($rows);
       $with=$this->with();
       if(!empty($with))
       {
           $rows=$rows->with($with);
       }
       $rows =$rows->paginate(10);
        $moduleName =$this->pluralModelName();
        $smoduleName =$this->getModelName();
        $routeName=$this->getClassNameFromModel();
        $pageTitle = "Control ".$moduleName;
        $pageDes = "Here you can edit / add / delete ". $moduleName;

        return view('back-end.'.$this->getClassNameFromModel() .'.index', compact(
            'rows',
            'pageTitle',
            'moduleName',
            'pageDes',
            'smoduleName',
            'routeName'
        ));
    }

    public function create(){
        $moduleName =$this->getModelName();
        $pageTitle = "Create ".$moduleName;
        $pageDes = "Here you can create ". $moduleName;
        $folderName=$this->getClassNameFromModel();
        $routeName=$folderName;
        $append=$this->append();



        return view('back-end.'.$folderName.'.create',compact(
            'pageTitle',
            'moduleName',
            'pageDes',
            'folderName',
            'routeName'
        ))->with($append);
    }

    public function destroy ($id){
        $this->model->FindOrFail($id)->delete();
        //return redirect('admin/users ');
        return redirect()->route($this->getClassNameFromModel().'.index');
    }

    public function edit($id){
        $row =$this->model::FindOrFail($id);
        $moduleName =$this->getModelName();
        $pageTitle ="Edit ".$moduleName;
        $pageDes = "Here you can edit". $moduleName;
        $folderName=$this->getClassNameFromModel();//users
        $routeName=$folderName;
        $append=$this->append();

        return view('back-end.'.$folderName.'.edit' ,compact('row',
            'pageTitle',
            'moduleName',
            'pageDes',
            'routeName'
        ))->with($append);
    }
    protected function filter($rows){
        return $rows;
    }

    protected function getClassNameFromModel(){
        return strtolower($this->pluralModelName());
    }

    protected  function pluralModelName(){
        return str_plural($this->getModelName());
    }

    protected function getModelName(){
        return class_basename($this->model);
    }

    protected function with(){
        return [ ];
    }

    protected function append(){
        return [];
    }


}

