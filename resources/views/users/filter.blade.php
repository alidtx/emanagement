{{ Form::model($_REQUEST, ['method' => 'get']) }}
<div class="row col-md-12">
    <div class="col-md-4 mb-3">
        <label class="form-label" for="basic-default-user_id">Users</label>
        {!! Form::select('user_id', $userDropdown, request('user_id'), [
            'placeholder' => 'Please Select Users',
            'id' => 'user_id',
            'class' => 'form-control select2',
        ]) !!}
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label" for="basic-default-email">Email</label>
        {!! Form::text('email', request('email'), [
            'placeholder' => 'Search Email',
            'id' => 'email',
            'class' => 'form-control',
        ]) !!}
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label" for="basic-default-phone">Phone</label>
        {!! Form::text('phone', request('phone'), [
            'placeholder' => 'Search Phone',
            'id' => 'phone',
            'class' => 'form-control',
        ]) !!}
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label" for="basic-default-user_id">User Type</label>
        {!! Form::select('user_type', config('constants.user_type'), request('user_type'), [
            'placeholder' => 'Please Select',
            'id' => 'user_type',
            'class' => 'form-control select2',
        ]) !!}
    </div>
</div>
<button type="submit" class="btn btn-primary"> <i class="fa fa-search"></i> Search</button>
<a href="{{ url()->current() }}" class="btn btn-danger"> <i class="fa-solid fa-arrows-rotate"></i> Reset</a>
{!! Form::close() !!}
