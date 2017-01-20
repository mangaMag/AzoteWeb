<div class="form-group ">
    <label class="control-label">{{ $name }}</label>
    <select id="server" class="special form-control" name="special|server">
        <option value="reset|null"></option>
        @foreach ($servers as $server)
            @if (isset($child))
                <option value="child|{{ $server->name }}|{{ $child }}">{{ ucfirst($server->name) }}</option>
            @else
                <option value="final|{{ $server->name }}">{{ ucfirst($server->name) }}</option>
            @endif
        @endforeach
    </select>
</div>