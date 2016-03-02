
<table class="table table-condensed  table-hover">
  <tbody>
    <tr>
      <td style="width:25%">Name</td>
      <td>{!! $parent->fname.' '.$parent->mname.' '.$parent->lname !!}</td>
    </tr>
    <tr>
      <td>Gender</td>
      <td>
        @if(!is_null($parent->gender)) 
        {!! $parent->gender->gender !!}
        @endif
      </td>
      </tr>

      <tr>
        <td>Email</td>
        <td>{!! $parent->email !!}</td>
      </tr>

      <tr>
        <td>Phone</td>
        <td>{!! $parent->phone !!}</td>
      </tr>

      <tr>
        <td>Ward(s)</td>
        <td>
        @if(!is_null($parent->students)) 
          @foreach($parent->students as $student)
          {!! $student->fname.' '.$student->mname.' '.$student->lname !!} <br>
          @endforeach
        @endif
        </td>
      </tr>

      <tr>
        <td>Country</td>
        <td>
        @if(!is_null($parent->country)) 
        {!! $parent->country->name !!}
        @endif
        </td>
      </tr>

      <tr>
        <td>State</td>
        <td>
        @if(!is_null($parent->state)) 
        {!! $parent->state->name !!}
        @endif
        </td>
      </tr>

      <tr>
        <td>LGA</td>
        <td>
        @if(!is_null($parent->local)) 
        {!! $parent->local->local_name !!}
        @endif
        </td>
      </tr>

      <tr>
        <td>Religion</td>
        <td>
        @if(!is_null($parent->religion)) 
        {!! $parent->religion->religion !!}
        @endif
        </td>
      </tr>

      <tr>
        <td>Address</td>
        <td>
          <address>
            {!! $parent->address !!}</td>
          </address>
        </tr>
      </tbody>
    </table>