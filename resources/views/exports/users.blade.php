
    <table>
      <thead>
        <tr>
          <th>الاسم  </th>
          <th> العلامة      </th>
          <th> التقييم الذاتي     </th>
          <th>  التقييم الخارجي    </th>
          <th> المستوى    </th>

        </tr>
      </thead>
      <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->user_mark}}</td>
            <td>{{$user->self_rating}}</td>
            <td>{{$user->outer_rating??'غير مقيم'}}</td>
            @php
                $level='القيادة المنجزة';
                if($user->level=='mastered')
                $level='القيادة المتقنة';
                elseif($user->level=='influential')
                $level='القيادة المؤثرة';

            @endphp

            <td>{{$level}}</td>
          </tr>
        @endforeach







      </tbody>
    </table>

