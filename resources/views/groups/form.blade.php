<div class="form-group @if($errors->has('title')) has-error @endif">
    <label class="col-xs-12">Title</label>
    <div class="col-sm-12">
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group @if($errors->has('description')) has-error @endif">
    <label class="col-xs-12">Description</label>
    <div class="col-sm-12">
        {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 3]) !!}
    </div>
</div>