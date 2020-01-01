@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Guest</div>


                    <div class="card-body">

                        <form method="POST" action="/urls">
                            <div class="input-group input-group-lg">

                                {{ csrf_field() }}

                                <input type="text"
                                       class="form-control"
                                       aria-label="Large"
                                       aria-describedby="inputGroup-sizing-sm"
                                       name="url"
                                />
                                <div class="input-group-append">
                                    <button
                                            type="submit"
                                            class="btn btn-lg btn-outline-primary"
                                    >Shorten
                                    </button>
                                </div>

                            </div>
                        </form>

                        @include('_shortlink')
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
