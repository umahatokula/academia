
              <table class="table table-condensed  table-hover">
                    <tbody>
                      <tr>
                        <td style="width:25%">Name</td>
                        <td>{!! $parent->fname.' '.$parent->mname.' '.$parent->lname !!}</td>
                      </tr>
                      <tr>
                        <td>Gender</td>
                        <td>{!! $parent->gender->gender !!}</td>
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
                          @foreach($parent->students as $student)
                            {!! $student->fname.' '.$student->mname.' '.$student->lname !!} <br>
                          @endforeach
                        </td>
                      </tr>

                      <tr>
                        <td>Country</td>
                        <td>{!! $parent->country->name !!}</td>
                      </tr>
                      
                      <tr>
                        <td>State</td>
                        <td>{!! $parent->state->name !!}</td>
                      </tr>

                      <tr>
                        <td>LGA</td>
                        <td>{!! $parent->local->local_name !!}</td>
                      </tr>
                      
                      <tr>
                        <td>Religion</td>
                        <td>{!! $parent->religion->religion !!}</td>
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