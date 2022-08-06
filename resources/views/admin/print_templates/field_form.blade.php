 @if(isset($categories))
        <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
            <label>
                <span>Category:<sup style="color: red;">*</sup></span>
                <select class="form-control" name="category_id" id="select-category">
                    <option value="">Избери категория</option>
                    @foreach($categories as $category)
                        @if (isset($printTemplate) && $printTemplate->category_id == $category->id )
                            <option selected="selected" value="{{ $category->id }}">{{ isset($category->name) ?  $category->name : '' }}</option>
                        @else
                            <option value="{{ $category->id }}">{{ isset($category->name) ?  $category->name : ''  }}</option>
                        @endif
                    @endforeach
                </select>
            </label>
        </div>
    @endif

    @if(isset($subCategories))
        <div class="form-group{{ $errors->has('sub_category_id') ? ' has-error' : '' }}">
            <label>
                <span>Subcategory:<sup style="color: red;">*</sup></span>
                <select class="form-control" name="sub_category_id" id="select-category">
                    <option value="">Избери категория</option>
                    @foreach($sub_categories as $sub_category)
                        @if (isset($printTemplate) && $printTemplate->sub_category_id == $sub_category->id )
                            <option selected="selected" value="{{ $sub_category->id }}">{{ isset($sub_category->name) ?  $sub_category->name : '' }}</option>
                        @else
                            <option value="{{ $sub_category->id }}">{{ isset($sub_category->name) ?  $sub_category->name : ''  }}</option>
                        @endif
                    @endforeach
                </select>
            </label>
        </div>
    @endif

    @if(isset($typePrintTemplates))
        <div class="form-group{{ $errors->has('type_print_template_id') ? ' has-error' : '' }}">
            <label>
                <span>Theme:<sup style="color: red;">*</sup></span>

                <select class="form-control" name="type_print_template_id" id="type_print_template" required="required"  oninvalid="this.setCustomValidity('Please enter type!')" oninput="setCustomValidity('')">
                    <option value="">Choose</option>
                    @foreach($typePrintTemplates as $typePrintTemplate)
                        @if (isset($printTemplate) && $printTemplate->type_print_template_id == $typePrintTemplate->id )
                            <option selected="selected" value="{{ $typePrintTemplate->id }}">{{ isset($typePrintTemplate->name) ?  $typePrintTemplate->name : '' }}</option>
                        @else
                            <option value="{{ $typePrintTemplate->id }}">{{ $typePrintTemplate->name }}</option>
                        @endif
                    @endforeach
                </select>
            </label>
        </div>
    @endif

    @if(isset($printTemplate))
        <?php $content = json_decode($printTemplate->content, true); ?>
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
        @if (isset($printTemplate))
            <input type="radio" name="active" value="1" {{ $printTemplate->active == 1 ? 'checked' : '' }}> Yes
            <input type="radio" name="active" value="0" {{ $printTemplate->active == 1 ? '' : 'checked' }}> No
        @else
            <input type="radio" name="active" value="1" checked> Yes
            <input type="radio" name="active" value="0"> No
        @endif
    </label>
    <br>

    @include('admin.admin_partials.images_box')
