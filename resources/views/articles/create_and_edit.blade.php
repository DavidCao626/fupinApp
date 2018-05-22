@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">

            <div class="panel-heading">
                <h4>
                    <i class="glyphicon glyphicon-edit"></i> 信息 /
                    @if($article->id)
                        编辑 #原标题:{{ $article->title }}
                    @else
                        新建
                    @endif
                </h4>
            </div>

            @include('common.error')

            <div class="panel-body">
                @if($article->id)
                    <form action="{{ route('articles.update', $article->id) }}" method="POST" accept-charset="UTF-8">
                        <input type="hidden" name="_method" value="PUT">
                @else
                    <form action="{{ route('articles.store') }}" method="POST" accept-charset="UTF-8">
                @endif

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">


                <div class="form-group">
                	<label for="title-field">标题</label>
                	<input class="form-control" type="text" name="title" id="title-field" value="{{ old('title', $article->title ) }}"  required/>
                </div>

                <div class="form-group">
                	<label for="author-field">作者（发布人）</label>
                	<input class="form-control" type="text" name="author" id="author-field" value="{{ old('author', $article->author ) }}" required/>
                </div>
                <div class="form-group">
                	<label for="author-field">所属乡镇</label>
                	<input class="form-control" type="text" name="url" id="author-field" value="{{ old('url', $article->url ) }}" required/>
                </div>
                <div class="form-group">
                	<label for="body-field">内容</label>
                	{{-- <textarea name="body" id="editor" class="form-control" rows="3">{{ old('body', $article->body ) }}</textarea> --}}
                  @include('vendor.ueditor.assets')

                  <!-- 编辑器容器 -->
                  <script id="container" name="body" type="text/plain"></script>
                </div>

                    <div class="well well-sm">
                        <button type="submit" class="btn btn-primary">保存提交</button>
                        <a class="btn btn-link pull-right" href="{{ route('articles.index') }}"><i class="glyphicon glyphicon-backward"></i>  返回上一步</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('styles')
@stop

@section('scripts')
  <!-- 实例化编辑器 -->
<script type="text/javascript">
  var ue = UE.getEditor('container',{initialFrameHeight: 600});
  ue.ready(function() {
      ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
      ue.setContent('	{!! $article->body !!}');
  });
</script>


@stop
