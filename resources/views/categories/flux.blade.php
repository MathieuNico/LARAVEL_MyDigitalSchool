{{-- @foreach ($categories as $category)
    @foreach ($category->flux as $flux) --}}

@extends('layout.main')
@section('main')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Mes Flux RSS</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Acceuil</a></li>
                <li class="breadcrumb-item active">Flux</li>
            </ol>
            </div>
        </div>
        </div><!-- /.container-fluid -->
    </section>

  <!-- Main content -->
    <section class="content">
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane active" id="timeline">
                    @foreach($category as $categori)
                        <div class="timeline timeline-inverse">
                            <div class="time-label">
                                <span class="bg-primary">
                                   {{$categori->name}} 
                                </span>
                            </div>
                            <div>
                                @foreach($categori->flux as $flux)
                                    <i class="fas fa-rss bg-success"></i>
                                    <div class="timeline-item mt-2 d-flex align-items-center" >
                                        <h3 class="timeline-header border-0"><p style="margin-bottom: 0;">{{$flux->flux}}</p>
                                        </h3>
                                        <form action="{{route('categories.destroysourcebyId', $flux->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm btn-delete"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach         
                </div>
            </div>        
        </div>   
    </section>  
</div>
@endsection