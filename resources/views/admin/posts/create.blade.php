@extends('admin.layouts.default')

@section('content-admin')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Новая статья</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Blank Page</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Создание статьи</h3>
                        </div>
                        <!-- /.card-header -->

                        <form role="form" method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Название</label>
                                    <input type="text" name="title"
                                           class="form-control @error('title') is-invalid @enderror" id="title"
                                           placeholder="Название">
                                </div>
                                <div class="form-group">
                                    <label for="description">Цитата</label>
                                    <textarea id="description" class="form-control @error('description') is-invalid @enderror" rows="3" name="description" placeholder="Введите текст цитаты ..."></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="content">Контент</label>
                                    <textarea id="content" class="form-control @error('content') is-invalid @enderror" rows="5" name="content" placeholder="Введите текст цитаты ..."></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="category_id">Категория</label>
                                    <select id="category_id" name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                        <option>Выберите категорию</option>
                                        @foreach($categories as $k => $v)
                                            <option value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tags">Теги</label>
                                    <select name="tags[]" id="tags" class="select2" multiple="multiple" data-placeholder="Выбор тегов" style="width: 100%;">
                                        @foreach($tags as $k => $v)
                                            <option value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="thumbnail">Выберите изображение</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="thumbnail"
                                                   class="custom-file-input input-thumbnail-create" id="thumbnail">
                                            <label class="custom-file-label" for="thumbnail">Выберите файл</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </div>
                        </form>

                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@section('scripts')
    <script src="{{ asset('ckeditor5/build/ckeditor.js') }}"></script>
    <script src="{{ asset('ckfinder/ckfinder.js') }}"></script>
    @parent
    <script>

        ClassicEditor
            .create( document.querySelector( '#content' ), {
                ckfinder: {
                    uploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
                },
                image: {
                    toolbar: ['imageTextAlternative', '|', 'imageStyle:alignLeft', 'imageStyle:full', 'imageStyle:alignRight',],
                    styles: [
                        'full',
                        'alignLeft',
                        'alignRight'
                    ]
                },
                toolbar: {
                    items: [
                        'heading',
                        '|',
                        'bold',
                        'italic',
                        'link',
                        'bulletedList',
                        'numberedList',
                        '|',
                        'indent',
                        'outdent',
                        'alignment',
                        '|',
                        'blockQuote',
                        'insertTable',
                        'CKFinder',
                        'mediaEmbed',
                        'undo',
                        'redo'
                    ]
                },
                language: 'ru',
                table: {
                    contentToolbar: [
                        'tableColumn',
                        'tableRow',
                        'mergeTableCells'
                    ]
                },
            } )
            .catch( function( error ) {
                console.error( error );
            } );
        ClassicEditor
            .create( document.querySelector( '#description' ), {
                toolbar: [ 'heading', '|', 'bold', 'italic', '|', 'undo', 'redo' ]
            } )
            .catch( function( error ) {
                console.error( error );
            } );
    </script>
@endsection
