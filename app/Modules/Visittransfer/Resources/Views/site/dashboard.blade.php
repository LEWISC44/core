@extends('visittransfer::site._layout')

@section('content')
    <div class="row">
        <div class="col-md-8 hidden-xs" id="visitingBoxes">
            <div class="col-md-6 hidden-xs">
            {!! HTML::panelOpen("Visiting ATC", ["type" => "vuk", "key" => "letter-v"]) !!}
            <!-- Content Of Panel [START] -->
                <!-- Top Row [START] -->
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <p>
                            You can apply to become a visitor if you:
                        <ul>
                            <li>want to control <strong>specific facilities*</strong> within the UK</li>
                            <li><strong>do not</strong> wish to leave your current division</li>
                        </ul>
                        <small>*Each facility will require a separate application.</small>
                        </p>
                    </div>

                </div>

                <br/>

                <div class="row">
                    <div class="col-xs-12 text-center">
                        @if(!\App\Modules\Visittransfer\Models\Facility::isPossibleToVisitAtc())
                            {!! Button::danger("THERE ARE NO VISITING ATC PLACES")->disable() !!}
                        @else
                            @can("create", new \App\Modules\Visittransfer\Models\Application)
                                {!! Button::success("START ATC APPLICATION")->asLinkTo(route("visiting.application.start", [\App\Modules\Visittransfer\Models\Application::TYPE_VISIT, "atc"])) !!}

                            @elseif($currentVisitApplication)
                                @if($currentVisitApplication->is_in_progress && $currentVisitApplication->is_atc)
                                    {!! Button::primary("CONTINUE APPLICATION")->asLinkTo(route("visiting.application.continue")) !!}
                                @else
                                    {!! Button::danger("You currently have a visit application open.")->disable() !!}
                                @endif
                            @elseif($currentTransferApplication)
                                {!! Button::danger("You currently have a transfer application open.")->disable() !!}
                            @else
                                {!! Button::danger("You are not able to apply to visit at this time.")->disable() !!}
                            @endcan
                        @endif
                    </div>
                </div>

                {!! HTML::panelClose() !!}
            </div>

            <div class="col-md-6 hidden-xs">
            {!! HTML::panelOpen("What about pilots?", ["type" => "vuk", "key" => "letter-p"]) !!}
            <!-- Content Of Panel [START] -->
                <!-- Top Row [START] -->
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <p>
                            You can apply to become a pilot visitor if you:
                        <ul>
                            <li>want to train towards <strong>any pilot rating*</strong> within the UK</li>
                            <li><strong>do not</strong> wish to leave your current division</li>
                        </ul>
                        <small>*Each rating will require a separate application.</small>
                        </p>
                    </div>

                </div>

                <br/>

                <div class="row">
                    <div class="col-xs-12 text-center">
                        @if(!\App\Modules\Visittransfer\Models\Facility::isPossibleToVisitPilot())
                            {!! Button::danger("THERE ARE NO VISITING ATC PLACES")->disable() !!}
                        @else
                            @can("create", new \App\Modules\Visittransfer\Models\Application)
                                {!! Button::success("START PILOT APPLICATION")->asLinkTo(route("visiting.application.start", [\App\Modules\Visittransfer\Models\Application::TYPE_VISIT, "pilot"])) !!}
                            @elseif($currentVisitApplication)
                                @if($currentVisitApplication->is_in_progress && $currentVisitApplication->is_pilot)
                                    {!! Button::primary("CONTINUE APPLICATION")->asLinkTo(route("visiting.application.continue")) !!}
                                @else
                                    {!! Button::danger("You currently have a visit application open.")->disable() !!}
                                @endif
                            @elseif($currentTransferApplication)
                                {!! Button::danger("You currently have a transfer application open.")->disable() !!}
                            @else
                                {!! Button::danger("You are not able to apply to visit at this time.")->disable() !!}
                            @endcan
                        @endif
                    </div>
                </div>

                {!! HTML::panelClose() !!}
            </div>
        </div>

        <div class="col-md-4 hidden-xs" id="transferringAtcBox">
        {!! HTML::panelOpen("Transferring ATC", ["type" => "vuk", "key" => "letter-t"]) !!}
        <!-- Content Of Panel [START] -->
            <!-- Top Row [START] -->
            <div class="row">
                <div class="col-md-10 col-xs-offset-1">
                    <p>
                        You can apply to transfer if you:
                    <ul>
                        <li>want the freedom to <strong>control anywhere</strong> within the UK*</li>
                        <li><strong>are happy</strong> to leave your current division</li>
                    </ul>
                    <small>*subject to appropriate training and GRP restrictions.</small>
                    </p>
                </div>

            </div>

            <br/>

            <div class="row">
                <div class="col-xs-12 text-center">
                    @if(!\App\Modules\Visittransfer\Models\Facility::isPossibleToTransfer())
                        {!! Button::danger("THERE ARE NO TRANSFER PLACES")->disable() !!}
                    @else
                        @can("create", new \App\Modules\Visittransfer\Models\Application)
                            {!! Button::success("START ATC APPLICATION")->asLinkTo(route("visiting.application.start", [\App\Modules\Visittransfer\Models\Application::TYPE_TRANSFER, 'atc'])) !!}
                        @elseif($currentTransferApplication)
                            {!! Button::primary("CONTINUE APPLICATION")->asLinkTo(route("visiting.application.continue")) !!}
                        @elseif($currentVisitApplication)
                            {!! Button::danger("You currently have a visit application open.")->disable() !!}
                        @else
                            {!! Button::danger("You are not able to apply to transfer at this time.")->disable() !!}
                        @endcan
                    @endif
                </div>
            </div>

            {!! HTML::panelClose() !!}
        </div>

        <div class="col-xs-12 visible-xs">
            {!! HTML::panelOpen("Start a new Application", ["type" => "fa", "key" => "exclamation"]) !!}
            <p class="text-center">You can only complete your application and references on a non-mobile device.</p>
            {!! HTML::panelClose() !!}
        </div>
    </div>

    <div class="row">
        <div class="col-md-12" id="applicationHistory">
            {!! HTML::panelOpen("Application History", ["type" => "fa", "key" => "list-alt"]) !!}
            <div class="row">
                <div class="col-md-10 col-md-offset-1">

                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th width="col-md-1">ID</th>
                            <th width="col-md-2">Type</th>
                            <th width="col-md-3">Facility</th>
                            <th class="col-md-2 hidden-xs hidden-sm">Submitted</th>
                            <th class="col-md-1 text-center">Status</th>
                            <th class="col-md-1 text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($allApplications) < 1)
                            <tr>
                                <td colspan="6" class="text-center">You have no applications to display.</td>
                            </tr>
                        @else
                            @foreach($allApplications as $application)
                                <tr>
                                    <td>
                                        @if($application->is_in_progress)
                                            {{ link_to_route('visiting.application.continue', $application->public_id) }}
                                        @else
                                            {{ link_to_route('visiting.application.view', $application->public_id, [$application->public_id]) }}
                                        @endif
                                    </td>
                                    <td>
                                        {{ $application->type_string }}
                                    </td>
                                    <td>{{ $application->facility_name }}</td>
                                    <td class="hidden-xs hidden-sm">
                                        @if($application->submitted_at == null)
                                            Not yet submitted
                                        @else
                                            <span class="hidden-xs">{{ $application->submitted_at }} UTC</span>
                                            <span class="visible-xs">{{ $application->submitted_at->toFormattedDateString() }}
                                                UTC</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @include("visittransfer::partials.application_status", ["application" => $application])
                                    </td>
                                    <td class="text-center">
                                        @if($application->is_in_progress)
                                            {!!
                                                Modal::named("withdraw_application")
                                                     ->withTitle("Withdraw Application")
                                                     ->withBody("If you wish to withdraw your application (without penalty) you can do so by clicking the button below.")
                                                     ->withFooter(
                                                        Form::horizontal(array("url" => URL::route("visiting.application.withdraw.post"))).
                                                        Button::danger("WITHDRAW APPLICATION - THIS CANNOT BE UNDONE")->submit().
                                                        Form::close()
                                                     )
                                                     ->withButton(Button::danger("WITHDRAW")->extraSmall())
                                            !!}
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>

            </div>
            {!! HTML::panelClose() !!}
        </div>
    </div>

    @if($pendingReferences->count() > 0)
        <div class="row" id="pendingReferences">
            <div class="col-md-12">
                {!! HTML::panelOpen("Pending References", ["type" => "fa", "key" => "list-alt"]) !!}
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">

                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th width="col-md-2">Applicant Name (CID)</th>
                                <th width="col-md-1">Type</th>
                                <th width="col-md-2">Facility</th>
                                <th width="col-md-2" class="hidden-xs hidden-sm">Submitted</th>
                                <th width="col-md-2" class="hidden-xs hidden-sm">Reference Due By</th>
                                <th class="col-md-1 text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($pendingReferences) < 1)
                                <tr>
                                    <td colspan="6" class="text-center">You have no applications to display.</td>
                                </tr>
                            @else
                                @foreach($pendingReferences as $reference)
                                    <tr>
                                        <td>{{ $reference->application->account->name }}
                                            ({{ $reference->application->account->id }})
                                        </td>
                                        <td>{{ $reference->application->type_string }}</td>
                                        <td>{{ $reference->application->facility_name }}</td>
                                        <td class="hidden-xs hidden-sm">
                                            <span class="hidden-xs">{{ $reference->application->submitted_at }} UTC</span>
                                            <span class="visible-xs">{{ $reference->application->submitted_at->toFormattedDateString() }}
                                                UTC</span>
                                        </td>
                                        <td class="hidden-xs hidden-sm">
                                            <span class="hidden-xs">{{ $reference->application->submitted_at->addDays(10) }} UTC</span>
                                            <span class="visible-xs">{{ $reference->application->submitted_at->addDays(10)->toFormattedDateString() }}
                                                UTC</span>
                                        </td>
                                        <td class="text-center">
                                            {!! link_to_route("visiting.reference.complete", "Complete", [$reference->token->code]) !!}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>

                </div>
                {!! HTML::panelClose() !!}
            </div>
        </div>
    @endif
@stop

@section("scripts")
    @parent

    <script type="text/javascript">
        var tour = new Tour({
            name: "VT-Dashboard",
            steps: [
                    @if($pendingReferences->count() > 0)
                    {
                        element: "#pendingReferences",
                        title: "Pending References",
                        content: "You have pending references that require completion here.  This list will be updated automatically.",
                        backdrop: true,
                        placement: "top"
                    },
                @endif

                @if($allApplications->count() > 0)
                    {
                        element: "#applicationHistory",
                        title: "Application History",
                        content: "You can view any open, or historic, applications here.",
                        backdrop: true,
                        placement: "top"
                    },
                @endif

                @can("create", new \App\Modules\Visittransfer\Models\Application)
                    {
                        element: "#visitingBoxes",
                        title: "Visiting the UK",
                        content: "If you wish to visit with your Controller rating or to gain a pilot rating, you should visit the UK.",
                        backdrop: true,
                        placement: "top"
                    },
                    {
                        element: "#transferringAtcBox",
                        title: "Transferring ATC",
                        content: "If you wish to transfer to the UK as a controller, start your application here.",
                        backdrop: true,
                        placement: "top"
                    },
                @endcan
            ]
        });

        tour.init();
        tour.start();
    </script>
@stop