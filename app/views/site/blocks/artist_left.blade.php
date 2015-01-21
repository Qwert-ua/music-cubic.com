<blockquote>
	{{ trans('trans.title.about_artist') }}
</blockquote>

<div class="clearfix"></div>

@if(!empty($edit))
	{{ Form::textarea('description', array_get($artist, 'description'), array('class' => 'form-control')) }}
@else
	<div style="text-align: justify">{{ nl2br($artist->description) }}</div>
@endif

<br />
<br />





<blockquote>
	{{ trans('trans.title.my_afisha') }}
</blockquote>

<div class="clearfix"></div>

<div class="row">
	<div class="col-xs-6">
		<div class="well well-small">qwerty</div>
	</div>	
	<div class="col-xs-6">
		<div class="well well-small">qwerty</div>
	</div>	
</div>

<div class="row">
	<div class="col-xs-6">
		<div class="well well-small">qwerty</div>
	</div>	
	<div class="col-xs-6">
		<div class="well well-small">qwerty</div>
	</div>	
</div>






<h5>
	<a href="/artist/nickelback/albums" class="pull-right text-muted">Альбомы</a>
	Аудио <small class="text-muted">(123)</small>
</h5>

<div class="clearfix"></div>


<a href="#">qwdq qwd qwd <small class="pull-right text-muted">4:23</small></a>
<br />
<a href="#">qwdq qwd qwd <small class="pull-right text-muted">4:23</small></a>
<br />
<a href="#">qwdq qwd qwd <small class="pull-right text-muted">4:23</small></a><br />
<a href="#">qwdq qwd qwd <small class="pull-right text-muted">4:23</small></a><br />
<a href="#">qwdq qwd qwd <small class="pull-right text-muted">4:23</small></a><br />
<a href="#">qwdq qwd qwd <small class="pull-right text-muted">4:23</small></a><br />
<a href="#">qwdq qwd qwd <small class="pull-right text-muted">4:23</small></a>