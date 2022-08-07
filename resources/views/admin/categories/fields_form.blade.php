@if(isset($category))
    <?php $content = json_decode($category->content, true); ?>
@endif
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="col-md-4 control-label">Name</label>

        <div class="col-md-6">
            <input id="name" type="text" class="form-control" name="name" value="{{ $category->name ?? '' }}" required autofocus>
            @if ($errors->has('name'))
                <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('identifier') ? ' has-error' : '' }}">
        <label for="name" class="col-md-4 control-label">Identifier</label>
        <div class="col-md-6">
            <input id="identifier" type="text" class="form-control" name="identifier" value="{{ $category->identifier ?? ''}}" required autofocus>
            @if ($errors->has('identifier'))
                <span class="help-block">
                <strong>{{ $errors->first('identifier') }}</strong>
            </span>
            @endif
        </div>
    </div>

    @include('admin.admin_partials.images_box')

    <div id="jsoneditor" style="height: 400px;"></div>
    <input type="hidden" name="filters" id="json-data-filter">
