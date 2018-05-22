@extends('layouts.app')

@section('title', $article->title)

@section('content')
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 topic-content">
  <ol class="breadcrumb" style="background-color:#fff">
    <li><a href="{{route('articles.index')}}">首页</a></li>
    <li>{{$article->title}}</li>
  </ol>
</div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 topic-content">
        <div class="panel panel-default">
            <div class="panel-body" style="padding:20px">
                <h1 class="text-center">
                  {{ $article->title }}
                </h1>

                <div class="article-meta text-center">
                   发布日期：  <label>{{ $article->created_at->diffForHumans() }}</label>
                    &nbsp;&nbsp;&nbsp;&nbsp; 发布人：<label> {{ $article->author }}</label>
                    &nbsp;&nbsp;&nbsp;&nbsp; 所在乡镇：<label>  {{ $article->url }}</label>
                    <hr>
                </div>
<br/>
                <div class="topic-body">
                    	{!! $article->body !!}
                </div>


            </div>
        </div>
        <br/>  <br/>  <br/>  <br/><br/>  <br/>  <br/>  <br/><br/>
    </div>
</div>
@stop
