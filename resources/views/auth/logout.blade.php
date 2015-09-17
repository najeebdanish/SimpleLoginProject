{{ Form::open(['route' => ['session.destroy'], 'method' => 'delete']) }}
      <button type="submit">Logout</button>
    {{ Form::close() }}