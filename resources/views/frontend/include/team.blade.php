<!-- Start Team Area -->
<div class="team-area pt-70 pb-70">
    <div class="container">
        <div class="section-title">
            <h3>{{trans('front.teams')}}</h3>
            <p>{{trans('front.we_have_teams')}}</p>
        </div>

        <div class="row justify-content-center">

            @forelse($teams as $team)
            <div class="col-md-3">
                <div class="single-team-member">
                    <img src="{{asset($team->image)}}" alt="{{$team->name}}" width="80%">

                    <div class="content">
                        <h3>{{$team->name}}</h3>
                        <span>{{$team->jop}}</span>
                    </div>
                </div>
            </div>
            @empty
            @endforelse

        </div>
    </div>
</div>
<!-- End Team Area -->
