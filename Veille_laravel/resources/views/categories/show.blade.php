@extends('layout.main')
@section('main')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1>{{$category->name}}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">{{$category->name}}</li>
                </ol>
            </div>
        </div>
        </div><!-- /.container-fluid -->
    </section>

  <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header d-flex">
                <button type="button" class="btn btn-block btn-outline-primary btn-lg mr-2" data-toggle="modal" data-target="#exampleModal" >Ajouter une source</button>
                <button type="button" class="btn btn-block btn-outline-danger btn-lg" data-toggle="modal" data-target="#modalSupp" style="margin-top: 0;">Supprimer une source</button>
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">{{$category->name}}</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('categories.storeflux', $category->id)}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Nom du flux</label>
                                <input name="name" type="text" class="form-control" id="recipient-name">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Url du flux</label>
                                <input name="flux" type="text" class="form-control" id="recipient-name">
                            </div>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </form>
                    </div>
                  </div>
                </div>
            </div> 
            <div class="modal fade" id="modalSupp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">{{$category->name}}</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('categories.destroysource')}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Url du flux</label>
                                <select name="flux_id" id="parent-category" class="form-control">
                                    @foreach ($category->flux as $flux)
                                        <option value="{{$flux->id}}">{{$flux->flux}}</option>      
                                    @endforeach
                                </select>
                            </div>
                            {{-- <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Url du flux</label>
                                <input name="flux" type="text" class="form-control" id="recipient-name">
                            </div> --}}
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </div>
                  </div>
                </div>
            </div>
        </div> 
        @if (empty($items))
            <p>Aucun flux RSS trouvé pour cette catégorie.</p>
        @else
          
            @foreach ($items as $item)
                <div class="callout callout-info">
                    @php
                        $enclosure = $item->get_enclosure(0); // Récupère la première enclosure
                        $image_url = null;
                        if ($enclosure && $enclosure->get_type() === 'image/jpeg') { // Vérifie si l'enclosure est une image JPEG
                            $image_url = $enclosure->get_link();
                        }
                    @endphp

                    @if ($image_url)
                        <img src="{{ $image_url }}" alt="Image">
                    @else
                        <a style="color: blue; text-decoration: none;" href="{{$item->get_permalink()}}"  target="_blank"><h5>{{$item->get_title()}}</h5></a>
                        <p>{{$item->get_date()}}</p>
                        <p>{{strip_tags($item->get_description())}}</p>
                    @endif
                </div>
            @endforeach
        @endif
    </section>
</div>
@endsection
@section('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });

        $('#exampleModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var recipient = button.data('whatever'); // Extract info from data-* attributes
        //     // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        //     // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this);
            modal.find('.modal-title').text('Nom de la catégorie');
            modal.find('.modal-body input').val(recipient);
        });
        $('#modalSupp').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var recipient = button.data('whatever'); // Extract info from data-* attributes
        //     // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        //     // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this);
            modal.find('.modal-title').text('Nom de la catégorie');
            modal.find('.modal-body input').val(recipient);
        });
    </script>
@endsection