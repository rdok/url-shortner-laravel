<?php /** @var \App\Url $url */ ?>
@isset($url)
    <div class="alert alert-success mt-3 mb-0" role="alert">
        <a
                href="{{ $url->path() }}"
                target="_blank"
                class="card-link"
                dusk="shortened-url-link"
        >View</a>
        <span class="badge badge-pill badge-success">{{ url($url->path()) }}</span>
    </div>
@endif
