<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller {

	public function getGuestbook() {
		return view('guestbook');
	}

	public function postAdd(Request $request) {
		$inputs     = $request->all();
		$validators = Validator::make($inputs, [
			'comment' => 'required',
		]);

		if ($validator->passes()) {
			$comment          = new Comment();
			$comment->name    = isset($input['name']) ? $input['name'] : '匿名';
			$comment->email   = isset($input['email']) ? $input['email'] : 'anonymous@guest.com';
			$comment->comment = $input['comment'];

			if ($comment->save()) {
				return redirect('/')->with('status', '留言成功');
			} else {
				return back()->withErrors('留言失败');
			}
		} else {
			return back()->withErrors($validators);
		}
	}
}