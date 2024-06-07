<div class="row mb-3">
    <label class="col-sm-2 col-form-label required" for="project_name">Project Name</label>
    <div class="col-sm-10">
        {!! Form::text('project_name', $project_name ?? null, [
            'placeholder' => 'Project Name',
            'id' => 'progress',
            'class' => 'form-control',
        ]) !!}
    </div>
</div>
@isset($site_logo)
    <div class="row mb-3">
        <label class="col-sm-2 col-form-label required" for="site_logo"> Upload Site Logo</label>
        <div class="col-sm-10">
            <img src="{{ asset('storage/' . $site_logo) }}" alt="Site Logo" width="150px" height="150px">
        </div>
    </div>
@endisset
<div class="row mb-3">
    <label class="col-sm-2 col-form-label" for="site_logo">Upload Site Logo (Only PNG)</label>
    <div class="col-sm-10">
        {!! Form::file('site_logo', [
            'placeholder' => 'Upload Site Logo',
            'id' => 'site_logo',
            'class' => 'form-control',
            'accept' => 'image',
        ]) !!}
    </div>
</div>
@isset($fevicon)
    <div class="row mb-3">
        <label class="col-sm-2 col-form-label required" for="fevicon"> Upload Fevicon Logo</label>
        <div class="col-sm-10">
            <img src="{{ asset('storage/' . $fevicon) }}" alt="Fevicon Logo" width="150px" height="150px">
        </div>
    </div>
@endisset
<div class="row mb-3">
    <label class="col-sm-2 col-form-label" for="fevicon">Upload Fevicon Logo</label>
    <div class="col-sm-10">
        {!! Form::file('fevicon', [
            'placeholder' => 'Upload Fevicon Logo',
            'id' => 'fevicon',
            'class' => 'form-control',
            'accept' => 'image',
        ]) !!}
    </div>
</div>
<hr>
<strong>SMS Gateway</strong>
<div class="row mb-3">
    <label class="col-sm-2 col-form-label" for="sms_api_key">SMS API Key</label>
    <div class="col-sm-10">
        {!! Form::text('sms_api_key', $sms_api_key ?? null, [
            'placeholder' => 'API KEY',
            'id' => 'sms_api_key',
            'class' => 'form-control',
        ]) !!}
    </div>
</div>
<div class="row mb-3">
    <label class="col-sm-2 col-form-label" for="sms_sid">SMS SID</label>
    <div class="col-sm-10">
        {!! Form::text('sms_sid', $sms_sid ?? null, [
            'placeholder' => 'SMS SID',
            'id' => 'sms_sid',
            'class' => 'form-control',
        ]) !!}
    </div>
</div>
<div class="row mb-3">
    <label class="col-sm-2 col-form-label" for="sms_url">SMS URL</label>
    <div class="col-sm-10">
        {!! Form::text('sms_url', $sms_url ?? null, [
            'placeholder' => 'SMS URL',
            'id' => 'sms_url',
            'class' => 'form-control',
        ]) !!}
    </div>
</div>
