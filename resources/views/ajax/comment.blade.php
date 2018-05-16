<div class="container" style="padding-bottom: 60px;">
			<div class="row list-product">
				<a class="btn btn-primary">Ý kiến phản hồi ({{count($product_main->comments)}})</a>
				@foreach($product_main->comments as $comment)
						<div style="margin-top: 10px;">
							<div class="top">
								<h5>{{$comment->name}}</h5>
								<p>{{date('d/m/Y H:i:s', strtotime($comment->created_at))}}</p>
							</div>
							<div class="bot">
								<p>{{$comment->content}}</p>
							</div>
						</div>
						@endforeach
			</div>
		</div>