@extends('layouts.app')

@section('content')
    <main class="container" style="min-height: 680px">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="tag-cloud">
                    <div class="tag-cloud-title">
                        目前共计 {{ $count }} 个标签
                    </div>

                    <div class="tag-cloud-tags">
                        @foreach($tags as $tag)
                            <a href="{{ route('tags.show', ['id' => $tag->id]) }}"
                               @if ($tag->count <= 1)
                                    style="font-size: 10px; color: #ccc"
                               @elseif ($tag->count <= 5)
                                    style="font-size: 12px; color: #b9b9b9"
                               @elseif ($tag->count <= 10)
                                    style="font-size: 16px; color: #a7a7a7"
                               @elseif ($tag->count <= 20)
                                    style="font-size: 21px; color: #6f6f6f"
                               @elseif ($tag->count <= 50)
                                    style="font-size: 24.6px; color: #494949"
                               @else
                                    style="font-size: 28.2px; color: #242424"
                               @endif
                               >
                                {{ $tag->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection