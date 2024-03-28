@extends('layout.main')
@section('main')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Acceuil</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-body">
          @if (empty($items))
              <p>Aucun flux RSS trouvé pour cette catégorie.</p>
          @else
            
              @foreach ($items as $item)
                  <div class="callout callout-info">
                    <a class="visited-link" style="color: blue; text-decoration: none; " href="{{$item->get_permalink()}}" target="_blank"><h5>{{$item->get_title()}}</h5></a>
                    <p>{{$item->get_date()}}</p>
                    <p>{{strip_tags($item->get_description())}}</p>
                  </div>
              @endforeach
          @endif
        </div>
      </div>
    </section>
</div>
@endsection
@section('scripts')

    
@endsection
