<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Posts
        </h2>
    </x-slot>

    <div class="container mx-auto p-4">
        <h2 class="text-lg font-semibold mb-4">Recent Posts</h2>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ($posts as $post)
                <div x-data="{ open: false }">
                    <div class="bg-white shadow-md rounded-lg overflow-hidden cursor-pointer"
                         @click="open = true">
                        @if ($post->media)
                            <img src="{{ asset('storage/' . $post->media) }}" 
                                 alt="Post Image" 
                                 class="w-full h-40 object-cover">
                        @endif
                        <div class="p-3">
                            <p class="text-sm text-gray-800 font-medium truncate">
                                {{ Str::limit($post->content, 50) }}
                            </p>
                            <p class="text-sm font-semibold text-gray-700">
                                {{ $post->user->name }}
                            </p>
                            <p class="text-xs text-gray-500 mt-1">
                                {{ $post->created_at->format('d M Y, h:i A') }}
                            </p>
                        </div>
                    </div>

                    <!-- MODAL -->
                    <div x-show="open"
                         x-transition
                         class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4"
                         x-cloak
                         @click.self="open = false">

                        <div class="bg-white rounded-lg shadow-lg max-w-xl w-full p-4 relative max-h-screen overflow-auto"
                             @click.stop>

                            <!-- Close Button -->
                            <button class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-2xl"
                                    @click="open = false">
                                &times;
                            </button>

                            <!-- Image Section -->
                            @if ($post->media)
                                <img src="{{ asset('storage/' . $post->media) }}" 
                                     alt="Post Image" 
                                     class="w-full max-h-[50vh] object-contain rounded">
                            @endif

                            <!-- Content Section -->
                            <div class="p-3">
                                <p class="text-lg font-semibold text-gray-800">{{ $post->content }}</p>
                                <p class="text-sm font-semibold text-gray-700">
                                    {{ $post->user->name }}
                                </p>
                                <p class="text-xs text-gray-500 mt-1">
                                    {{ $post->created_at->format('d M Y, h:i A') }}
                                </p>

                                <button class="offer-exchange-btn btn btn-primary"
                                        data-offered-post-id="{{ $post->id }}"
                                        data-requested-post-id="{{ $requestedPost->id ?? '' }}"
                                        onclick="offerExchange(this)">
                                    Offer Exchange
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>

<script>document.getElementById("offer-exchange-btn").addEventListener("click", function () {
    fetch("/exchange/offer", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            item_id: document.getElementById("item-id").value,
            user_id: document.getElementById("user-id").value,
            offer_details: document.getElementById("offer-details").value
        })
    })
    .then(response => response.json())
    .then(data => console.log("Success:", data))
    .catch(error => console.error("Error:", error));
});

</script>
