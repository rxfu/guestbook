@extends('app')

@section('content')
	<form action="url(comment/add)" method="POST" class="form-horizontal">
		<div class="form-group">
			<label for="name" class="col-sm-2 control-label">姓名</label>
			<div class="col-sm-10">
			 	<input type="text" name="name" id="name" class="form-control" placeholder="姓名">
			</div>
		</div>
		<div class="form-group">
			<label for="email" class="col-sm-2 control-label">Email</label>
			<div class="col-sm-10">
			 	<input type="text" name="email" id="email" class="form-control" placeholder="Email">
			</div>
		</div>
		<div class="form-group">
			<label for="comment" class="col-sm-2 control-label">留言</label>
			<div class="col-sm-10">
				<textarea name="comment" id="comment" class="form-control" rows="10" placeholder="留言信息"></textarea>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10 text-center">
				<button type="submit" class="btn btn-primary">提交</button>
			</div>
		</div>
	</form>
@stop