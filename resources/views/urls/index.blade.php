@extends('layouts.app')

@section('content')
    <div class="card-header mb-2">Anonymous</div>

    <?php /**
     * @var \App\Url $url
     * @var \Illuminate\Pagination\Paginator $urls
     */ ?>
    @foreach($urls as  $url)
        <div class="card mt-2">
            <a class="btn btn-primary"
               target="_blank"
               href="{{ url($url->path()) }}"
            >
                {{ url($url->path()) }}
                <span class="badge badge-light   text-wrap"> {{ $url->target }} </span>
            </a>
        </div>
    @endforeach

    {{ $urls->links() }}

@endsection
