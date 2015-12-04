<?php namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller {

	public function getGuestbook() {
		return view('guestbook');
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
}