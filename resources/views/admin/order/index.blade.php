@extends('admin.master')

@section('content')
<!-- Content Header -->
<section class="content-header">
    <h1>
        Orders
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="#">Orders</a></li>
        <li class="active">List</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <div class="row">
                <div class="col-sm-12">
                    <table id="myTable" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                        <thead>
                            <tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">ID</th>
                                <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="">Customer name</th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Total</th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Note</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($listBill) && count($listBill) > 0) @foreach($listBill as $bill)
                            <tr role="row" class="odd">
                                <td>{{ $bill->id }}</td>
                                <td>{{ $bill->name }}</td>
                                <td>{{ $bill->total }}</td>
                                <td>{{ $bill->note }}</td>
                            </tr>
                            @endforeach @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.box -->

</section>
<!-- /.content -->
@endsection
