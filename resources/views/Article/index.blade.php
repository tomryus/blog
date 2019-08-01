@extends('layouts.backend')
@push('customcss')
<script src={{ asset("plugins/datatables/dataTables.bootstrap.css") }}></script>
@endpush
@section('title','Article')
@section('page-title','List Article')
@section('content')
        @php
            $dt = new DateTime();
        @endphp
        
  <!-- Default box -->
  <div class="panel panel-headline">
      <div class="panel-heading">
          <h1>Article List</h1>
          <p class="panel-subtitle">
            @php
              echo $dt->format('Y-m-d H:i:s');
            @endphp
          </p>
      </div>
      <div class="panel-body">
          <div class="row">
              <div class="col md-9">
                <button type="button" class="btn btn-warning pull-right"><a href={{route('article.trash')}} >Trash Data </a></button>
                <button type="button" class="btn btn-info ">             <a href={{route('article.create')}}>Tambah Data </a></button>
                
                @if(session('status'))
                <div class="alert alert-success btn-sm alert-small" >
                      {{session('status')}}
                </div>
                @endif

              </div>
                  <div class="panel-body">
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
                              <td>
                                  @if($item->thumbnail)
                                  <img src="{{asset('storage/images/article/' .$item->thumbnail)}}" width="96px">
                                  @endif
                              </td>
                              <td>{{$item->category->category_name}}</td>
                              <td>{{$item->short_description}}</td>
                              <td>
                                    <a href={{route('article.edit',$item->id)}} class="btn btn-info btn-sm"><i class="lnr lnr-pencil"></i> Edit</a>
                                    <a href="javascript:void(0)" onclick="$(this).find('form').submit()" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> Delete
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
            </div>
        </div>
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