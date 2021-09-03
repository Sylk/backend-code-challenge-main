<h1>Pizza Planet Weekly Ingredients Report</h1>
Hello {{$manager->name}}, we've prepared a report for your weekly viewing of your region {{$manager->region}}.

@foreach($restaurants as $restaurant)
    <br><br>
    <h2>For your restaurant of {{$restaurant['name']}} - {{$restaurant['id']}}</h2>
    We're please to announce that you had {{$restaurant['fresh-ingredients-total']}} fresh ingredients.
    <br>
    {{-- IF UNFRESH INGREDIENTS IS GREATER THAN 0 --}}
    @if($restaurant['non-fresh-ingredients-total'] > 0)
        Unfortunately you did have a bit of an issue with {{$restaurant['non-fresh-ingredients-total']}} non-fresh ingredients.
        <br>
        While that's not the worst thing, the good news is that you had {{$restaurant['percentage-fresh']}} percent of fresh ingredients, so keep working hard!
        <br>
        We can admit there's some additional work to be done, so here are the ingredients you can focus on for next months iteration.
        <br><br>
        Problem Ingredients:
        @foreach($restaurant['non-fresh-ingredients-unique'] as $nonFreshIngredient)
            {{$nonFreshIngredient}}
        @endforeach
    @else
    You've achieved quite the feat, you had 100% fresh ingredients and that's no small task!
    @endif

    <br><br>
@endforeach

That's all that we have to report, if you have any questions feel free to reach out and we can massage additional data for you.
