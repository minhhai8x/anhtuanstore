<div class="left-sidebar">
    <h2>Category</h2>
    <div class="panel-group category-products" id="accordian">
        <!--category-products-->
        @foreach($listCate as $cate)
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a href="{{ route('categories', ['locale' => app()->getLocale(), 'cid' => $cate->id]) }}">{{ $cate->name }}</a></h4>
            </div>
        </div>
        @endforeach
    </div>
    <!--/category-products-->

    <div class="shipping text-center">
        <!--shipping-->
        <img src="{{ asset('layouts/images') }}/home/shipping.jpg" alt="" />
    </div>
    <!--/shipping-->

</div>
