@foreach($exchanges as $exchange)
    <div class="p-3 border rounded">
        <p>Exchange request from {{ $exchange->offeredBy->name }}</p>
        <button onclick="respondToExchange({{ $exchange->id }}, 'accepted')" class="bg-green-500 text-white p-2 rounded">Accept</button>
        <button onclick="respondToExchange({{ $exchange->id }}, 'declined')" class="bg-red-500 text-white p-2 rounded">Decline</button>
    </div>
@endforeach
