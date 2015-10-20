@extends('layout')

@section('title')
    @lang('dashboard.title_company_categories')
@stop

@section('content')

@include('partials/modal')

@foreach($categories as $category)
    @include('dashboard.companycategories.partials.modal')
@endforeach

<!-- Begin page -->
<div id="wrapper">
    @include('partials/topbar')
    @include('partials/sidebar')

    <!-- Start right content -->
    <div class="content-page">

        <!-- Start Content here -->
        <div class="content">
            <div class="page-heading">
                <h1><i class='glyphicon glyphicon-tags'></i> 
                    @lang('dashboard.title_company_categories')
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
                                            <a class="btn btn-success" href="{{route('dashboard.company-categories.create')}}">
                                                <i class="fa fa-plus-circle"></i>
                                                @lang('dashboard.buttons.new')
                                            </a>
                                        </div>
                                        @include('dashboard.companycategories.partials.search')
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table data-sortable class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>@lang('dashboard.table.name')</th>
                                            <th>@lang('dashboard.table.actions')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($categories as $category)
                                        <tr>
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>
                                                <div class="btn-group btn-group-xs">
                                                    <a data-toggle="tooltip" title="@lang('dashboard.buttons.edit')" class="btn btn-warning" 
                                                        href="{{route('dashboard.company-categories.edit', $category->id)}}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a title="@lang('dashboard.buttons.delete')" data-modal="delete-modal-{{$category->id}}" class="btn btn-danger md-trigger ">
                                                        <i class="fa fa-trash-o"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table> <!-- appends para que se mantenga la busqueda en las demas paginas -->
                                {!! $categories->appends(Request::only('name'))->render() !!}
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