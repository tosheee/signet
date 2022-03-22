<style>
.classes-filters {
  padding: 0.0rem 0.0rem 0.0rem 0.0rem;
  background-color: #fefefe;
  margin-top: 2rem;
}

.classes-filters ul li{
  list-style:none;
}
.classes-filters label {
  color: #8a8a8a;
}

.classes-filters .menu.nested {
  margin-left: 0rem;
  margin-bottom: 0.9rem;
}

.classes-filters .menu > li > a {
  padding-left: 0;
  color: #4a4a4a;
  font-size: 0.85rem;
  font-weight: 600;
}

.classes-filters .is-accordion-submenu-parent > a::after {
  border-color: #cacaca transparent transparent;
}

.classes-filters .clear-all {
  font-size: 0.9rem;
  color: #cacaca;
}

.classes-filters .more {
  color: #1779ba;
  font-size: 0.9rem;
  cursor: pointer;
}

.classes-filters-header {
  font-size: 1.25rem;
  padding-top: 0.5rem;
}

.classes-filters-tab {
  border-top: 1px solid #e6e6e6;
}

.classes-filters-tab:last-child() {
  border-bottom: 1px solid #e6e6e6;
}

.mobile-classes-filters {
  border-bottom: 1px solid #e6e6e6;
}



</style>

    <div id="sidebar">
        <div class="classes-filters">
            <?php $paramOfUrl = explode('=', Request::fullUrl()) ?>
            @if(isset($categories))
                <ul class="mobile-classes-filters vertical menu show-for-small-only" data-accordion-menu>
                    <?php $idxCss = 0; ?>
                    @foreach($categories as $category)
                        @if($category_id == $category->id && isset($category->filters))
                            <li class="">
                                <form action="/store/search/{{$category->name}}" method="get">
                                    <input type="submit" class="btn btn-block col-8"  value="Филтрирай: {{$category->name or ''}}">
                                    <?php $jsonFilters = json_decode($category->filters, true)?>
                                    <ul class="vertical menu" data-accordion-menu>
                                        @foreach($jsonFilters as $key => $filters)
                                            <li class="classes-filters-tab">
                                                <h5>{{$filters['key']}}</h5>
                                                <ul class="categories-menu menu vertical nested is-active">
                                                    <a href="#" class="clear-all" id="grades-clear-all">Clear All</a>
                                                    @foreach($filters['values'] as $iKey1 =>$filter)
                                                        <?php //dd($f)?>
                                                        @foreach($filter as $iKey2 => $fill)
                                                            <?php $idxCss++;?>
                                                            <li>
                                                                <input name="{{$iKey2}}", class="grades-clear-selection" id="grades-checkbox{{$idxCss}}" type="checkbox">
                                                                <label for="grades-checkbox{{$idxCss}}">{{ $fill }}</label>
                                                            </li>
                                                        @endforeach
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endforeach
                                    </li>
                                <input type="submit" class="btn btn-block col-8"  value="Филтрирай: {{$category->name}}">
                            @endif
                        @endforeach
                    </ul>
                </form>
            @endif
        </div>

        <script>
            $('#btn').click(function(e) {
                e.preventDefault();
                $('input[type=checkbox]:checked').each(function () {
                    var status = (this.checked ? $(this).val() : "");
                    console.log(status);
                    var id = $(this).attr("id");
                    $('#output').append("<h3>" + id + " : " + status + "</h3>");
                });
            });
        </script>
    </div>
