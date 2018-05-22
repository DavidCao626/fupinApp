@extends('layouts.app')

@section('content')
<div class="">
    <div class="">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>
                    <i class="glyphicon glyphicon-align-justify"></i> 信息栏
                    @unless (!Auth::check())

                      <a class="btn btn-success pull-right" href="{{ route('articles.create') }}"><i class="glyphicon glyphicon-plus"></i> 新建</a>
                    @endunless

                </h4>
            </div>

            <div class="panel-body">
                @if($articles->count())
                    <table class="table table-condensed table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>标题</th> <th>作者(发布人)</th> <th >所属乡镇</th> <th >发布时间</th>
                              @unless (!Auth::check())  <th class="text-right" width="100">操作</th>@endunless
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($articles as $article)
                                <tr>
                                    <td class="text-center"><strong>{{$loop->iteration}}</strong></td>

                                    <td> <a href="{{ route('articles.show', $article->id) }}" >{{ str_limit($article->title, 140, '... ... ') }}</a></td>
                                     <td>{{$article->author}}</td>
                                      <td>{{$article->url}}</td>
                                      <td>{{ $article->updated_at->diffForHumans() }}</td>
                                    @unless (!Auth::check())
                                    <td class="text-right">
                                        <a class="btn btn-xs btn-primary" href="{{ route('articles.show', $article->id) }}">
                                            <i class="glyphicon glyphicon-eye-open"></i>
                                        </a>

                                        <a class="btn btn-xs btn-warning" href="{{ route('articles.edit', $article->id) }}">
                                            <i class="glyphicon glyphicon-edit"></i>
                                        </a>

                                        <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('文章讲彻底删除无法恢复，确认删除?');">
                                            {{csrf_field()}}
                                            <input type="hidden" name="_method" value="DELETE">

                                            <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> </button>
                                        </form>
                                    </td>
                                    @endunless
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $articles->render() !!}
                @else
                    <h5 class="text-center alert alert-info">当前还没有文章!</h5>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
