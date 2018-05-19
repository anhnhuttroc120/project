            <table id="example1" class="table table-bordered table-striped">
                <thead style="background: #398ebd" >
                <tr>
                  <th style="width: 13%;">STT</th>
                  <th style="width: 13%;" >Hình ảnh</th>
                  <th style="width: 13%;">Tên đầy đủ</th>
                  <th style="width: 13%;">UserName</th>
                  <th style="width: 13%;">Email</th>
                  <th style="width: 13%;">Chức vị</th>
                  <th style="width: 10%;">Hành động</th>
                  
                </tr>
                </thead>
                
                <tbody>
              @forelse($users as $key => $user)
                <tr id="item-{{$user->id}}">
                  <td>{{$user->id}}</td>
                  <td>@if(!empty($user->picture))<img src="images/user/{{$user->picture}}">@else
                  Chưa có ảnh @endif</td>
                  <td>{{$user->fullname}}</td>
                  <td>{{$user->username}} </td>
                  <td>{{$user->email}}</td>
                  <td>@if($user->is_admin==1)Admin
                  @else Thành viên 
                  @endif</td>
                  <td style="width: 50px;" ><a  style="color: red";  href="javascript:deleteItem({{$user->id}})"><i class="fa fa-trash"></i></a>
                  <span style="font-weight: bold;margin-right: 5px;">|</span><a  style="color: green";  href="admin/user/edit/{{$user->id}}"><i class="fa fa-edit"></i></a>  </td>
          
                </tr>
          @empty
          <tr>
            <td style="text-align:center" colspan="6">Không tìm thấy người dùng </td>
          </tr>
          @endforelse
                
                </tbody>
                
             </table>
                 <div style="float:right" class="pagination" >
                    {!! $users->links() !!}
                    {{--  --}}

                </div>