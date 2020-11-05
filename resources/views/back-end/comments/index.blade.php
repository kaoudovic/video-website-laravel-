<table class="table" id='comments'>
  <tbody>
  @foreach( $comments as $comment)
     <tr>
         <td>
            <small>{{ $comment->user->name }}</small>
           <p style="margin-left: 12px">{{$comment->comment}} <small>{{ $comment->created_at}}</small></p>

         </td>
         <td class="td-actions text-right">
           <button type="button" onclick="$(this).closest('tr').next('tr').slideToggle()" rel="tooltip" class="btn btn-white btn-link btn-sm"
           data-original-title="Edit Comment">
             <i class="material-icons">edit</i>
           </button>
           <a  href="{{ route('comment.delete' , ['id'=>$comment->id])}}" type="button" rel="tooltip"
           data-original-title="Remove Comment"
           class="btn
           btn-white
           btn-link btn-sm">
             <i class="material-icons">close</i>
           </a>
         </td>
     </tr>
     <tr style="display:none">
       <td colspan="4">
         <form action="{{route('comment.update' ,['id'=>$comment->id])}}" method="post">
             {{csrf_field()}}
             @include('back-end.comments.form', ['row'=>$comment])

             <input type="hidden" value="{{$row->id}}" name=" video_id">
             <button type="submit" class="btn btn-primary pull-right" >
                 Update Comment
             </button>
             <div  class="clearfix"></div>
         </form>

       </td>

     </tr>
   @endforeach
  </tbody>
</table>
