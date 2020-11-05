@extends(' back-end.layout.app')

@section('title')
    {{$pageTitle}}
@endsection


@section('content')
    @component('back-end.layout.header')
        @slot('nav_title')
            {{$pageTitle}}
        @endslot
    @endcomponent

    @component('back-end.shared.table' ,['pageTitle'=>$pageTitle,'pageDes'=>$pageDes])
       @slot('addButton')
         <div class="col-md-4 text-right">
             <a href="{{ route($routeName.'.create')}}" class="btn btn-white btn-round">Add
             {{$smoduleName}}</a>
         </div>
       @endslot
                       <div class="table-responsive">
                           <table class="table">
                               <thead class=" text-primary">
                               <th>
                                   <h4><big><i>ID</i></big></h4>
                               </th>
                               <th>
                                   <h4><big><i> Name </i></big></h4>
                               </th>
                               <th>
                                   <h4><big><i> Email </i></big></h4>
                               </th>
                               <th>
                                   <h4><big><i> Group </i></big></h4>
                               </th>
                               <th class="text-right">
                                   <h4 ><big><i> Control </i></big></h4>
                               </th>
                               </thead>
                               @foreach($rows as $row)
                                   <tr>
                                       <td>
                                           {{$row->id}}
                                       </td>
                                       <td>
                                           {{$row->name}}
                                       </td>
                                       <td>
                                           {{$row->email}}
                                       </td>
                                       <td>
                                           {{$row->group}}
                                       </td>
                                       <td class="td-actions text-right">
                                          @include('back-end.shared.buttons.edit')
                                          @include('back-end.shared.buttons.delete')
                                       </td>
                                   </tr>

                               @endforeach
                               <tbody>
                               </tbody>
                           </table>
                           {!! $rows->links() !!}
                       </div>

    @endcomponent
@endsection
