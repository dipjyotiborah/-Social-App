@foreach ($posts as $post)
    <div class="border p-4 mt-4">
        <p><strong>{{ $post->user->name }}</strong></p>
        <p>{{ $post->content }}</p>

        @if ($post->media)
            @if ($post->type == 'image')
                <img src="{{ asset('storage/' . $post->media) }}" class="mt-2" width="300">
            @elseif ($post->type == 'video')
                <video width="300" controls>
                    <source src="{{ asset('storage/' . $post->media) }}">
                </video>
            @endif
        @endif
    </div>
@endforeach
