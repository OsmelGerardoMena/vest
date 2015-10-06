@extends('layout')

@section('title')
    @lang('dashboard.title_my_products')
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
                    @lang('dashboard.title_my_products')
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
                                        @can('seller')
                                            <div class="toolbar-btn-action">
                                                <a class="btn btn-primary" href="{{route('dashboard.myproducts.unallocated')}}">
                                                    <i class="fa fa-unlink"></i>
                                                    @lang('dashboard.buttons.unallocated')
                                                </a>
                                            </div>
                                        @endcan
                                        @include('dashboard.myproducts.partials.search')
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table data-sortable class="table table-hover table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>@lang('dashboard.table.name')</th>
                                        <th>@lang('dashboard.table.price')</th>
                                        <th>@lang('dashboard.table.url')</th>
                                        <th>@lang('dashboard.table.company')</th>
                                        @can('seller')
                                            <th>@lang('dashboard.table.link_status')</th>
                                        @else
                                            <th>@lang('dashboard.table.status')</th>
                                        @endcan
                                        <th>@lang('dashboard.table.actions')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td><a href="{{ $product->url }}" target="_blank">{{ $product->url }}</a></td>
                                            <td>{{ $product->company->name }}</td>
                                            @can('seller')
                                                <td><span class="{{ ($product->getLinkStatus()) ? 'label label-success' : 'label label-danger'}}">
                                                @lang('dashboard.link_status.'.$product->getLinkStatus())
                                                </span></td>
                                            @else
                                                <td><span class="{{ ($product->isActive()) ? 'label label-success' : 'label label-danger'}}">
                                                @lang('dashboard.status.'.$product->getStatusId())
                                                </span></td>
                                            @endcan
                                            <td>
                                                <div class="btn-group btn-group-xs">
                                                    <a data-toggle="tooltip" title="@lang('dashboard.buttons.info')" class="btn btn-info"
                                                       href="{{route('dashboard.myproducts.show', $product->id)}}">
                                                        <i class="fa fa-info-circle"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table> <!-- appends para que se mantenga la busqueda en las demas paginas -->
                                {!! $products->appends(Request::only(['nameproduct']))->render() !!}
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