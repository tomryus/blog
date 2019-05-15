@extends('layouts.backend')
@push('customcss')
<script src={{ asset("plugins/datatables/dataTables.bootstrap.css") }}></script>
@endpush
  @section('title','Tabel Category')
  @section('page-title','List Category')
  @section('content')
  <!-- Default box -->
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Data Table With Full Features</h3>
          <br>
      <button class="btn btn-light "><a href={{route('category.index')}}>Kembali </a></button><br>
       @if(session('status'))
      <div class="alert alert-success btn-sm alert-small" >
            {{session('status')}}
      </div>
    @endif
      
    </div>
    <!-- /.box-header -->

    <div class="box-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Nomor</th>
            <th>Nama Category</th>
            <th>Slug</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            ?>
            @foreach ($yangdikirim as $item)
        <tr>
            <td>{{$no}}</td>
            <td>{{$item->category_name}}</td>
            <td>{{$item->slug}}</td>
            <td>
                <a href={{route('category.restore',$item->id)}} class="btn btn-info btn-sm"> Restore</a>
                <a href="javascript:void(0)" onclick="$(this).find('form').submit()" class="btn btn-danger btn-sm">Delete
                  <form method="POST" action={{route('category.deletePermanent',$item->id) }}  onsubmit="return confirm('Delete this category permanently?')"
                </a>
                @csrf
                @method('DELETE')
              </form>
            </td>
            <?php
            $no++;
            ?>
            @endforeach
        </tr>
        </tbody>
        

      </table>
    </div>
    <!-- /.box-body -->
  </div>
    <!-- /.box -->
  @push('datatables')
  <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables/datatables.bootstrap.min.js') }}"></script>
  @endpush
  @push('customdatatables')
  <script>
    $(function () {
      $('#example1').DataTable()
      $('#example2').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false
      })
    })
  </script>
  @endpush
  @endsection