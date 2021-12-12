<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<div class="form-group col-sm-6">
    <label for="type">Type:</label>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="type" value="1" {{old('type') != 2 ? 'checked' : ''}}>
        <label class="form-check-label">Personal</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="type" value="2" {{old('type') == 2 ? 'checked' : ''}}>
        <label class="form-check-label">Project</label>
    </div>
</div>
