<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Requests\Backend\Skills\store;
use App\Models\Skill;

class Skills extends BackEndController
{

    public function __construct(Skill $model)
    {
        parent::__construct($model);
    }

    public function store(Store $request){
        $this->model->create($request->all());
        return redirect()->route('skills.index');
       // return redirect('admin/categories ');
    }

    public function update($id , Store $request){
        $row= $this->model->FindOrFail($id);
        $row->update($request->all());
        return redirect()->route('skills.index' , ['id'=> $row->id]);
        //return redirect('admin/users ');

    }

}
