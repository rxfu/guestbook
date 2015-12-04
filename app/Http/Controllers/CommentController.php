<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller {

	public function getGuestbook() {
		return view('guestbook');
	}

	public function postSave(Request $request) {
		$input      = $request->all();
		$validators = Validator::make($input, [
			'comment' => 'required',
		]);

		if ($validator->passes()) {
			$comment          = new Comment();
			$comment->name    = isset($input['name']) ? $input['name'] : '匿名';
			$comment->email   = isset($input['email']) ? $input['email'] : 'anonymous@guest.com';
			$comment->comment = nl2br($input['comment']);

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