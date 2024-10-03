@include('template.header')
<div class="container gap-5" style="columns: 6;">
    @php
        $currentLetter = $cities[0]['name'][0];
    @endphp

    @foreach($cities as $city)
        @if ($currentLetter !== substr($city['name'], 0, 2))
            @php $currentLetter = substr($city['name'], 0, 2) @endphp

            <h1>{{ $currentLetter }}</h1>
        @endif

        <a href="/{{$city['slug']}}">
            @if ($selectedCitySlug === $city['slug'])
                <b>{{ $city['name'] }}</b>
            @else
                {{ $city['name'] }}
            @endif
        </a>
    @endforeach
</div>

@include('template.footer')
