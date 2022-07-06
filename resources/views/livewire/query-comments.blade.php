<div class="mb-3" wire>
    @foreach($contents->queries as $queries)
        {{ $queries->body }}

        @foreach($queries->replies as $replies)
            {{ $replies->body }}
        @endforeach

    @endforeach
</div>
