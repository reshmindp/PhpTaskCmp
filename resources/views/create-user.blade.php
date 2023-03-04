@extends('includes.header-footer')
@section('title','Dashboard')
@section('content')
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Create User</h1>
         
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="javascript:void(0);">Create User</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="tile">
            
            <div class="tile-body">
              <form method="POST" action="{{route('user.create')}}">
                @csrf
                <div class="form-group">
                  <label class="control-label">First Name</label>
                  {!!$errors->first('firstname', '<span style="color:red">:message</span>')!!}
                  <input class="form-control" value="{{old('firstname')}}" name="firstname" type="text" placeholder="Enter first name">
                </div>
                <div class="form-group">
                  <label class="control-label">Last Name</label>
                  {!!$errors->first('lastname', '<span style="color:red">:message</span>')!!}
                  <input class="form-control" value="{{old('lastname')}}" name="lastname" type="text" placeholder="Enter last name">
                </div>
                <div class="form-group">
                  <label class="control-label">Position</label>
                  {!!$errors->first('position', '<span style="color:red">:message</span>')!!}
                  <input class="form-control" value="{{old('position')}}" name="position" type="text" placeholder="Enter position">
                </div>
                <div class="form-group">
                  <label class="control-label">Password</label>
                  {!!$errors->first('password', '<span style="color:red">:message</span>')!!}
                  <input class="form-control" value="{{old('password')}}" name="password" type="password" placeholder="Enter position">
                </div>
                <div class="tile-footer">
                  <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Add</button>
                  @if(Session::has('success'))
                  <br><br>
                  <div style="color: green;">
                  <strong>Success! </strong>{{Session::get('success')}}</div>
                  @endif
                </div>
              </form>
            </div>
            
          </div>
        </div>
      </div>
    </main>
    @endsection
    