<p>
    Your account has been banned for {!! $ban->period_amount !!} {!! $ban->period_unit_string !!}.  The reason for the ban, along with details of when the ban will be lifted, are included below.
</p>

<h3>Details</h3>
<p>
    {!! nl2br($ban->reason ) !!}
    @if($ban->reason_extra)
        <br />
        {!! nl2br($ban->reason_extra) !!}
    @endif
</p>

<p>
    Your account will be automatically unbanned at {{ $ban->period_finish->format("l jS \\of F Y H:i:s \\z") }}.  Please do not attempt to connect to any VATSIM UK service whilst your account
    is banned.
</p>

@if($ban->is_local)
    <p>
        <strong>This ban only applies to VATSIM UK services.  You will be notified separately if you are also banned from network services.</strong>
    </p>
@endif

<p>
    If you believe this ban has been applied in error, please contact the community manager via {!! link_to("http://helpdesk.vatsim-uk.co.uk", "our helpdesk") !!}.
</p>