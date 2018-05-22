<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Handlers\ImageUploadHandler;
class ArticlesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index()
	{
		$articles = Article::orderBy('created_at', 'desc')->paginate();
		return view('articles.index', compact('articles'));
	}

    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

	public function create(Article $article)
	{
		return view('articles.create_and_edit', compact('article'));
	}

	public function store(ArticleRequest $request)
	{
		$article = Article::create($request->all());
		return redirect()->route('articles.show', $article->id)->with('message', '创建成功.');
	}

	public function edit(Article $article)
	{
        $this->authorize('update', $article);
		return view('articles.create_and_edit', compact('article'));
	}

	public function update(ArticleRequest $request, Article $article)
	{
		$this->authorize('update', $article);
		$article->update($request->all());

		return redirect()->route('articles.show', $article->id)->with('message', '更新成功.');
	}

	public function destroy(Article $article)
	{
		$this->authorize('destroy', $article);
		$article->delete();

		return redirect()->route('articles.index')->with('message', '删除成功.');
	}
  public function uploadImage(Request $request, ImageUploadHandler $uploader)
  {
      // 初始化返回数据，默认是失败的
      $data = [
          'success'   => false,
          'msg'       => '上传失败!',
          'file_path' => ''
      ];
      // 判断是否有上传文件，并赋值给 $file
      if ($file = $request->upload_file) {
          // 保存图片到本地
          $result = $uploader->save($request->upload_file, 'articles', \Auth::id(), 1024);
          // 图片保存成功的话
          if ($result) {
              $data['file_path'] = $result['path'];
              $data['msg']       = "上传成功!";
              $data['success']   = true;
          }
      }
      return $data;
  }
}
