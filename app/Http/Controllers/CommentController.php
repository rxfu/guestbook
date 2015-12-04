<?php namespace App\Http\Controllers;

class CommentController extends Controller {

	public function getGuestbook() {
		return view('guestbook');
	}
}