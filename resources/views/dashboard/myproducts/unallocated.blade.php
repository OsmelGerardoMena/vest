@extends('layout')

@section('title')
    @lang('dashboard.title_products_unallocated')
@stop

@section('content')

@include('partials/modal')

<!-- Begin page -->
<div id="wrapper">
    @include('partials/topbar')
    @include('partials/sidebar')
    <!-- Start right content -->
    <div class="content-page">
        <!-- Start Content here -->
        <div class="content">
            <div class="page-heading">
                <h1><i class='glyphicon glyphicon-th-list'></i>
                    @lang('dashboard.title_products_unallocated')
                </h1>
            </div>
            @include('dashboard.partials.messages')
            <div class="row">
                <div class="col-md-12">
                    <div class="widget">
                        <div class="widget-content">
                            <div class="data-table-toolbar">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="toolbar-btn-action">
                                            <a class="btn btn-primary" href="{{route('dashboard.my-products.index')}}">
                                                <i class="icon-back"></i>
                                                @lang('dashboard.buttons.back')
                                            </a>
                                        </div>
                                        @include('dashboard.myproducts.partials.search_unallocated')
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table data-sortable class="table table-hover table-striped">
                                    <thead>
                                    <tr>
                                        <th>@lang('dashboard.table.name')</th>
                                        <th>@lang('dashboard.table.price')</th>
                                        <th>@lang('dashboard.table.url')</th>
                                        <th>@lang('dashboard.table.company')</th>
                                        <th>@lang('dashboard.table.status')</th>
                                        <th>@lang('dashboard.table.actions')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td><a href="{{ $product->url }}" target="_blank">{{ $product->url }}</a></td>
                                            <td>{{ $product->company->name }}</td>
                                            <td><span class="{{ ($product->isActive()) ? 'label label-success' : 'label label-danger'}}">
                                                @lang('dashboard.status.'.$product->getStatusId())
                                            </span></td>
                                            <td>
                                                <div class="btn-group btn-group-xs">
                                                    <a data-toggle="tooltip" title="@lang('dashboard.buttons.info')" class="btn btn-info"
                                                       href="{{route('dashboard.my-products.show', $product->id)}}">
                                                        <i class="fa fa-info-circle"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table> <!-- appends para que se mantenga la busqueda en las demas paginas -->
                                {!! $products->appends(Request::only(['nameproduct', 'company']))->render() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End content here -->
    </div>
    <!-- End right content -->
</div>
<!-- End of page -->
@endsection