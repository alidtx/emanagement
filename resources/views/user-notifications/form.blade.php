<div class="row mb-3">
    <label class="col-sm-2 col-form-label required" for="title">Message Title</label>
    <div class="col-sm-10">
        {!! Form::text('title', null, ['placeholder' => 'English Name Add Here', 'id' => 'name', 'class' => 'form-control']) !!}
    </div>
</div>
<div class="row mb-3">
    <label class="col-sm-2 col-form-label required" for="description">Message Body</label>
    <div class="col-sm-10">
        {!! Form::textarea('body', null, [
            'placeholder' => 'Message Description Add Here',
            'rows' => 3,
            'class' => 'form-control',
        ]) !!}
    </div>
</div>
