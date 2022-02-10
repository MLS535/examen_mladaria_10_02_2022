@extends('layouts.layout')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div id="showimages"></div>
        </div>
        <div class="col-md-6 offset-3 mt-5">
            <div class="card">
                <div class="card-header bg-info">
                    <h6 class="text-white">{{__('Create')}}</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 text-right mb-3">
                            <a href="{{ route('posts.index') }}" class="btn btn-primary">@lang('Back')</a>
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

                    <form method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                        @csrf
                        {{--                        Name type:text--}}
                        <div class="form-group">
                            <label><strong>@lang("Name") :</strong></label>
                            <input type="text" name="name" class="form-control" value="{{old('name')}}" required/>
                            {!! $errors->first('name','<small>:message</small><br>') !!}
                        </div>


                        {!! $errors->first('category','<small>:message</small><br>') !!}
                        {{--                        date type:date--}}
                        <div class="form-group">
                            <label><strong>@lang("Date") :</strong></label><br>
                            <input type="date" name="date" class="form-control"  value="{{old('date')}}"/>
                            {!! $errors->first('date','<small>:message</small><br>') !!}
                        </div>


                        {{--type:select name size--}}
                        <div class="form-group">
                            <label>@lang("Access")</label>
                            <select class="form-control" name="size">
                                <option selected>Pick Size</option>
                                <option value="privado" @if(old('size') === 'privado') selected @endif >privado</option>
                                <option value="public" @if(old('size') === 'public') selected @endif>public</option>

                            </select>
                            {!! $errors->first('size','<small>:message</small><br>') !!}
                        </div>



                        {{--                        type:textarea--}}
                        <div class="form-group">
                            <label><strong>{{__("Description")}} :</strong></label>
                            <textarea class="form-control" rows="4" cols="40" name="description" required>{{old('description')}}</textarea>
                            {!! $errors->first('description','<small>:message</small><br>') !!}
                        </div>

                        {{--  CHECKBOX--}}
                        <label> @lang("category"):<br>
                            <label><input type="checkbox" name="category[]" value="Caducable"
                                          @if(is_array(old('category')) && in_array("Caducable", old('category'))) checked @endif> {{ ("Caducable") }}
                            </label>
                            <label><input type="checkbox" name="category[]" value="Comentable"
                                          @if(is_array(old('category')) && in_array("Comentable", old('category'))) checked @endif> {{ ("Comentable") }}
                            </label>
                        </label>


                        <p></p>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-success btn-sm">@lang("Save")</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
