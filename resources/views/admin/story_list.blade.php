@extends('layout.admin.index')

@section('html')
    <div class="">
        <form class="admin-filter" action="{{ url()->current() }}">
            <div class="admin-filter__inputs">
                <input class="admin-input" type="search" placeholder="E-mail" name="email" value={{ Request::get('email') }}>
            </div>
            <div class="admin-filter__buttons">
                <button class="admin-button admin-filter__button">Search</button>
                <a class="admin-button-red admin-filter__button" href="{{ url()->current() }}">Reset</a>
            </div>
        </form>
    </div>
    <div class="admin-grid">
        <div class="admin-grid__titles admin-grid-story__titles">
            <div>ID</div>
            <div>Name</div>
            <div>Type id</div>
            <div>User ID</div>
            <div>Date of creation</div>
        </div>
        <ul class="admin-grid__content admin-grid-story__content">
            @foreach ($stories as $story)
                <li class="admin-grid__content_item admin-grid-story__content_item">
                    <div>{{ $story->id }}</div>
                    <div>{{ $story?->storysable?->title ?? '-' }}</div>
                    <div>{{ $story?->storysable?->id }}</div>
                    <div>{{ $story?->user ? $story?->user->name . ' ' . $story?->user->surname : '-' }}</div>
                    <div>{{ $story->created_at }}</div>
                </li>
            @endforeach
        </ul>
        {{ $stories->appends(Request::all())->links('vendor.admin-pagination') }}
    </div>
@endsection
