<ul>
    <input type="hidden" name="{{ $key }}_original" value="{{ $angaben_json }}">
    @foreach ( json_decode($angaben_json) as $item)
        <li
            class="list-group"
        >
            <div class="list-group-item my-1">
            <p>{{ $item->name }}</p>
            @switch($item->type)
                @case('text')
                    <input
                        type="text"
                        class="form-control"
                        id="{{ $key }}[{{ $item->name }}]"
                        name="{{ $key }}[{{ $item->name }}]"
                        {{ $required }}
                        {{ isset($item->required) ? 'required' : '' }}
                    >
                    @break
                @case('checkbox')
                    @foreach($item->options as $options)
                        <div class="form-check">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                value="{{$options}}"
                                id="{{ $key }}[{{ $item->name }}]"
                                name="{{ $key }}[{{ $item->name }}][]"
                            >
                            <label
                                class="form-check-label"
                                for="{{ $key }}[{{ $item->name }}]"
                            >
                                {{ $options }}
                            </label>
                        </div>
                    @endforeach
                    @break
                @case('date')
                    <input
                        type="date"
                        id="{{ $key }}[{{ $item->name }}]"
                        name="{{ $key }}[{{ $item->name }}]"
                        min="2000-01-01"
                        {{ $required }}
                        {{ isset($item->required) ? 'required' : '' }}
                    >
                    @break
            @endswitch
            </div>
        </li>
    @endforeach
</ul>
