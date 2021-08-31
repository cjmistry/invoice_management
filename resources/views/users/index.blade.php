@extends('layouts.app')


@section('content')
<div class="box-content">

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Users Management</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif


<table id="example" class="table table-striped table-bordered display" style="width:100%">
 <tr>
   <th>No</th>
   <th>Name</th>
   <th>Email</th>
   <th>Roles</th>
    @php $role = Auth::user()->roles->pluck('name');@endphp
    @if(!empty($role) && $role[0] == 'SuperAdmin')
   <th>Status</th>
   @endif
   <th width="280px">Action</th>
 </tr>
 @foreach ($data as $key => $user)
  <tr>
    <td>{{ ++$i }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>
      @if(!empty($user->getRoleNames()))
        @foreach($user->getRoleNames() as $v)
           <label class="badge badge-success" style="color:black;">{{ $v }}</label>
        @endforeach
      @endif
    </td>
     @if(!empty($role) && $role[0] == 'SuperAdmin')
    <td>
        @if($user->user_status == 1)
            <input type="checkbox" name="status" checked="checked">Status
        @else
        <input type="checkbox" name="status" >Status
        @endif
    </td>
    @endif
    <td>
        @if($user->id != 1)

       <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
        {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
        @endif
    </td>
  </tr>
 @endforeach
</table>


{!! $data->render() !!}

</div>
@endsection
