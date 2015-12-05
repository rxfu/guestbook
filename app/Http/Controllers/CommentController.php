<?php namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller {

	public function __construct() {
		$this->middleware('auth', ['except' => ['getGuestbook', 'postStore']]);
	}

	public function getGuestbook() {
		$comments = Comment::where('is_published', 1)->orderBy('updated_at', 'desc')->get();
		return view('guestbook')->with('comments', $comments);
	}

	public function postStore(Request $request) {
		$this->validate($request, [
			'email'   => 'email',
			'comment' => 'required',
		]);
		$input = $request->all();

		$comment          = new Comment();
		$comment->name    = empty($input['name']) ? '匿名' : $input['name'];
		$comment->email   = empty($input['email']) ? 'anonymous@guest.com' : $input['email'];
		$comment->comment = nl2br($input['comment']);

		if ($comment->save()) {
			return redirect('/')->with('status', '留言成功');
		} else {
			return back()->withErrors('留言失败');
		}
	}

	public function getList() {
		$comments = Comment::orderBy('created_at', 'desc')->get();
		return view('list')->with('comments', $comments);
	}

	public function putPublish($id) {
		$comment               = Comment::find($id);
		$is_published          = $comment->is_published ? false : true;
		$comment->is_published = $is_published;

		if ($comment->save()) {
			return redirect('comment/list')->with('status', '发布成功');
		} else {
			return back()->withErrors('发布失败');
		}
	}
}