@extends('layout.main')
@section('main')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1> Mes Catégories
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Acceuil</a></li>
                <li class="breadcrumb-item active">Catégories</li>
            </ol>
            </div>
        </div>
        </div><!-- /.container-fluid -->
    </section>

  <!-- Main content -->
    <section class="content">

    <!-- Default box -->
        <div class="card">
            <div class="card-header d-flex">
                <button type="button" class="btn btn-block btn-outline-primary btn-lg" data-toggle="modal" data-target="#exampleModal">Créer une catégorie</button>
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nom de la catégorie</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('categories.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Nom de la catégorie</label>
                                <input name="name" type="text" class="form-control" id="recipient-name">
                            </div>
                            <div class="form-group">
                                <label for="parent-category" class="col-form-label">Catégorie parent</label>
                                <select name="parent_id" id="parent-category" class="form-control">
                                    <option value="">Aucun parent</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-primary">Créer</button>
                        </form>
                    </div>
                    
                </div>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                        <tr>
                            <th style="width: 1%">
                                #
                            </th>
                            <th style="width: 50%">
                                Nom de catégorie
                            </th>
                            <th style="width: 49%" >
                                Nom de sous dossiers
                            </th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>
                                    {{$category->id}}
                                </td>
                                <td>
                                    <div class="d-inline-flex align-items-center">
                                        <form action="{{route('categories.update', $category->id)}}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="text" class="ml-1 category-name" name='name' value="{{ $category->name }}" disabled style="border: none;">
                                            <button type="submit" class="btn btn-success btn-sm btnvaliddoss mr-1" hidden><i class="fas fa-check"></i></button>
                                            <a class="btn btn-info btn-sm edit-category-btn mr-1"><i class="fas fa-pencil-alt"></i></a>
                                        </form>
                                        <form action="{{route('categories.index')}}" method="POST">
                                            @csrf
                                            @method('GET')
                                            <button type="submit" class="btn btn-danger btn-sm btn-cancel" hidden><i class="fas fa-times"></i></button>
                                        </form>
                                        <form  action="{{route('categories.destroy', $category->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm btn-delete"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                
                                </td>
                            
                                <td>
                                    <ul style="padding-left: 0;">
                                        @foreach($category->children as $child)
                                        <li style="list-style: none;">
                                            <div class="d-flex align-items-center">
                                                <form action="{{route('categories.update', $child->id)}}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="text" class="souscategory-name" name='name' value="{{$child->name}}" disabled style="border: none;">
                                                    <a class="btn btn-info btn-sm  btn-sousdoss mr-1"><i class="fas fa-pencil-alt"></i></a>
                                                    <button type="submit" class="btn btn-success btn-sm btn-validsousdoss mr-1" hidden><i class="fas fa-check"></i></button>
                                                </form> 
                                                <form action="{{route('categories.index')}}" method="POST">
                                                    @csrf
                                                    @method('GET')
                                                    <button type="submit" class="btn btn-danger btn-sm  btn-cancelsousdoss mr-1" hidden><i class="fas fa-times"></i></button>                                            
                                                </form>
                                                <form  action="{{route('categories.show', $child->id)}}" method="POST">
                                                    @csrf
                                                    @method('GET')
                                                    <button type="submit" class="btn btn-info btn-sm btn-show mr-1"><i class="fas fa-location-arrow"></i></a>
                                                </form>
                                                <form  action="{{route('categories.destroy', $child->id)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm btn-deletesousdoss"><i class="fas fa-trash"></i></a>
                                                </form>
                                            </div>
                                        </li> 
                                        @endforeach    
                                    </ul>
                                </td>    
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        <!-- /.card-body -->
        </div>
        <!-- /.card -->
        
            
        </div>
    </section>
</div>
@endsection
@section('scripts')
    <script>
        const buttonsModif = document.querySelectorAll('.edit-category-btn');
        const texts = document.querySelectorAll('.category-name');
        const buttonsValid = document.querySelectorAll('.btnvaliddoss');
        const buttonsDelete = document.querySelectorAll('.btn-delete');
        const buttonsAnnul = document.querySelectorAll('.btn-cancel');
        const buttonsModifSousDossier = document.querySelectorAll('.btn-sousdoss');
        const textSousDossier = document.querySelectorAll('.souscategory-name');
        const buttonValidSousDoss = document.querySelectorAll('.btn-validsousdoss');
        const buttonAnnulSousDoss = document.querySelectorAll('.btn-cancelsousdoss');
        const buttonsDeleteSousDoss = document.querySelectorAll('.btn-deletesousdoss');


        buttonsModif.forEach((buttonModif, index) => {
            buttonModif.addEventListener("click", function(event){ 
                event.preventDefault();
                texts[index].disabled = false;
                buttonModif.hidden = true;
                buttonsValid[index].hidden = false;
                buttonsAnnul[index].hidden = false;
                buttonsDelete.forEach((buttonDelete) => {
                    buttonDelete.hidden = true;
                });
            
            });
        });

        buttonsAnnul.forEach((buttonCancel) => {
            buttonCancel.addEventListener("click", function(event){
                window.location.reload();
            });

        });

        buttonsModifSousDossier.forEach((buttonModifSousDossier, index) => {
            buttonModifSousDossier.addEventListener("click", function(event){
                event.preventDefault();
                buttonModifSousDossier.hidden = true;
                textSousDossier[index].disabled = false;
                buttonValidSousDoss[index].hidden = false;
                buttonAnnulSousDoss[index].hidden = false;
                buttonsDeleteSousDoss.forEach((buttonDeleteSousDoss) => {
                    buttonDeleteSousDoss.hidden = true;
                });

            });
        });


        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            $('#exampleModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var recipient = button.data('whatever'); // Extract info from data-* attributes
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this);
                modal.find('.modal-title').text('Nom de la catégorie');
                modal.find('.modal-body input').val(recipient);
            });

        



    </script>
@endsection