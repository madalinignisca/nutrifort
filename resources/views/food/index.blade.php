@forelse ($food as $item)
    <div>
        <h4>{{ $item->name }}</h4>
        <ul>
            <li>{{ $item->fat }}</li>
            <li>{{ $item->saturated_fat }}</li>
            <li>{{ $item->carbohydrate }}</li>
            <li>{{ $item->sugar }}</li>
            <li>{{ $item->protein }}</li>
        </ul>
    </div>
@empty
    <p>No food</p>
@endforelse
