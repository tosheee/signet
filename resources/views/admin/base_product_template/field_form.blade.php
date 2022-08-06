@if(isset($adminCategories))
    <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
        <label>
            <span>Categories: </span>
            <select class="form-control" name="category_id" id="select-category">
                <option value="">Choose </option>
                @foreach($categories as $category)
                    @if (isset($baseProductTemplate) && $baseProductTemplate->category_id == $category->id )
                        <option selected="selected" value="{{ $category->id }}">{{ isset($category->name) ?  $category->name : '' }}</option>
                    @else
                        <option value="{{ $category->id }}">{{ isset($category->name) ?  $category->name : ''  }}</option>
                    @endif
                @endforeach
            </select>
        </label>
    </div>
@endif

@if(isset($baseProductTemplate))
    <?php $content = json_decode($baseProductTemplate->content, true); ?>
@endif

<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label for="name" class="col-md-4 control-label">Name</label>

    <div class="col-md-6">
        <input id="name" type="text" class="form-control" name="name" value="{{$content['name'] ?? ''}}" required autofocus>
        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
</div>

<label>
    <span style="margin: 0;">Active: </span>
    @if (isset($baseProductTemplate))
        <input type="radio" name="active" value="1" {{ $baseProductTemplate->active == 1 ? 'checked' : '' }}> Yes
        <input type="radio" name="active" value="0" {{ $baseProductTemplate->active == 1 ? '' : 'checked' }}> No
    @else
        <input type="radio" name="active" value="1" checked> Yes
        <input type="radio" name="active" value="0"> No
    @endif
</label>

@include('admin.admin_partials.images_box')
