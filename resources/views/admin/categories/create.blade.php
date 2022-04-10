@extends('layouts.app')

@section('content')
    @include('admin.admin_partials.admin_menu')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Създаване на категория</div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('categories.store') }}">

                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Име на категория</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" required autofocus>

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
                                    <input id="identifier" type="text" class="form-control" name="identifier" required autofocus>

                                    @if ($errors->has('identifier'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('identifier') }}</strong>
                                    </span>
                                    @endif
                                </div>


                            </div>

                            <div class="specification_fields_wrap">
                                <button class="add_name_filter_field_button btn-primary btn-xs">Add name filter</button>
                            </div>



                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Запис
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        // specification
        $(document).ready(function() {
            var max_fields      = 20; //maximum input boxes allowed
            var wrapper         = $(".specification_fields_wrap"); //Fields wrapper
            var add_name_filter_button      = $(".add_name_filter_field_button"); //Add button ID
            var x = 0; //initlal text box count


            $(add_name_filter_button).click(function(e){ //on add input button click
                e.preventDefault();
                if(x < max_fields){ //max input box allowed

                    $(wrapper).append(
                            '<hr><div class="fields" ><label> ' +
                            'Name: <input style="width: 200px" type="text" name="filters[][name_filter]" id="admin_product_description" class="label-names"> ' +
                            '<button class="add_filter_field_button btn-primary btn-xs">Add filter</button> ' +
                            '<a href="#" class="remove_field"> <i style="color: red;" aria-hidden="true" id="chang-menu-icon" class="fa fa-times"></i></a> ' +
                            '</label><div class="filter_wrap"></div></div> '); //add input box
                }
                x++; //text box increment
            });

            $(wrapper).on("click", ".remove_field", function(e){ //user click on remove text
                e.preventDefault();
                $(this).parent('div.fields label').remove();
                x--;
            });

            $(wrapper).on("click", ".add_filter_field_button", function(e){ //user click on remove text
                e.preventDefault();
                $(this).parent().parent().find(".filter_wrap").append(
                        '<div class="fields" ><label> Filters fields: ' +
                        '<input type="text" name="" id="admin_product_description" class="label-names" style="width: 200px"> ' +
                        '<input type="text" name="" id="admin_product_description" class="label-values"> ' +
                        '<a href="#" class="remove_field"><i style="color: red;" aria-hidden="true" id="chang-menu-icon" class="fa fa-times"></i></a> ' +
                        '</label></div> '); //add input box
            });

        });

    </script>



    @include('admin.admin_partials.admin_menu_bottom')
@endsection
