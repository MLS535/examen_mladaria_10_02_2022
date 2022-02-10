
@extends('layouts.layout')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div id="showimages"></div>
        </div>
        <div class="col-md-6 offset-3 mt-5">
            <div class="card">
                <div class="card-header bg-info">
                    <h6 class="text-white">{{__("Editar un proyecto")}}</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 text-right mb-3">
                            <a href="{{ route('posts.index', $post) }}" class="btn btn-primary">@lang("Back")</a>
                        </div>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> @lang("There were some problems with your input.")<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="post" action="{{ route('posts.update', $post)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label><strong> {{__("Name")}} :</strong></label>
                            <input type="text" name="name" class="form-control"  value="{{old('name',$post->name)  }}"/>
                            {!! $errors->first('size','<small>:message</small><br>') !!}
                        </div>

                        <div class="form-group">
                            <label><strong>@lang("Date"):</strong></label><br>
                            <input type="date" name="date" class="form-control" value="{{old('date',$post->date)}}"/>
                            {!! $errors->first('size','<small>:message</small><br>') !!}
                        </div>



                        <div class="form-group">
                            <label>@lang("Access")</label>
                            <select class="form-control" name="size" >
                                <option @if(old('size') === 'Pick Size') selected @endif>Pick Size</option>
                                <option value="privado" @if(old('size') === 'privado') selected @endif>privado</option>
                                <option value="public" @if(old('size') === 'public') selected @endif>public</option>
                            </select>
                            {!! $errors->first('size','<small>:message</small><br>') !!}
                            <small class="form-text text-muted">Your tournament size</small>
                        </div>


                        <div class="form-group">
                            <label><strong>@lang("Description") :</strong></label>
                            <textarea class="form-control" rows="4" cols="40" name="description">{{old('description',$post->description)}}</textarea>
                        </div>

                        <label> @lang("category"):<br>
                            <label><input type="checkbox" name="category[]" value="Caducable"
                                          @if(is_array(old('category')) && in_array("Caducable", old('category'))) checked @endif> {{ ("Caducable") }}
                            </label>
                            <label><input type="checkbox" name="category[]" value="Comentable"
                                          @if(is_array(old('category')) && in_array("Comentable", old('category'))) checked @endif> {{ ("Comentable") }}
                            </label>
                        </label>


                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-success btn-sm">@lang("Save")</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


