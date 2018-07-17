@extends('admin.layouts.layout')

@section('title', 'Pages')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>
                    Pages
                </h3>
            </div>

            <div class="title_right">
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Edit Page</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form class="form-horizontal form-label-left" action="{{url('admin/structure-pages/'.$page->id)}}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="tabs-container" role="tabpanel" data-example-id="toggable_tabs">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="active"><a href="#en" data-toggle="tab" aria-expanded="true">En</a></li>
                                    <li class=""><a href="#ru" data-toggle="tab" aria-expanded="false">Ru</a></li>
                                    <li class=""><a href="#az" data-toggle="tab" aria-expanded="false">Az</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade active in" id="en">
                                        <div class="item form-group {{$errors->has('title_en')?'has-error':''}}">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <input id="title_en" class="form-control" minlength="3" name="title_en" required type="text" value="{{old('title_en', $page->title_en)}}" placeholder="Title" />
                                                <span class="col-md-5 col-xs-2 text-danger">{{$errors->first('title_en')}}</span>
                                            </div>
                                        </div>
                                        <div class="item form-group {{$errors->has('title_en')?'has-error':''}}">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <textarea id="text_en" class="form-control ckeditor" name="text_en" required placeholder="Text">{{old('text_en', $page->text_en)}}</textarea>
                                                <span class="col-md-5 col-xs-2 text-danger">{{$errors->first('text_en')}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="ru">
                                        <div class="item form-group {{$errors->has('title_ru')?'has-error':''}}">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <input id="title_ru" class="form-control" minlength="3" name="title_ru" required type="text" value="{{old('title_ru', $page->title_ru)}}" placeholder="Title" />
                                                <span class="col-md-5 col-xs-2 text-danger">{{$errors->first('title_ru')}}</span>
                                            </div>
                                        </div>
                                        <div class="item form-group {{$errors->has('title_ru')?'has-error':''}}">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <textarea id="text_ru" class="form-control ckeditor" name="text_ru" required placeholder="Text">{{old('text_ru', $page->text_ru)}}</textarea>
                                                <span class="col-md-5 col-xs-2 text-danger">{{$errors->first('text_ru')}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="az">
                                        <div class="item form-group {{$errors->has('title_az')?'has-error':''}}">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <input id="title_en" class="form-control" minlength="3" name="title_az" required type="text" value="{{old('title_az', $page->title_az)}}" placeholder="Title" />
                                                <span class="col-md-5 col-xs-2 text-danger">{{$errors->first('title_az')}}</span>
                                            </div>
                                        </div>
                                        <div class="item form-group {{$errors->has('title_az')?'has-error':''}}">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <textarea id="text_az" class="form-control ckeditor" name="text_az" required placeholder="Text">{{old('text_az', $page->text_az)}}</textarea>
                                                <span class="col-md-5 col-xs-2 text-danger">{{$errors->first('text_az')}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item form-group {{$errors->has('slug')?'has-error':''}}">
                                <input id="slug" class="form-control" minlength="3" name="slug" required type="text" value="{{old('slug', $page->slug)}}" placeholder="Slug" />
                            </div>
                            <div class="item form-group {{$errors->has('published')?'has-error':''}}">
                                <label for="published">
                                    <input id="published" type="checkbox" name="published" class="js-switch" {{(old('published', $page->published) == 1)?'checked':''}} value="1" />
                                    Published
                                </label>
                            </div>
                            <div class="form-group">
                                <div class="form-buttons">
                                    <a href="{{url('admin/structure-pages')}}" class="btn btn-primary">Cancel</a>
                                    <button id="send" type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

@endsection