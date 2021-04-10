<div class="form-group">
    <label>Title</label>
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <label>Description</label>
    {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 3]) !!}
</div>

<div class="form-group">
    <label>URL</label>
    {!! Form::url('url', null, ['class' => 'form-control']) !!}
</div>

<div class="checkbox">
    <label>
        {!! Form::hidden('receive_email', '0') !!}
        {!! Form::checkbox('receive_email', '1', isset($project) ? $project->receive_email : true) !!} Receive e-mails
        on exceptions (we will cluster these)
    </label>
</div>

@if(auth()->user()->canManageGroups())
    <div class="form-group">
        <label>Group</label>
        {!! Form::select('group_id', $groups, null, ['class' => 'form-control', 'placeholder' => '-Select group-']) !!}
    </div>
@endif

@if(isset($project))
    <div class="form-group @if($errors->has('slack_webhook')) has-error @endif">
        <label>Slack webhook</label>
        @if($project->slack_webhook)
            <div class="input-group">
                {!! Form::text('slack_webhook', null, ['class' => 'form-control']) !!}
                <span class="input-group-btn">
                    <button class="btn btn-secondary"
                            onclick="$('#webhook-test').append('<input type=\'hidden\' name=\'type\' value=\'slack\' />').submit();"
                            type="button">Test webhook</button>
                  </span>
            </div>
            <span class="help-block text-muted">If you enter a new webhook, <strong>first</strong> save the project and then test the webhook.</span>
        @else
            {!! Form::text('slack_webhook', null, ['class' => 'form-control']) !!}
        @endif
    </div>

    <div class="form-group @if($errors->has('slack_webhook')) has-error @endif">
        <label>Discord webhook</label>
        @if($project->discord_webhook)
            <div class="input-group">
                {!! Form::text('discord_webhook', null, ['class' => 'form-control']) !!}
                <span class="input-group-btn">
                    <button class="btn btn-secondary"
                            onclick="$('#webhook-test').append('<input type=\'hidden\' name=\'type\' value=\'discord\' />').submit();"
                            type="button">Test webhook</button>
                  </span>
            </div>
            <span class="help-block text-muted">If you enter a new webhook, <strong>first</strong> save the project and then test the webhook.</span>
        @else
            {!! Form::text('discord_webhook', null, ['class' => 'form-control']) !!}
        @endif
    </div>
@endif
