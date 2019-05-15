@extends('layouts.backend')
@push('customcss')
<script src={{ asset("plugins/datatables/dataTables.bootstrap.css") }}>
  
</script>
@endpush
  @section('title','Article')
  @section('page-title','List Article')
  @section('content')
  <!-- Default box -->
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Data article</h3>
      <button class="btn btn-danger pull-right"><a href={{route('article.trash')}}>Trash Data </a></button>
      <br>
      <button class="btn btn-light "><a href={{route('article.create')}}>Tambah Data </a></button>
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
            <th>Judul</th>
            <th>Thumbnail</th>
            <th>Category</th>
            <th>Short Description</th>
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
            <td>{{$item->title}}</td>
            <td>@if($item->thumbnail)
                <img src="{{asset('storage/images/article/' .$item->thumbnail)}}" width="96px">
              @endif
            </td>
            <td>{{$item->category->category_name}}</td>
            <td>{{$item->short_description}}</td>
            <td>
                  <a href={{route('article.edit',$item->id)}} class="btn btn-info btn-sm"> Edit</a>
                  <a href="javascript:void(0)" onclick="$(this).find('form').submit()" class="btn btn-danger btn-sm">Delete
                  <form method="POST" action={{route('article.destroy',$item->id) }}  onsubmit="return confirm('Delete this article permanently?')"
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