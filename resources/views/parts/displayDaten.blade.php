<ul class="list-group">
    @foreach ( json_decode($angaben_json) as $item)
    @if (
            !empty($item->name)
            && !empty($item->type)
        )
        <li
            class="list-group-item"
        >
            <div class="row">
                <div class="col-md-5 col-12">
                    {{ $item->name }}
                </div>
                @switch($item->type)
                    @case('date')
                        <div
                            class="col-md-7 col-12"
                        >
                            {{ Carbon\Carbon::parse($item->date)->format('d.m.Y') }}
                        </div>
                    @break
                    @case('text')
                        <div
                            class="col-md-7 col-12"
                        >
                            {{ $item->text }}
                        </div>
                    @break
                    @case('checkbox')
                    <div
                        class="col-md-7 col-12"
                    >
                        Diese Optionen hast du ausgewählt:
                        @foreach( $item->checkbox as $option )
                            {{ $option }}
                            @if (!$loop->last) , @endif
                        @endforeach
                    </div>
                    @break
                    @default
                        <div
                            class="col-md-7 col-12"
                        >
                            Irgendetwas stimmt hier nicht, schreib uns doch mal bitte ne Mail über diesen Fehler
                        </div>
                @endswitch



            </div>
        </li>
    @endif
    @endforeach
</ul>
