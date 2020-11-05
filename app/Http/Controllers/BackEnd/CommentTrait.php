<?php
namespace App\Http\Controllers\BackEnd;
use App\Http\Requests\BackEnd\Comments\Store;
use App\Models\Comment;

trait CommentTrait{

    public function commentStore(Store $request){
        $requestArray= $request->all() + ['user_id'=>auth()->user()->id];
        Comment::create($requestArray);
        return redirect()->route('videos.edit',['id'=>$requestArray['video_id'],'#comments']);
    }

  public function commentDelete($id){
        $row= Comment::FindOrFail($id);
        $row->delete();
        return redirect()->route('videos.edit',['id'=>$row->video_id,'#comments']);
    }

  public function commentUpdate($id,Store $request){
        $row= Comment::FindOrFail($id);
        $row->update($request->all());
        return redirect()->route('videos.edit',['id'=>$row->video_id,'#comments']);
    }



}
