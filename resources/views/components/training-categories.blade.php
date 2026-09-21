<div class="training-categories">
@foreach(config('site.training_categories') as $category)<a href="{{ route('contact') }}#consultation">
<span class="training-index">0{{ $loop->iteration }}</span>
<span>{{ $category }}</span>
<span aria-hidden="true">↗</span>
</a>
@endforeach</div>
